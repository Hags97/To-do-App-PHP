<?php

    class usuarioController
    {
        private $usuarioModel;
        private $usuarioView;

        public function __construct($usuarioModel,$usuarioView)
        {
            $this->usuarioModel = $usuarioModel; // Inicializar la propiedad usuarioModel con el modelo de usuario
            $this->usuarioView = $usuarioView; // Inicializar la propiedad usuarioView con la vista de usuario
        }

        // Método para mostrar el formulario de inicio de sesión
        public function showLoginForm()
        {
            $this->usuarioView->formLogin();
        }

         // Método para iniciar sesión
        public function iniciarSesion($credenciales)
        {
            $autenticado = $this->usuarioModel->autenticarUsuario($credenciales);

            if($autenticado)
            {
                $_SESSION['usuario_logueado'] = true;
                
                header('Location: ./index.php');
                exit();
            }
            else{
                $_SESSION['error_login'] = true;
                return false;
            }
        }

        // Método para registrar un usuario
        public function registrarUsuario($usuario)
        {
            $this->usuarioModel->registrarUsuario($usuario);
            

        }

        // Método para obtener el número de tareas de un usuario
        public function getNumeroTareas($usuario_id)
        {
            // Obtener el número de tareas del usuario del modelo de usuario y retornarlo
            return $this->usuarioModel->getNumeroTareas($usuario_id);
        }
       
    }
    
?>