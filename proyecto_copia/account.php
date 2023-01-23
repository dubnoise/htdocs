<?php
    session_start();
    include_once 'includes/bbdd.php';

    //Variables con las expresiones regulares
    $exprUsuario = "/^[a-z]{1,}[a-z0-9_.]{2,}$/";
    $exprEmail = "/^[a-z0-9_.]+@[a-z]+.[a-z]{2,3}$/";
    
    if (isset ($_POST["email"]) || isset ($_POST["usuario"]) || isset ($_POST["contrasenya"])){
        if (!preg_match($exprEmail, $_POST["email"])){
            $error["email"] = "<p class='msjError'>&uarr; Email no válido &uarr;</p>";
        }
        if (!preg_match($exprUsuario, $_POST["usuario"])){
            $error["usuario"] = "<p class='msjError'>&uarr; Usuario no válido &uarr;</p>";
        }

        //Comprobación de usuario o email repetido
        $conexion = conexion();
        $consulta_usuario = $conexion->prepare('SELECT usuario FROM users WHERE usuario = :usuario;');
        $consulta_usuario->bindParam(':usuario', $_POST['usuario']);
        $consulta_usuario->execute();
        if ($consulta_usuario->rowCount() > 1){
            $usuario_repetido = true;
        }
        else{
            $usuario_repetido = false;
        }

        $consulta_email = $conexion->prepare('SELECT email FROM users WHERE email = :email;');
        $consulta_email->bindParam(':email', $_POST['email']);
        $consulta_email->execute();
        if ($consulta_email->rowCount() > 1){
            $email_repetido = true;
        }
        else{
            $email_repetido = false;
        }
        unset($conexion);
        if (empty($error) && $email_repetido == false && $usuario_repetido == false){
           
            $conexion = conexion();
            $update_user = $conexion->prepare('UPDATE users
                                            SET usuario = :usuario, email = :email
                                            WHERE id = '.$_SESSION['idUsuario'].';');
            $update_user->bindParam(':usuario', $_POST['usuario']);
            $update_user->bindParam(':email', $_POST['email']);
            $update_user->execute();
            
            unset($conexion);
            unset($update_user);
            foreach ($_POST as $key => $value) {
                unset($_POST[$key]);
            }
            header('Location: index.php');
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
    <?php
        $conexion = conexion();
        $consulta_users = $conexion->query('SELECT * FROM users
                                            WHERE id = '.$_SESSION['idUsuario'].';');
        $users = $consulta_users->fetch();
    ?>
    <main>
        <section class="mi-cuenta">
            <h3>Edita tu cuenta</h3>
            <form action="" method="post">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" value="<?=$users['usuario']??''?>">
                <?php
                    if (isset($error['usuario'])){
                        echo $error['usuario'];
                    }
                ?>
                <label for="email">Email</label>
                <input type="text" name="email" value="<?=$users['email']??''?>">
                <?php
                    if (isset($error['email'])){
                        echo $error['email'];
                    }
                ?>
                <input type="submit" value="Confirmar" class="confirmar">
            </form>
            <a href="cancel.php"><h3>Elimina tu cuenta</h3></a>
        </section>
    </main>
</body>
</html>