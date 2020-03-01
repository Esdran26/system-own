<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
</head>
<body>
    <h1>Atención!!!</h1>
    <p>Este tipo de registro se necesitan únicamente para que la contraseña esté cifrada y que ningún atacante informático pueda tomarla y tener acceso al sistema</p>

    <form action="register.php" method="POST">
        <input type="text" name="usName" id="usName" placeholder="User" autofocus required>
        <input type="password" name="usPassword" id="usPassword" placeholder="Password" autofocus required>
        <input type="submit" value="Guardar Usuario">
    </form>
</body>
</html>

<?php 

if(!isset($_POST['usName']) && !isset($_POST['usPassword'])) {
    die();
}

if($_POST) {

    require_once '../Config/connection.php';

    $userName = $_POST['usName'];
    $userPassword = $_POST['usPassword'];

    $userPasswordHash = password_hash($userPassword, PASSWORD_DEFAULT);

    //Ingresar los datos de usuario a la base de datos
    $sqlInsertUser = 'INSERT INTO users (us_name, us_password) VALUES (?, ?)';
    $sentenceSqlInsertUser = $pdo->prepare($sqlInsertUser);
    $sentenceSqlInsertUser->execute([$userName, $userPasswordHash]);

    if(isset($sentenceSqlInsertUser)) {
        echo 'Datos insertados correctamente';
    }
    else {
        echo 'No se pueden ingresar los datos';
    }
}

?>