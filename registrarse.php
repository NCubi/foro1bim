<?php 
    require 'database.php';

    $message = '';

    if (!empty($_POST['correo']) && !empty($_POST['password'])){
        $sql = "INSERT INTO users (correo, password) VALUES (:correo, :password)";
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(':correo', $_POST['correo']);
        $password=password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()){
            $message = 'Usuario nuevo creado';
        } else{
            $message='Lamentamos el usuario no fue resgistrado';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'parciales/header.php' ?>
   
    <h1>Registrar</h1>
    <span>or <a href="login.php">Ingresar</a></span>
    
    <?php if (!empty($message)): ?>
        <p> <?= $message ?></p>
        <?php endif; ?>

    <form action="registrarse.php" method="post">
        <input type="text" name="correo" placeholder="Ingrese su correo">
        <input type="password" name="password" placeholder="Ingrese su contraseña">
        <input type="password" name="confirm_password" placeholder="Confirme su contraseña">
        <input type="submit" value="Enviar">

    </form>

</body>
</html>