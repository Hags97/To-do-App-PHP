<?php
    class TaskController{

        private $model; // Propiedad para el modelo
        private $view;// Propiedad para la vista

        public function __construct($model, $view)
        {
            $this->model = $model;// Inicializar la propiedad model con el modelo
            $this->view = $view;// Inicializar la propiedad view con la vista
        }

        // Método para mostrar las tareas
        public function showTasks()
        {
            $tasks = $this->model->getAllTasks();// Obtener todas las tareas del modelo
            $this->view->showTasks($tasks);// Mostrar las tareas en la vista
        }

        // Método para añadir una tarea
        public function addTask($task)
        {
            $this->model->addTask($task);
        }

        // Método para borrar una tarea
        public function deleteTask($task)
        {
            $this->model->deleteTask($task);
        }
    }

?>