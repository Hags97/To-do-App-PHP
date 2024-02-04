<?php

class UsuarioView
{
    // Método para mostrar el formulario de inicio de sesión
    public function formLogin()
    {
        $html = "
            <div class='form-registro'>
            
                <form action='iniciarSesion.php' method='POST' >
                    <div class='mb-3'>
                        <label for='exampleInputEmail1' class='form-label'>Email address</label>
                        <input type='email' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' name='email' required>
                        <div id='emailHelp' class='form-text'>We'll never share your email with anyone else.</div>
                    </div>
                    <div class='mb-3'>
                        <label for='exampleInputPassword1' class='form-label'>Password</label>
                        <input type='password' class='form-control' id='exampleInputPassword1' name='password' >
                    </div>
                    <div>";
                    // Mensajes de error o éxito
                        if (isset($_SESSION['error_login']) && $_SESSION['error_login'] === true) {
                            $html .= "
                                <div class='alert alert-danger' role='alert'>
                                    Usuario o contraseña incorrectos
                                </div>
                            ";
                            unset($_SESSION['error_login']); 
                        }
                        if (isset($_SESSION['registro_exitoso']) && $_SESSION['registro_exitoso'] === true) {
                            $html .= "<div class='alert alert-success' role='alert'>
                                            Usuario registrado correctamente
                                        </div>";
                            unset($_SESSION['registro_exitoso']);
                        }
        $html .=    "</div>
                    <input type='submit' value='Entrar' class='btn-añadir'>
                </form>

                <div id='registerPrompt' class='form-text mt-3 '>¿Aún no estás registrado? Haz clic en el botón de abajo para crear una cuenta.</div>
                <form action='registro.php' method='get'>
                    <input type='submit' value='Registrar' class='btn-añadir'>
                </form>
            </div>
            ";
        // Mostrar el formulario
        echo $html;
    }

    // Método para mostrar el formulario de registro
    public function registrarUsuario()
    {
        $html = "
            <form action='registro.php' method='POST' class='form-registro'>
            <div class='mb-3'>
                <label for='nombre' class='form-label'>Nombre</label>
                <input type='text' class='form-control' id='nombre' name='nombre' required>
            </div>
            <div class='mb-3'>
                <label for='exampleInputEmail1' class='form-label'>Email address</label>
                <input type='email' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' name='email' required>
            </div>
            <div class='mb-3'>
                <label for='exampleInputPassword1' class='form-label'>Password</label>
                <input type='password' class='form-control' id='exampleInputPassword1' name='password' required>
            </div>
            <div>";
            // Mensaje de error si el usuario ya existe
            if (isset($_SESSION['usuario_existente']) && $_SESSION['usuario_existente'] === true) {
                $html .= "
                    <div class='alert alert-danger' role='alert'>
                        Ya existe un usuario con este e-mail registrado
                    </div>
                ";
                $_SESSION['usuario_existente'] = false; 
            }

           $html .= "<input type='submit' value='Registrar' class='btn-añadir'>
        </form>";

        // Mostrar el formulario
        echo $html;
    }
}
