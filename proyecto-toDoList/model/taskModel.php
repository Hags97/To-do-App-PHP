<?php
//Importar el archivo de la base de datos
require_once './config/db.php';

    class TaskModel{
        private $db;

        public function __construct()
        {   
            global $db;
            $this->db = $db;// Inicializar la propiedad db con la base de datos
        }

         // Método para obtener todas las tareas de un usuario
        public function getAllTasks()
        {   $usuario_task_id= $_SESSION['usuario_id'];

            $consultaObtenerTaks = "SELECT * FROM task WHERE usuario_task_id = :usuario_task_id";
            $stmt = $this->db->prepare($consultaObtenerTaks);
            $stmt->bindParam(':usuario_task_id', $usuario_task_id);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }

        // Método para añadir una tarea
        public function addTask($task)
        {
            // Extraer los datos de la tarea
            $titulo = $task['titulo'];
            $description = $task['description'];
            $task_usuario_id = $task['usuario_task_id'];

             // Insertar la tarea en la base de datos
            $consultaAñadirTask = "INSERT INTO task (titulo,description, usuario_task_id) VALUES(:titulo,:description, :usuario_task_id)";
            $stmt = $this->db->prepare($consultaAñadirTask);
            $stmt->bindParam(':titulo',$titulo);
            $stmt->bindParam(':description',$description);
            $stmt->bindParam(':usuario_task_id',$task_usuario_id);

            $stmt->execute();// Ejecutar la consulta

        }

         // Método para borrar una tarea
        public function deleteTask($task)
        {
            $idTask = $task;// Obtener el id de la tarea

             // Borrar la tarea de la base de datos
            $consultaBorrarTask = "DELETE FROM task WHERE id = :idTask";
            $stmt = $this->db->prepare($consultaBorrarTask);
            $stmt->bindParam(':idTask', $idTask);

            $stmt->execute();
        }
    }
?>