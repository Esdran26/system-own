<?php

session_start();
if(isset($_SESSION['admin'])) { ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/de6467cf36.js"></script>
        <link rel="stylesheet" href="Css/adminUI.css">
        <title>Página de Administración</title>
    </head>
    <body>
        <div id="sidebar">
            <ul>
                <li>
                <i class="far fa-user-circle fa-4x logo"></i>
                </li>
                <li><a href="#">Bienvenido <?php echo $_SESSION['admin'] ?></a></li>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Llamar a caja</a></li>
                <li><a href="#">Registrar</a></li>
                <li><a href="#">Modificar o eliminar</a></li>
            </ul>
        </div>
    </body>
    </html>
<?php
}
else {
    session_start();
    $_SESSION = [];
    session_destroy();
    header('location:../index.php');
}
?>