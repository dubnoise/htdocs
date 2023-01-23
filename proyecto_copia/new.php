<?php
    include_once 'includes/bbdd.php';
    session_start();
    
    if (isset($_POST['new-revel'])){
        $conexion = conexion();
        $hoy = date("Y-m-d H:i:s");
        $insert_revel = $conexion->prepare('INSERT INTO revels 
                                            (userid, texto, fecha)
                                    VALUES (:userid, :texto, :fecha);');
        $insert_revel->bindParam(':userid', $_SESSION['idUsuario']);
        $insert_revel->bindParam(':texto', $_POST['new-revel']);
        $insert_revel->bindParam(':fecha', $hoy);
        $insert_revel->execute();
        
        $ultimo_id = $conexion->lastInsertId();
        header('Location: revel.php?idRevel='.$ultimo_id.'');
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
        <section class="new-revel">
            <form action="#" method="post">
                <label for="new-revel">Nueva revel</label>
                <input type="text" name="new-revel">
                <input type="submit" value="Publicar" class="submit">
            </form>
        </section>
    </main>
</body>
</html>