<?php 
    session_start();

    if (isset($_SESSION['user_id'])){
        header('Location: /phplogin');
    }

    require 'database.php';

    if (!empty($_POST['correo']) && !empty($_POST['password'])){
        $records = $conn->prepare('SELECT id, correo, password FROM users WHERE correo=:correo');
        $records->bindParam(':correo', $_POST['correo']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        $message = '';

        if (count($results)>0 && password_verify($_POST['password'], $results['password'])){
            $_SESSION['user_id'] = $results['id'];
            header('Location: /phplogin');
        } else{
            $message = 'Lo siento, las credenciales no son correctas';
        }
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'parciales/header.php' ?>
    
    <h1>Ingresar</h1>
    <span>or <a href="registrarse.php">Registrar</a></span>

    <?php if (!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>


    <form action="login.php" method="post">
        <input type="text" name="correo" placeholder="Ingrese su correo">
        <input type="password" name="password" placeholder="Ingrese su contraseña">
        <input type="submit" value="Enviar">

    </form>


</body>
</html>