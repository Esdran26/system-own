<?php

session_start();
if(isset($_SESSION['normal'])) { ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Página de usuario normal</title>
    </head>
    <body>
        <h1>Bienvenido <?php echo $_SESSION['normal'] ?></h1>
        <a href="../logout.php">Cerrar Sesión</a>
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