<?php
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Logged</title>
</head>
<body>
    <section class="container">
        <section class="bienvenido">
            <h1><i>Bienvenido a Revels</i></h1>
        </section>
         
        <section class="registrologin">
            <form class="registro" action="#" method="post">
                <h2>Regístrate</h2>

                <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario (Mínimo 3 carácteres)" value="<?=$_POST['usuario']??''?>">
                <?php
                    if (isset($error["usuario"])){
                        echo $error["usuario"];
                    }
                    if (isset($usuario_repetido) && $usuario_repetido == true){
                        echo '<p class="msjError">&uarr; Usuario ya en uso &uarr;</p>';
                    }
                ?>

                <input type="text" name="email" id="email" placeholder="Email" value="<?=$_POST['email']??''?>">
                <?php
                    if (isset($error["email"])){
                        echo $error["email"];
                    }
                    if (isset($email_repetido) && $email_repetido == true){
                        echo '<p class="msjError">&uarr; Email ya en uso &uarr;</p>';
                    }
                ?>

                <input type="password" name="contrasenya" id="contrasenya" placeholder="Contraseña (Mínimo 5 carácteres)" value="<?=$_POST['password']??''?>">
                <?php
                    if (isset($error["contrasenya"])){
                        echo $error["contrasenya"];
                    }
                ?>
                
                <input type="submit" value="Registarse" id="submit">
            </form>
        </section>
    </section>
</body>
</html>