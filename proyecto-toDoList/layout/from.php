<?php
session_start(); // Inicia la sesión
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>
    <title>To Do App</title>
</head>

<!-- Formulario de registro -->
<body>
    <main>
        <header>
            <div class="user-info">
                <div class="user">
                    <img src="../img/donn-gabriel-baleva-U-Z4P2H3KFE-unsplash.jpg" alt="user" class="user-icon">
                </div>
            </div>

            <div class="text">
                <h4><?php echo $_SESSION['nombre']?><h4>
            </div>

            <div class="fecha">
                <img src="../img/calendar3.svg" alt=""> <span><?php echo date('j F, Y') ?></span>

            </div>
        </header>

        <section class="task-section">
            <div class="content">
                <form action='../index.php' method='POST' class="form-task">
                    <div class='mb-3'>
                        <label for='titulo' class='form-label'>Tarea</label>
                        <input type='text' name="titulo" class='form-control' id='titulo'>
                    </div>
                    <div class='mb-3'>
                        <label for='description' class='form-label'>Descripción</label>
                        <input type='text' name="description" class='form-control' id='description'>
                    </div>
                    <input type="submit" value="Añadir" class="btn-añadir">
                </form>
            </div>
        </section>
    </main>
</body>

</html>