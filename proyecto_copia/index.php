<?php
    session_start();
    include_once "includes/bbdd.php";
    
    //Variables con las expresiones regulares
    $exprUsuario = "/^[a-z]{1,}[a-z0-9_.]{2,}$/";
    $exprContrasenya = "/^[a-z0-9.]{5,}$/";
    $exprEmail = "/^[a-z0-9_.]+@[a-z]+.[a-z]{2,3}$/";

    if (isset($_GET['action']) == 'dejarSeguir'){
        $conexion = conexion();
        $delete_follows = $conexion->prepare('DELETE FROM follows WHERE userfollowed = :idUsuario;');
        $delete_follows->bindParam(':idUsuario', $_GET['idUsuario']);
        $delete_follows->execute();
        header('Location: index.php');
    }
    
    if (isset ($_POST["email"]) || isset ($_POST["usuario"]) || isset ($_POST["contrasenya"])){
        if (!preg_match($exprEmail, $_POST["email"])){
            $error["email"] = "<p class='msjError'>&uarr; Email no válido &uarr;</p>";
        }
        if (!preg_match($exprUsuario, $_POST["usuario"])){
            $error["usuario"] = "<p class='msjError'>&uarr; Usuario no válido &uarr;</p>";
        }
        if (!preg_match($exprContrasenya, $_POST["contrasenya"])){
            $error["contrasenya"] = "<p class='msjError'>&uarr; Contraseña no válida &uarr;</p>";
        }

        //Comprobación de usuario o email repetido
        $conexion = conexion();
        $consulta_usuario = $conexion->prepare('SELECT usuario FROM users WHERE usuario = :usuario;');
        $consulta_usuario->bindParam(':usuario', $_POST['usuario']);
        $consulta_usuario->execute();
        if ($consulta_usuario->rowCount() > 0){
            $usuario_repetido = true;
        }
        else{
            $usuario_repetido = false;
        }

        $consulta_email = $conexion->prepare('SELECT email FROM users WHERE email = :email;');
        $consulta_email->bindParam(':email', $_POST['email']);
        $consulta_email->execute();
        if ($consulta_email->rowCount() > 0){
            $email_repetido = true;
            
        }
        else{
            $email_repetido = false;
        }
        unset($conexion);
        if (empty($error) && $email_repetido == false && $usuario_repetido == false){
            //Encriptamos la contraseña
            $contrasenyaEncriptada = password_hash($_POST['contrasenya'], PASSWORD_DEFAULT);
            $conexion = conexion();
            $insert_user = $conexion->prepare('INSERT INTO users
                                                (usuario, contrasenya, email)
                                                VALUES (:usuario, :contrasenya, :email);');
            $insert_user->bindParam(':usuario', $_POST['usuario']);
            $insert_user->bindParam(':contrasenya', $contrasenyaEncriptada);
            $insert_user->bindParam(':email', $_POST['email']);
            $insert_user->execute();
            
            unset($conexion);
            header('Location: login.php');
            foreach ($_POST as $key => $value) {
                unset($_POST[$key]);
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revels</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <?php
            include_once 'includes/cabecera.inc.php';
        ?>
    </header>
    <nav>
        
    </nav>
    <main>
        <?php
            if (isset($_SESSION['iniciada'])){
                include_once 'includes/logged.inc.php';
            }
            else{
                include_once 'includes/no_logged.inc.php';
            }
        ?>
    </main>
</body>
</html>