<?php
    class TaskView{
        
        //Formulario para añadir tasks
        public function showTasks($tasks)
        {

            if($tasks === null)
            {
                $html = "<div class='alert alert-danger' role='alert'>";
                $html .= "No hay tareas para mostrar";
                $html .= "</div>";
                echo $html;
                return;
            }

            $html ="";

            foreach($tasks as $task)
            {
                $html .= "<link rel='stylesheet' href='styles.css'>";
                $html .= "<div class='card'>";
                $html .= "<div class='card-body'>";
                $html .= "<h5>" . $task['titulo'] . "</h5>";
                $html .= "<p>" . $task['description'] . "</p>";
                $html .= "</div>";
                $html .= "
                        <form action='./index.php' method='POST' class='form-center'>
                            <input type='hidden' value='" . $task['id'] . "' name='id'>
                            <input type='submit' value='Eliminar' name='eliminar' class='btn-eliminar'>
                        </form>
                        ";
                $html .= "</div>";
            }
            echo $html;
        }
    }
?>