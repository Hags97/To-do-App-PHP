
<?php
session_start();
// Incluir las clases necesarias
require_once './model/usuarioModel.php';
require_once './view/usuarioView.php';
require_once './controller/usuarioController.php';

// Crear instancias de las clases
$modelUsuario = new usuarioModel();
$usuarioView = new usuarioView();
$usuarioController = new usuarioController($modelUsuario, $usuarioView);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {

        // Crear un array con las credenciales del usuario
        $credenciales = [
            'email' => $_POST['email'],
            'password' => $_POST['password']

        ];   
        // Llamar al método para iniciar la sesión del usuario
        $usuarioController->iniciarSesion($credenciales);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>
</head>

<body>
<!--Llamar al método para mostrar el formulario de inicio de sesión-->
    <?php $usuarioView->formLogin(); ?>
</body>

</html>
