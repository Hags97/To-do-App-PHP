<?php
session_start();

// Incluir los modelos, vistas y controladores necesarios
require_once './model/taskModel.php';
require_once './view/taskView.php';
require_once './controller/taskController.php';

require_once './model/usuarioModel.php';
require_once './view/usuarioView.php';
require_once './controller/usuarioController.php';

// Crear instancias de los modelos, vistas y controladores
$model = new TaskModel();
$view = new TaskView();
$controller = new TaskController($model, $view);

$modelUsuario = new UsuarioModel();
$viewUsuario = new UsuarioView();
$controllerUsuario = new UsuarioController($modelUsuario, $viewUsuario);


//Recoge la task nueva y la añade a la base de datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['titulo']) && isset($_POST['description'])) {
        $task = [
            'titulo' => $_POST['titulo'],
            'description' => $_POST['description'],
            'usuario_task_id' => $_SESSION['usuario_id']
        ];

        $controller->addTask($task);

        header('Location: ./index.php');
        exit();
    }
}

//Recoge la task a eliminar y la elimina de la base de datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['eliminar'])) {
        $task = $_POST['id'];
        $controller->deleteTask($task);

        header('Location: index.php');
        exit();
    }
}

//Elimina la sesón al salir
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cerrar'])) {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit();
    }
}

//Recoge el número de tareas pendientes
$numeroTareas = $controllerUsuario->getNumeroTareas($_SESSION['usuario_id']);

if ($numeroTareas == 0) {
    $numeroTareas = " no tienes tareas pendientes";
} else if ($numeroTareas == 1) {
    $numeroTareas = " tienes " . $numeroTareas . " tarea pendiente";
} else {
    $numeroTareas = " tienes " . $numeroTareas . " tareas pendientes";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>
    <title>To Do App</title>
</head>

<body>
    <?php if (isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado'] === true) : ?>
         <!-- Si el usuario está logueado, mostrar la página principal -->
        <main>
            <header>
                <div class="user-info">
                    <div class="user">
                        <img src="./img/donn-gabriel-baleva-U-Z4P2H3KFE-unsplash.jpg" alt="user" class="user-icon">
                    </div>
                </div>

                <div class="text">
                    <h4><?php echo $_SESSION['nombre'] . '<span>' . $numeroTareas . '</span>' ?></h4>
                </div>

                <div class="fecha">
                    <img src="./img/calendar3.svg" alt=""> <span><?php echo date('j F, Y') ?></span>

                </div>
            </header>

            <section class="task-section">
                <div class="botones">
                    <div class="icono-tarea">
                        <a href="./layout/from.php">
                            <img src="./img/patch-plus.svg" alt="">
                        </a>
                    </div>
                    <div class="cerrar-sesion">
                        <form action="./index.php" method="POST">
                            <input type="submit" value="" class="btn-añadir btn-cerrar" name="cerrar">
                        </form>
                    </div>
                </div>


                <div class="content">
                    <?= $controller->showTasks(); ?>
                </div>
            </section>
        </main>

    <?php else : ?>
  <!-- Si el usuario no está logueado, redirigir a la página de inicio de sesión -->
        <?php header('Location: iniciarSesion.php');
        exit();
        ?>;
    <?php endif; ?>
    
</body>

</html>