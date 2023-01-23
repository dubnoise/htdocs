<?php
    session_start();
    include_once "includes/bbdd.php";
    if (isset($_GET['action'])){
        $conexion = conexion();
        $insert_follows = $conexion->prepare('INSERT INTO follows
                                                (userid, userfollowed)
                                        VALUES (:userid, :userfollowed);');
        $insert_follows->bindParam(':userid', $_SESSION['idUsuario']);
        $insert_follows->bindParam(':userfollowed', $_GET['idUsuarioSeguido']);
        $insert_follows->execute();
        header('Location: index.php');
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
            include_once 'includes/cabecera.inc.php'
        ?>
    </header>
    <main>
        <?php
        $conexion = conexion();
        $consulta_users = $conexion->prepare('SELECT usuario, id FROM users
                                                WHERE usuario = :usuario');
        $consulta_users->bindParam(':usuario', $_POST["buscar"]);
        $consulta_users->execute();
        
        echo '<div class="resultados">';
        echo 'Coincidencias con '.$_POST["buscar"].': <br>';
        echo '<ul>';
        //Muestra los resultados de la consulta si las hay
        if ($consulta_users->rowCount() == 0){
            echo 'No se encontraron usuarios con ese nombre';
        }
        else{
            while ($users = $consulta_users->fetch()){
                echo '<li><img src="imagenes/user.png" alt="user"><a class="usuario" href="perfil_usuarios.php?nombreUsuario='.$users['usuario'].'&idUsuario='.$users['id'].'">'.$users['usuario'].'</a><a class="seguir" href="results.php?action=seguir&idUsuarioSeguido='.$users['id'].'">+</a></li>';
                echo '<br>';   
            }
        }
        echo '</ul>';    
        echo '</div>';
        ?>
    </main>
</body>
</html>