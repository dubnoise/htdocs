<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section class="container">
        <form action="registro.php" method="post" class="registro-login">
            <h2><?=$message['registro.titulo']?></h2>
            <label for="usuario"><?=$message['registro.usuario']?></label>
            <input type="text" name="usuario" value="<?=$_POST['usuario']??''?>">
            <label for="email">Email</label>
            <input type="text" name="email" value="<?=$_POST['email']??''?>">
            <label for="contrasenya"><?=$message['registro.contrasenya']?></label>
            <input type="password" name="contrasenya" value="<?=$_POST['contrasenya']??''?>">
            <input type="submit" value=<?=$message['registro.enviar']?>>
        </form>
        <a href="ofertas.php"><?=$message['ofertas']?></a>
    </section>
</body>
</html>