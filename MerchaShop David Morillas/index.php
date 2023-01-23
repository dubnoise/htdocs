<?php
    include_once 'inc/bd.php';
    //Conexion a la base de datos
    $conexion = conexion();
    //Iniciamos la sesión
    session_start();

    
    include_once 'inc/lang.inc.php';
    
    
    //Dependiendo de la acción, añadiremos, quitaremos o borraremos productos del carrito
    if (isset($_GET['accion'])){
        if ($_GET['accion'] == 'anyadir'){
            if (isset($_SESSION['cantidad'][$_GET['codigo']])){
                $_SESSION['cantidad'][$_GET['codigo']]+=1;
            }
            else{
                $_SESSION['cantidad'][$_GET['codigo']] = 1;
            }
        }
        if ($_GET['accion'] == 'quitar'){
            if (isset($_SESSION['cantidad'][$_GET['codigo']]) && $_SESSION['cantidad'][$_GET['codigo']]>1){
                $_SESSION['cantidad'][$_GET['codigo']]-=1;
            }
        }
        if ($_GET['accion'] == 'borrar'){
            if (isset($_SESSION['cantidad'][$_GET['codigo']])){
                unset($_SESSION['cantidad'][$_GET['codigo']]);
            }
        }
    }
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MerchaShop</title>
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
    <?php
        if (empty($_SESSION['iniciada'])){
            //Comprobación recordar usuario
            if (isset($_COOKIE['token'])){
                $consulta_token = $conexion()->prepare('SELECT * FROM usuarios WHERE token = :token;');
                $consulta_token->bindParam(':token', $_COOKIE['token']);
                $consulta_token->execute();
                $token = $consulta_token->fetch();
                $_SESSION['iniciada'] = $token['usuario'];
            }
            else{
                include_once 'inc/registro.inc.php';
            }
        }
        else{
            include_once 'inc/tienda.inc.php';
        }
    ?>
</body>
</html>