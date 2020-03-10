<?php

session_start();
if(isset($_SESSION['admin'])) { ?>
    <?php 
    
    if($_POST) {
        function selectProductCode() {
            include '../Config/connection.php';

            $sqlSelectProductCode = 'SELECT prod_code FROM products';
            $sentenceSelectProductCode = $pdo->prepare($sqlSelectProductCode);
            $sentenceSelectProductCode->execute();
            $resultSelectProductCode = $sentenceSelectProductCode->fetchAll();

            verifyProductCode($resultSelectProductCode);

            return $resultSelectProductCode;
        }
        function verifyProductCode($resultSelectProductCode) {
            $enteredProductCode = $_POST['productCode'];
            $messageError = '';

            /*Si hay algún producto con el mismo código de barra, mostrará un
            mensaje de error*/
            foreach ($resultSelectProductCode as $result) {
                if($enteredProductCode === $result['prod_code']) {
                    $messageError = '<p class="messageError">Error, este código ya ha sido registrado</p><br>';
                }
            }

            if($messageError === '') {
                insertProductData();    
            }

            return $messageError;
        }
        
        function insertProductData() {
            include '../Config/connection.php';

            $enteredProductCode = $_POST['productCode'];
            $enteredProductName = $_POST['productName'];
            $enteredProductPrice = $_POST['productPrice'];
            $enteredProductQuantity = $_POST['productQuantity'];

            $sqlInsertProductData = 'INSERT INTO products (prod_code, prod_name, prod_price, prod_quantity) VALUES (?, ?, ?, ?)';
            $sentenceInsertProductData = $pdo->prepare($sqlInsertProductData);
            $sentenceInsertProductData->execute([$enteredProductCode, $enteredProductName, $enteredProductPrice, $enteredProductQuantity]);
        }
        selectProductCode();
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/de6467cf36.js"></script>
        <link rel="stylesheet" href="Css/adminUI.css">
        <title>Página de Administración</title>
    </head>
    <body>
        <div class="container">
            <div id="sidebar">
                <ul>
                    <li>
                    <i class="far fa-user-circle fa-4x logo"></i>
                    </li>
                    <li><a href="#">Bienvenido <?php echo $_SESSION['admin'] ?></a></li>
                    <li><a href="adminUI.php">Inicio</a></li>
                    <li><a href="adminBox.php">Llamar a Caja</a></li>
                    <li><a class="active" href="adminRegister.php">Registrar</a></li>
                    <li><a href="adminProductsOut.php">Productos Agotados</a></li>
                    <li><a href="../logout.php">Cerrar Sesión</a></li>
                </ul>
            </div>
            <div class="showAllProducts">
                <div class="form">
                    <div class="titleForm">
                        <h1 style="text-align: center;">Registrar un Producto</h1>
                    </div>
                    <br>
                    <div class="showMessageDiv">
                        <?php if($_POST) {echo verifyProductCode(selectProductCode());} ?>
                    </div>
                    <form action="adminRegister.php" method="POST">
                        <div class="inputCode">
                            <label id="labelCode" for="inputCode">Código de Barras del Producto: </label>
                            <input type="number" name="productCode" id="inputCode" autofocus placeholder="Ej: 123456789" autocomplete="off" required>
                        </div>
                        <div class="inputName">
                            <label for="inputName">Nombre del Producto: </label>
                            <input type="text" name="productName" id="inputName" placeholder="Ej: Cuaderno de 100 hojas" autocomplete="off" required>
                        </div>
                        <div class="inputPrice">
                            <label id="labelPrice" for="inputPrice">Precio del Producto: </label>
                            <input type="number" name="productPrice" id="inputPrice" autofocus placeholder="Ej: 3500" autocomplete="off" required>
                        </div>
                        <div class="inputQuantity">
                            <label id="labelQuantity" for="inputQuantity">Existencias del Producto: </label>
                            <input type="number" name="productQuantity" id="inputQuantity" autofocus placeholder="Ej: 12" autocomplete="off" required>
                        </div>
                        <small id="smallVerifyUser">Rellene todos los campos correctamente.</small>
                        <input type="submit" id="inputSubmit" value="Registrar Producto"><br><br>
                        <small>Desarrollado por Andrés Felipe Vargas Gómez 2020 &copy;</small>
                    </form>
                </div>
            </div>
        </div>
        <script src="Js/adminRegisterApp.js"></script>
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