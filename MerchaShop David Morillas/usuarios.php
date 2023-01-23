<?php
    session_start();
    include_once 'inc/bd.php';
    $conexion = conexion();
    include_once 'inc/lang.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
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
        $consulta_usuarios = $conexion->query('SELECT usuario, email, rol FROM usuarios;');
        echo '<table>';
        echo '<tr><th>USUARIO</th><th>EMAIL</th><th>ROL</th></tr>';
        while ($usuarios = $consulta_usuarios->fetch()){
            echo '<tr><td>'.$usuarios['usuario'].'</td><td>'.$usuarios['email'].'</td><td>'.$usuarios['rol'].'</td></tr>';
        }
        echo '</table>';
    ?>
</body>
</html>