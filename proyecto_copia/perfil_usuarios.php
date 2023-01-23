<?php
    session_start();
    include_once 'includes/bbdd.php';
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
            $conexion = conexion();
            $consulta_users = $conexion->prepare('SELECT * FROM users 
                                                    WHERE id = :idUsuario;');
            $consulta_users->bindParam(':idUsuario', $_GET['idUsuario']);
            $consulta_users->execute();
            $users = $consulta_users->fetch();

            $consulta_revels = $conexion->prepare('SELECT * FROM revels
                                                WHERE userid = :idUsuario;');
            $consulta_revels->bindParam(':idUsuario', $_GET['idUsuario']);
            $consulta_revels->execute();
            
            echo '<h2>Perfil de '.$_GET['nombreUsuario'].'</h2>';
            
            echo '<div class="revels">';
            echo '<div class="linea"></div>';
            if ($consulta_revels->rowCount() == 0){
                echo 'No ha publicado nada todavía';
            }
            else{
                while ($revels = $consulta_revels->fetch()){
                    $consulta_comments = $conexion->query('SELECT * FROM comments
                                                    WHERE revelid = '.$revels["id"].';');
                    
                    echo '<div class="revel">';
                    echo '<img src="imagenes/user.png" alt="user">'.$_GET['nombreUsuario'].' - ';
                    echo $revels['texto'];
    
                    if ($consulta_comments->rowCount() == 0){
                        echo '';    
                    }
                    else{
                        echo '<div class="linea2"></div>';
                        while ($comments = $consulta_comments->fetch()){
                            $consulta_users = $conexion->query('SELECT usuario FROM users 
                                                                WHERE id = '.$comments["userid"].';');
                            $users = $consulta_users->fetch();
                            echo '<div class="comment">'.
                                    $users['usuario'].' - '.$comments['texto'].'
                                </div>';
                        }
                    }
                            
                    echo '<div class="fecha">'.
                            $revels["fecha"].'
                        </div>
                        </div>
                        <br>
                        <div class="linea"></div>';
                }
            }
            echo '</div>';
            unset($conexion);
            unset($consulta_comments);
            unset($consulta_revels);
        ?>
    </main>
</body>
</html>