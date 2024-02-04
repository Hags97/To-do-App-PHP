<?php
session_start();
// Incluimos las clases necesarias
require_once './model/usuarioModel.php';
require_once './view/usuarioView.php';
require_once './controller/usuarioController.php';


// Creamos instancias de las clases
$modelUsuario = new usuarioModel();
$usuarioView = new usuarioView();
$usuarioController = new usuarioController($modelUsuario, $usuarioView);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['password'])) {
        // Creamos un array con los datos del usuario
        $usuario = [
            'nombre' => $_POST['nombre'],
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];
        // Llamamos al método para registrar al usuario
        $usuarioController->registrarUsuario($usuario);
        
    }
}

// Si el usuario está registrado, lo redirigimos al index
    if(isset($_SESSION['usuario_registrado']) && $_SESSION['usuario_registrado'] === true)
    {
        unset($_SESSION['usuario_registrado']);
        header('Location: ./index.php');
        exit();
    }

    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>
</head>

<body>

    <?php
    // Llamamos al método para mostrar el formulario de registro
        if (!isset($_SESSION['usuario_registrado']) || !$_SESSION['usuario_registrado']) {
            $usuarioView->registrarUsuario();
        }
    ?>
</body>

</html>