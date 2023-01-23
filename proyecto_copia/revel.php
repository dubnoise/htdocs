<?php
    include_once 'includes/bbdd.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revel</title>
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
            $consulta_revels = $conexion->prepare('SELECT * FROM revels
                                                    WHERE id = :idRevel;');
            $consulta_revels->bindParam(':idRevel', $_GET['idRevel']);
            $consulta_revels->execute();
            
            echo '<div class="revels">';
            while ($revels = $consulta_revels->fetch()){
                $consulta_users = $conexion->query('SELECT usuario FROM users
                                                WHERE id = '.$revels["userid"].';');
                $users = $consulta_users->fetch();
                $consulta_comments = $conexion->query('SELECT * FROM comments
                                                WHERE revelid = '.$revels["id"].';');
                
                echo '<div class="revel"><img src="imagenes/user.png" alt="user">'.
                            $users['usuario'].' - '.$revels['texto'];

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
                echo '<section class="comentar">';
                echo '<form action="comment.php?idRevel='.$_GET['idRevel'].'" method="post">';
                echo '<textarea name="comentario" cols="40" rows="20"></textarea>';  
                echo '<input type="submit" value="Comentar">';  
                echo '<a href="revel.php?idRevel='.$_GET['idRevel'].'">Cancelar</a>';  
                echo '</form>';
                echo '</section>';

                echo '<div class="fecha">'.
                        $revels["fecha"].'
                    </div>
                </div>
                    <br>';
            }
            echo '</div>';
        ?>
    </main>
</body>
</html>