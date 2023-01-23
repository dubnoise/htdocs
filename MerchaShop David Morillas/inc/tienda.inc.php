<?php
    require_once('inc/lang/es.inc.php');
    if (isset($_GET['lang'])){
        require_once('inc/lang/'.$_GET['lang'].'.inc.php');
    }
    $consulta_productos = $conexion->query('SELECT * FROM productos;');
    echo '<div class="tienda">';
    while ($productos = $consulta_productos->fetch()){
        echo '<div class="producto">'.
                $productos['nombre'].'<br><div class="img-producto"><img src="'.$productos['imagen'].'" alt="imagen"></div><br>'.
                $productos['categoria'].'<br>'.
                $productos['precio'].' €<br>'.
                $productos['stock'].' '.$message['producto.unidades'].'<br>
                <a href="index.php?codigo='.$productos['codigo'].'&accion=anyadir"><img src="productos/mas.png" alt="mas" class="mas"></a>
                <a href="index.php?codigo='.$productos['codigo'].'&accion=quitar"><img src="productos/menos.png" alt="menos" class="menos"></a>
                <a href="index.php?codigo='.$productos['codigo'].'&accion=borrar"><img src="productos/papelera.png" alt="papelera" class="papelera"></a>
            </div>'
            ;
    }
    echo '</div>';
?>