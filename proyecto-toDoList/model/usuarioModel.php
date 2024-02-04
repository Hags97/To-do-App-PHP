<?php
// Importar la configuración de la base de datos
    require_once './config/db.php';

    class UsuarioModel
    {
        private $db;

        public function __construct()
        {
            global $db;
            $this->db = $db; // Inicializar la propiedad db con la base de datos
        }

         // Método para registrar un usuario
        public function registrarUsuario($usuario)
        {
             // Extraer los datos del usuario
            $nombre = $usuario['nombre'];
            $email = $usuario['email'];
            $password = password_hash($usuario['password'],PASSWORD_DEFAULT);// Encriptar la contraseña

            if(empty($nombre) || empty($email) || empty($password))
            {
                return false;
            }
            if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            {
                return false;
            }
            
            // Comprobar si el usuario ya existe
            $consultaComporbarUsuario = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $this->db->prepare($consultaComporbarUsuario);
            $stmt->bindParam(':email',$email);
            $stmt->execute();

            if($stmt->rowCount()> 0)
            {
                $_SESSION['usuario_existente'] = true;
                return false;
            }
            else{
                $consultaRegistro = "INSERT INTO usuarios (nombre,email,password) VALUES(:nombre,:email,:password)";

                $stmt = $this->db->prepare($consultaRegistro);
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->execute();

                $_SESSION['usuario_registrado'] = true;
                $_SESSION['registro_exitoso'] = true;
            }
        }
         
        // Método para autenticar un usuario
        public function autenticarUsuario($credenciales)
        {   
            // Extraer las credenciales
            $email = $credenciales['email'];
            $password = $credenciales['password'];

            // Consultar el usuario en la base de datos
            $consultaAutenticacion = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $this->db->prepare($consultaAutenticacion);
            $stmt->bindParam(':email',$email);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Si el usuario existe y la contraseña es correcta, retornar true
            if($usuario && password_verify($password,$usuario['password']))
            {
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['usuario_id'] = $usuario['id'];
                return true;
            }
            else{
                return false;
            }

        }

        // Método para obtener el número de tareas de un usuario
        public function getNumeroTareas($usuario_id)
        {
            // Consultar el número de tareas en la base de datos
            $consultaNumeroTareas = "SELECT COUNT(*) AS numero_tareas FROM task WHERE usuario_task_id = :usuario_id";
            $stmt = $this->db->prepare($consultaNumeroTareas);
            $stmt->bindParam(':usuario_id',$usuario_id);
            $stmt->execute();
            $numeroTareas = $stmt->fetch(PDO::FETCH_ASSOC);

            // Retornar el número de tareas
            return $numeroTareas['numero_tareas'];
        }

    }
    
?>