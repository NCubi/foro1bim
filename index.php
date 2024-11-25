<?php
    session_start();

    require 'database.php';
    if(isset($_SESSION['user_id'])){
        $records = $conn->prepare('SELECT id, correo, password FROM users WHERE id=:id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results=$records->fetch(PDO::FETCH_ASSOC);
        
        $user = null;

        if (count($results)>0){
            $user = $results;
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a la Aplicación</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
    <?php require 'parciales/header.php' ?>

    <?php if (!empty($user)): ?>
    <br>Bienvenido. <?= $user['correo']; ?>
    <br> Ingreso correcto
    <a href="logout.php">Logout</a>
    <?php else: ?>
        <h1>Por favor Ingresar o Registrar</h1>


    <a href="Login.php">Ingresar</a> or
    <a href="Registrarse.php">Registrar</a>
    <?php endif; ?>
</body>
</html>