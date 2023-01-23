<?php
    session_start();
    include_once "./includes/bbdd.php";
    $conexion = conexion();

    //Validación de datos del usuario
    if (isset ($_POST["usuario"]) || isset ($_POST["contrasenya"])){
        //Quito los espacios de todos los datos introducidos
        foreach ($_POST as $key => $value) {
            $_POST[$key] = trim($value);
        }
        //Obtenemos la contraseña del usuario de la base de datos
        $contrasenyaObtenidaBBDD = $conexion->prepare('SELECT contrasenya FROM users 
                                                        WHERE usuario = :usuario OR email = :usuario;');
        $contrasenyaObtenidaBBDD->bindParam(':usuario', $_POST['usuario']);
        $contrasenyaObtenidaBBDD->execute();
        $contrasenya = $contrasenyaObtenidaBBDD->fetch();
        
        if ($contrasenya){
            if (password_verify($_POST['contrasenya'], $contrasenya['contrasenya'])){
                //Si los datos son correctos se redirige a la página index
                $consulta_users = $conexion->prepare('SELECT id FROM users 
                                                    WHERE usuario = :usuario;');
                $consulta_users->bindParam(':usuario', $_POST['usuario']);
                $consulta_users->execute();
                $users = $consulta_users->fetch();
                $_SESSION['iniciada'] = $_POST['usuario'];
                $_SESSION['idUsuario'] = $users['id'];
                header('Location: index.php?idUsuario='.$users["id"].'');

                exit();
            }    
        }
        $login['error'] = '<p>Usuario o contraseña no válidos</p>';
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
            include_once "includes/cabecera.inc.php";
        ?>
    </header>
    <main>
    <section class="container">
        <section class="registrologin">
            <form class="login" action="#" method="post">
                <h2>Login</h2>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?=$_POST['usuario']??''?>">
                <input type="password" name="contrasenya" id="contrasenya" placeholder="Contraseña" value="<?=$_POST['contrasenya']??''?>">
                <?php
                    //Comprobación del login
                    if (isset($_POST['usuario'])&&isset($_POST['contrasenya'])){
                        if (isset($login['error'])){
                            echo $login['error'];
                        }
                    }
                ?>
                <input type="submit" value="Iniciar sesión" id="submit">
            </form>
        </section>
    </section>
    </main>
</body>
</html>