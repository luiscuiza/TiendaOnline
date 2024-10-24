<?php

class UserModel {

    static public function authorize($email, $password) {
        try {
            $pdo = Connection::connect();
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();
            $stmt->closeCursor();
            if ($user && is_null($user['deleted_at'])) {
                if (password_verify($password, $user['password'])) {
                    return [
                        'status' => true,
                        'message' => 'Autorización exitosa',
                        'data' => $user
                    ];
                } else {
                    return [
                        'status' => false,
                        'message' => 'Contraseña incorrecta'
                    ];
                }
            } else {
                return [
                    'status' => false,
                    'message' => 'Usuario no encontrado o eliminado'
                ];
            }
        } catch (PDOException $e) {
            Logger::write($e->getMessage());
            return [
                'status' => false,
                'message' => 'Error de base de datos: '
            ];
        }
    }

    static public function add($nombre, $apellido, $email, $password, $rol) {
        try {
            $pdo = Connection::connect();
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, apellido, email, password, rol) VALUES (:nombre, :apellido, :email, :password, :rol)");
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hash, PDO::PARAM_STR);
            $stmt->bindParam(':rol', $rol, PDO::PARAM_STR);
            if ($stmt->execute()) {
                return ['status' => true, 'message' => 'Usuario agregado correctamente'];
            } else {
                return ['status' => false, 'message' => 'Error al agregar el usuario'];
            }
        } catch (PDOException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
    

}
