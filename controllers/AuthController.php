<?php

class AuthController {
    /* Render Pages */
    public static function renderLoging() {
        TemplateController::render('./views/auth/login.php');
    }

    /* Authetication User */

    public static function login() {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        if ($email && $password) {
            $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
            $userAuth = UserModel::authorize($email, $password);
            if ($userAuth['status']) {
                $name = ucfirst(strtolower(explode(' ', $userAuth['data']['nombre'])[0]));
                $lastname = ucfirst(strtolower(explode(' ', $userAuth['data']['apellido'])[0]));
                $_SESSION['user'] = $name . ' ' . $lastname;
                $_SESSION['rol'] = $userAuth['data']['rol'];
                $_SESSION['user_id'] = $userAuth['data']['id'];
                echo json_encode([
                    'status' => true,
                    'message' => 'Inicio de sesión exitoso'
                ]);
            } else {
                echo json_encode([
                    'status' => false,
                    'message' => $userAuth['message']
                ]);
            }
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Por favor, ingresa tanto el correo como la contraseña.'
            ]);
        }
        exit;
    }

    public static function logout() {
        $_SESSION = [];
        session_unset();
        session_destroy();
        header("Location: /");
        exit;
    }


}