<?php
     include_once 'inc/bd.php';
     //Conexion a la base de datos
     $conexion = conexion();
     //Iniciamos la sesión
     session_start();
     include_once 'inc/lang.inc.php';

     //Variables con las expresiones regulares
    $exprUsuario = "/^[a-z]{1,}[a-z0-9_.]{2,}$/";
    $exprEmail = "/^[a-z0-9_.]+@[a-z]+.[a-z]{2,3}$/";
    $exprContrasenya = "/^[a-z0-9.]{5,}$/";

    if (isset ($_POST["usuario"]) || isset ($_POST["email"]) || isset ($_POST["contrasenya"])){
        if (!preg_match ($exprUsuario, $_POST["usuario"])){
            $error["usuario"] = "<p>".$message['registro.error.usuario']."</p>";
        }
        if (!preg_match($exprEmail, $_POST["email"])){
            $error["email"] = "<p>".$message['registro.error.email']."</p>";
        }
        if (!preg_match($exprContrasenya, $_POST["contrasenya"])){
            $error["contrasenya"] = "<p>".$message['registro.error.contrasenya']."</p>";
        }

        //Comprobación de usuario o email repetido
        $consulta_usuario = $conexion->prepare('SELECT usuario FROM usuarios WHERE usuario = :usuario;');
        $consulta_usuario->bindParam(':usuario', $_POST['usuario']);
        $consulta_usuario->execute();
        if ($consulta_usuario->rowCount() > 0){
            $usuario_repetido = true;
        }
        else{
            $usuario_repetido = false;
        }

        $consulta_email = $conexion->prepare('SELECT email FROM usuarios WHERE email = :email;');
        $consulta_email->bindParam(':email', $_POST['email']);
        $consulta_email->execute();
        if ($consulta_email->rowCount() > 0){
            $email_repetido = true;
        }
        else{
            $email_repetido = false;
        }
        if (empty($error) && $email_repetido == false && $usuario_repetido == false){
            //Nos conectamos a la base de datos
            $conexion = conexion();
            //Encriptamos la contraseña
            $contrasenyaEncriptada = password_hash($_POST['contrasenya'], PASSWORD_DEFAULT);
            
            $cliente = 'cliente';
            $token = '';
            $insert_user = $conexion->prepare('INSERT INTO usuarios
                                                (usuario, email, contrasenya, rol, token)
                                                VALUES (:usuario, :email, :contrasenya, :rol, :token);');
            $insert_user->bindParam(':usuario', $_POST['usuario']);
            $insert_user->bindParam(':email', $_POST['email']);
            $insert_user->bindParam(':contrasenya', $contrasenyaEncriptada);
            $insert_user->bindParam(':rol', $cliente);
            $insert_user->bindParam(':token', $token);
            $insert_user->execute();
            
            $_SESSION['iniciada'] = $_POST['usuario'];

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
    <title>Registro</title>
</head>
<body>
    <header>
        <?php
            include_once 'inc/cabecera.inc.php';
        ?>
    </header>
    <?php
        if (isset($_SESSION['iniciada'])){
            header('Location: index.php');
        }
        else{
            echo '<a href="index.php">'.$message['registro.error.volver'].'</a>';
            if (isset($error["usuario"])){
                echo $error["usuario"];
            }
            if (isset($error["email"])){
                echo $error["email"];
            }
            if (isset($error["contrasenya"])){
                echo $error["contrasenya"];
            }
            if ($usuario_repetido == true || $email_repetido == true){
                echo $message['registro.error.repetido'];
            }
        }
    ?>
</body>
</html>