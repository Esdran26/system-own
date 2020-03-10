<?php 

if($_POST) {
    function selectUser() {
        include_once 'Config/connection.php';
    
        $enteredUser = $_POST['usUser'];
        $enteredPassword = $_POST['usPassword'];

        $sqlSelectUser = 'SELECT us_name, us_password FROM users';
        $sentenceSelectUser = $pdo->prepare($sqlSelectUser);
        $sentenceSelectUser->execute();
        $resultSelectUser = $sentenceSelectUser->fetchAll();
    
        //La variable por defecto va a ser negativa
        $messageError = '<p class="messageError">Error, usuario y/o contraseña son incorrectos</p><br>';
    
        initSession($resultSelectUser, $enteredUser, $enteredPassword);
        
        return $messageError;
    }

    function initSession($resultSelectUser, $enteredUser, $enteredPassword) {
        //Si encuentra algún caso, quitará lo negativo
        foreach ($resultSelectUser as $result) {
            if($enteredUser === $result['us_name']) {
                if(password_verify($enteredPassword, $result['us_password'])) {
                    session_start();
                    $loginUser = $result['us_name'];

                    //Redireccionar si la sesión es de un administrador
                    if($loginUser == 'Andres') {
                        $_SESSION['admin'] = $loginUser;
                        if(isset($_SESSION['admin'])) {
                            header('location:AdminUI/adminUI.php');
                        }
                    }
                    //Redireccionar si la sesión es de un usuario normal
                    else {
                        $_SESSION['normal'] = $loginUser;
                        if(isset($_SESSION['normal'])) {
                            header('location:NormalUI/normalUI.php');
                        }
                    }
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/de6467cf36.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oxygen&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Css/style.css">
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="container">
        <div class="divBackground">

        </div>
        <div class="divForm">
            <h1>INICIAR SESIÓN</h1>
            <hr>
            <div class="textForm">
                <div class="messageErrorDiv">
                    <?php if($_POST) {echo selectUser();} ?>
                </div>
                <form method="POST" action="index.php">
                    <label id="labelUser" for="inputUser">Nombre de Usuario: </label>
                    <input type="text" name="usUser" id="inputUser" autofocus placeholder="Ej: Esdran26" autocomplete="off">
                    <br>
                    <div class="inputPassword">
                        <label for="inputPassword">Contraseña: </label>
                        <input type="password" name="usPassword" id="inputPassword" placeholder="Ej: fjo#423JDfk43">
                        <i id="eye-slash" class="far fa-eye-slash fa-1.5x fa-lg" aria-hidden="true"></i>
                        <i id="eye" class="far fa-eye fa-1.5x fa-lg" aria-hidden="true"></i>
                    </div>
                    <small id="smallVerifyUser">Rellene los campos correctamente para iniciar sesión.</small>
                    <input type="submit" id="inputSubmit" value="Iniciar Sesión"><br><br>
                    <small>Desarrollado por Andrés Felipe Vargas Gómez 2020 &copy;</small>
                </form>
            </div>
        </div>
    </div>
    <script src="Js/login.js"></script>
</body>
</html>