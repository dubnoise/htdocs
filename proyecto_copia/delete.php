<?php
    session_start();
    include_once 'includes/bbdd.php';

    if ($_GET['action'] == 'confirmar'){
        $conexion = conexion();

        $delete_comments = $conexion->exec('DELETE FROM comments WHERE revelid = '.$_GET['idRevel'].';');
        $delete_revels = $conexion->exec('DELETE FROM revels WHERE id = '.$_GET['idRevel'].';');

        $conexion->beginTransaction();
        try{
            if($conexion->exec($delete_comments) == 0){
                throw new Exception('Error delete', 1);
            }
            if($conexion->exec($delete_revels) == 0){
                throw new Exception('Error delete', 1);
            }
            $conexion->commit();
            echo 'Consultas ejecutadas correctamente';
        }
        catch (Exception $e){
            $conexion->rollBack();
            echo 'Se ha producido un error';
        }
        unset($conexion);
        header('Location: list.php');
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
    <main>
        <?php
            echo '<div class="confirmar-borrar-revel">';
            echo '<h3>¿Estás seguro que quieres eliminar este revel?</h3>';
            echo '<a href="delete.php?action=confirmar&idRevel='.$_GET['idRevel'].'">Sí</a>';
            echo '<a href="list.php">No</a>';
            echo '</div>';
        ?>
    </main>
</body>
</html>