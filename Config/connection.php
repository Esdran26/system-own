<?php

$link = 'mysql:host=localhost;dbname=emailapp';
$user = 'root';
$password = '';

try {
    $pdo = new PDO($link, $user, $password);
} catch (PDOException $e) {
    print $e->getMessage();
    die();
}