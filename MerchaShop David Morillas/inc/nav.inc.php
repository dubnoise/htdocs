<?php
    include_once 'bd.php';
    $conexion = conexion();
    require_once('inc/lang/es.inc.php');
    if (isset($_GET['lang'])){
        require_once('inc/lang/'.$_GET['lang'].'.inc.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php">PRINCIPAL</a>
    <?php
        //Dependiendo si se está logueado o no aparecerán opciones en el nav o no
        if (!empty($_SESSION['iniciada'])){
            if (isset($token)){
                echo '<a href="logout.php?token='.$token.'&usuario='.$_SESSION['iniciada'].'">'.$message['nav.cerrar_sesion'].'</a>'; 
            }
            else{
                echo '<a href="carrito.php">';
                echo $message['nav.productos'];
                if (isset($_SESSION['cantidad'])){    
                    echo count($_SESSION['cantidad']);
                }
                else{
                    echo '0';
                }
                echo $message['nav.carrito'];
                echo '</a>';
                echo '<a href="logout.php?usuario='.$_SESSION['iniciada'].'">'.$message['nav.cerrar_sesion'].'</a>';
            }
            
            //Consulta para saber si el usuario es admin
            $consulta_admin = $conexion->query('SELECT * FROM usuarios WHERE rol LIKE "admin";');
            $admin = $consulta_admin->fetch();
            if ($_SESSION['iniciada'] == $admin['usuario']){
                echo '<a href="usuarios.php">'.$message['nav.admin'].'</a>';
            }
        }
        else{
            echo '<a href="login.php">'.$message['nav.iniciar_sesion'].'</a>';
        }
    ?>
</body>
</html>