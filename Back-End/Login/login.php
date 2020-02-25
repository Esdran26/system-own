<?php


function selectUser() {
    include_once '../Config/connection.php';

    $sqlSelectUser = 'SELECT us_name FROM users';
    $sentenceSelectUser = $pdo->prepare($sqlSelectUser);
    $sentenceSelectUser->execute();
    $resultSelectUser = $sentenceSelectUser->fetchAll();

    //La variable por defecto va a ser negativa
    $messageError = '<p class="messageError">Error, ese nombre de usuario no existe</p>';

    //Si encuentra algún caso, quitará lo negativo
    foreach ($resultSelectUser as $result) {
        if($_POST['usUser'] === $result['us_name']) {
            $messageError = '<p style="display: none">Correcto</p>';
        }
    }
    return $messageError;
}