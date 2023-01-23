<?php
    session_start();
    session_destroy();
    if (isset($_COOKIE)){
        include_once 'inc/bd.php';
        $conexion = conexion();

        setcookie('token', $_GET['token'], time()-1);
        $token = '';
        $delete_token = $conexion->prepare('UPDATE usuarios SET token = :token WHERE usuario = :usuario;');
        $delete_token->bindParam(':token', $token);
        $delete_token->bindParam(':usuario', $_GET['usuario']);
        $delete_token->execute();
    }

    header('Location: index.php');
?>