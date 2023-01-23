<?php
    include_once 'inc/bd.php';
    //Nos conectamos a la base de datos
    $conexion = conexion();
    session_start();
    
    include_once 'inc/lang.inc.php';

    //Validación de datos del usuario
    if (isset ($_POST["usuario"]) || isset ($_POST["contrasenya"])){
        //Quito los espacios de todos los datos introducidos
        foreach ($_POST as $key => $value) {
            $_POST[$key] = trim($value);
        }
        //Obtenemos la contraseña del usuario de la base de datos
        $contrasenyaObtenidaBBDD = $conexion->prepare('SELECT contrasenya FROM usuarios WHERE usuario = :usuario OR email = :usuario;');
        $contrasenyaObtenidaBBDD->bindParam(':usuario', $_POST['usuario']);
        $contrasenyaObtenidaBBDD->execute();
        $contrasenya = $contrasenyaObtenidaBBDD->fetch();
        
        if ($contrasenya){
            if (password_verify($_POST['contrasenya'], $contrasenya['contrasenya'])){
                $_SESSION['iniciada'] = $_POST['usuario'];
                //Recordar usuario
                if ($_POST['recordar'] != null){
                    $token = bin2hex(random_bytes(90));
                    setcookie('token', $token, time()+3600*24);
                    $update_token = $conexion->prepare('UPDATE usuarios
                                                        SET token = :token
                                                        WHERE usuario = :usuario;');
                    $update_token->bindParam(':token', $token);
                    $update_token->bindParam(':usuario', $_POST['usuario']);
                    $update_token->execute();
                }
                
                header('Location: index.php');
                foreach ($_POST as $key => $value) {
                    unset($_POST[$key]);
                }
                exit();
            }    
        }
        $login['error'] = '<p>'.$message['inicio_sesion.error'].'</p>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <?php
            include_once 'inc/cabecera.inc.php';
        ?>
    </header>
    <nav>
        <?php
            include_once 'inc/nav.inc.php';
        ?>
    </nav>
    <section class="container">
        <form action="#" method="post" class="registro-login">
            <h2><?=$message['inicio_sesion.titulo']?></h2>
            <label for="usuario"><?=$message['inicio_sesion.usuario']?></label>
            <input type="text" name="usuario" value="<?=$_POST['usuario']??''?>">
            <label for="contrasenya"><?=$message['inicio_sesion.contrasenya']?></label>
            <input type="password" name="contrasenya" value="<?=$_POST['contrasenya']??''?>">
            <input type="submit" value=<?=$message['inicio_sesion.enviar']?>>
            <div class="recordar-usuario">
                <label for="recordar"><?=$message['inicio_sesion.recordar']?></label>
                <input type="checkbox" name="recordar" id="recordar">
            </div>
            <?php
                if (isset($login['error'])){
                    echo $login['error'];
                }
            ?>
        </form>
    </section>
</body>
</html>