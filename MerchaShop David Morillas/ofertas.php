<?php
    include_once 'inc/bd.php';
    $conexion = conexion();
    session_start();
    include_once 'inc/lang.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertas</title>
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
            $consulta_ofertas = $conexion->query('SELECT nombre, categoria, imagen, precio FROM productos
                                                    WHERE oferta > 0;');
            echo '<div class="tienda">';
            while ($ofertas = $consulta_ofertas->fetch()){
                echo '<div class="producto">'.$message['ofertas.enoferta'].'<br><br>'.
                        $ofertas['nombre'].'<br><div class="img-producto"><img src="'.$ofertas['imagen'].'" alt="imagen"></div><br>'.
                        $ofertas['categoria'].'<br>'.
                        $ofertas['precio'].' €<br>'.
                    '</div>'
                    ;
            }
            echo '</div>';
        ?>
</body>
</html>