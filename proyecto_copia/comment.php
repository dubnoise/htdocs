<?php
    include_once 'includes/bbdd.php';
    session_start();
    $conexion = conexion();
    $hoy = date("Y-m-d H:i:s");
    $insert_comentario = $conexion->prepare('INSERT INTO comments
                                            (revelid, userid, texto, fecha)
                                            VALUES (:revelid, :userid, :texto, :fecha);');
    $insert_comentario->bindParam(':revelid', $_GET['idRevel']);
    $insert_comentario->bindParam(':userid', $_SESSION['idUsuario']);
    $insert_comentario->bindParam(':texto', $_POST['comentario']);
    $insert_comentario->bindParam(':fecha', $hoy);
    $insert_comentario->execute();
    unset($conexion);
    unset($insert_comentario);
    header('Location: revel.php?idRevel='.$_GET['idRevel'].'');
?>
