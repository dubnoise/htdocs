<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revels</title>
    <link rel="stylesheet" href="css/header.css">
</head>
<body>
    <header>
        <section class="izq">
            <a href="index.php">
                <section class="logoynombre">
                    <img src="imagenes/logo.png" alt="logo">
                    <h3>Revels</h3>
                </section>
            </a>
            <?php
                if (isset($_SESSION['iniciada'])){
                    echo '<a class="ahref "href="new.php">New</a>';
                    echo '<a class="ahref "href="list.php">Perfil</a>';
                    echo '<section class="busqueda">';
                    echo '  <form action="results.php" method="post">';
                    echo '      <input class="input_busqueda" type="text" name="buscar" placeholder="Buscar gente">';
                    echo '      <input class="buscar" type="submit" name="submit" value="Buscar">';
                    echo '  </form>';
                    echo '</section>';
                    echo '</section><section class="der">';
                    echo '<a class="ahref" href="account.php">Mi cuenta</a>';
                    echo '<a class="ahref" href="close.php">Salir</a>';
                    echo '</section>';
                }
                else{
                    echo '</section>';
                    echo '<section class="der">';
                    echo '<a href="login.php">
                            <section class="login_button">
                                <img src="imagenes/user_login.png" alt="user login">
                                <h3>Login</h3>
                            </section>
                        </a>';
                    
                }
            ?>
    </header>
</body>
</html>