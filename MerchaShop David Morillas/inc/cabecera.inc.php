<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabecera</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="lang">
        <?php
            if (isset($_COOKIE['lang'])){
                if ($_COOKIE['lang'] == 'es'){
                    echo '<a href="?lang=en"><img src="img/english.png" alt="english"></a>
                    <a href="?lang=val"><img src="img/valenciano.png" alt="valenciano"></a>';
                }
                elseif ($_COOKIE['lang'] == 'en'){
                    echo '<a href="?lang=es"><img src="img/castellano.png" alt="castellano"></a>
                    <a href="?lang=val"><img src="img/valenciano.png" alt="valenciano"></a>';
                }
                else{
                    echo '<a href="?lang=es"><img src="img/castellano.png" alt="castellano"></a>
                    <a href="?lang=en"><img src="img/english.png" alt="english"></a>';
                }
            }
            else{
                echo  '<a href="?lang=es"><img src="img/castellano.png" alt="castellano"></a>
                <a href="?lang=en"><img src="img/english.png" alt="english"></a>
                <a href="?lang=val"><img src="img/valenciano.png" alt="valenciano"></a>';
            }
        ?>
        
    </div>
    
    <div class="header">
        <a href="index.php">
            <?php
                if (empty($_SESSION['iniciada'])){
                    echo '<h1>MerchaShop</h1>';
                }
                //Si la sesión esta iniciada pondrá el nombre del usuario
                else{
                    echo '<h1>MerchaShop '.$_SESSION['iniciada'].'</h1>';
                }
            ?>
        </a>
    </div>
    
</body>
</html>