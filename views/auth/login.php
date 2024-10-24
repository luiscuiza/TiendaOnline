<?php ob_start(); ?>
    <style>
        body {
            background-color: #E9ECEF !important;
        }
    </style>
<?php $headCss = ob_get_clean(); ?>
<?php ob_start(); ?>
    <script>
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                e.preventDefault();
                var email = $('#email').val();
                var password = $('#password').val();
                $.ajax({
                    url: '/login',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        email: email,
                        password: password
                    },
                    success: function(response) {
                        if (response.status) {
                            window.location.href = '/dashboard';
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Error en la autenticación.'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema con la solicitud. Inténtalo de nuevo.'
                        });
                    }
                });
            });
        });
    </script>
<?php $bodyJs = ob_get_clean(); ?>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="login-box w-100" style="max-width: 400px;">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h2 style="font-weight: bold;">Tienda<span class="text-primary">Online</span></h2>
            </div>
            <div class="card-body">
                <form action="/login" method="POST">
                    <!-- Loggin por Usuario -->
                    <!-- 
                    <div class="input-group mb-3">
                        <label for="login_usuario" class="sr-only">Usuario</label>
                        <input type="text" class="form-control" placeholder="Usuario" name="login_usuario" id="login_usuario" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    -->
                    <!-- Loggin por Email -->
                    <div class="input-group mb-3">
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="password" class="sr-only">Contraseña</label>
                        <input type="password" class="form-control" placeholder="Contraseña" name="password" id="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text" style="padding: 0 13px 0 13px">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-end">
                            <button type="submit" class="btn btn-primary btn-block">Acceder</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
