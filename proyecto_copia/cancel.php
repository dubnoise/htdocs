<?php
    session_start();
    include_once 'includes/bbdd.php';

    if (isset($_POST['cancel']) && $_POST['cancel'] != null){
        $conexion = conexion();
        $delete_comments = $conexion->exec('DELETE FROM comments WHERE userid = '.$_SESSION['idUsuario'].';');
        $delete_revels = $conexion->exec('DELETE FROM revels WHERE userid = '.$_SESSION['idUsuario'].';');
        $delete_users = $conexion->exec('DELETE FROM users WHERE id = '.$_SESSION['idUsuario'].';');

        $conexion->beginTransaction();
        try{
            if($conexion->exec($delete_comments) == 0){
                throw new Exception('Error delete', 1);
            }
            if($conexion->exec($delete_revels) == 0){
                throw new Exception('Error delete', 1);
            }
            if($conexion->exec($delete_users) == 0){
                throw new Exception('Error delete', 1);
            }
            $conexion->commit();
            echo 'Consultas ejecutadas correctamente';
        }
        catch (Exception $e){
            $conexion->rollBack();
            echo 'Se ha producido un error';
        }
        session_destroy();
        unset($conexion);
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
            include_once 'includes/cabecera.inc.php';
        ?>
    </header>
    <main>
        <section class="cancel">
            <form action="#" method="post">
                <h3>¿SEGURO QUIERES ELIMINAR TU CUENTA?</h3>
                <input type="checkbox" name="cancel">
                <?php
                    if (isset($error['checkbox'])){
                        echo $error['checkbox'];
                    }
                ?>
                <input type="submit" value="Eliminar">
            </form>
        </section>
    </main>
</body>
</html>