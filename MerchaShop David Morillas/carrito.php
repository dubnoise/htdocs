<?php
    include_once 'inc/bd.php';
    //Conexion a la base de datos
    $conexion = conexion();
    //Iniciamos la sesión
    session_start();
    include_once 'inc/lang.inc.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MerchaShop</title>
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
    <ul>
        <?php
            $total = 0;
            if (isset($_SESSION['cantidad']) && !empty($_SESSION['cantidad'])){
                echo '<ul>';
                foreach ($_SESSION['cantidad'] as $codigo => $cantidad){
                    $consulta_carrito = $conexion->prepare('SELECT * FROM productos WHERE codigo LIKE :codigo;');
                    $consulta_carrito->bindParam(':codigo', $codigo);
                    $consulta_carrito->execute();
                    $carrito = $consulta_carrito->fetch();
                    echo '<li>'.$carrito['nombre'].' - '.$cantidad.' '.$message['carrito.unidades'].' '.$carrito['precio'].' €/'.$message['carrito.unidad'].'</li>';
                    $total += $carrito['precio']*$cantidad;
                }
                echo '</ul>';
                echo 'TOTAL: '.$total.' €';
            }
            else{
                echo $message['carrito.vacio'];
            }  
        ?>
    </ul>
</body>
</html>