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
            $consulta_revels = $conexion->query('SELECT * FROM revels
                                                WHERE userid = '.$_SESSION['idUsuario'].';');
            
            echo '<div class="revels">';
            echo '<p>Tus publicaciones</p>';
            echo '<div class="linea"></div>';
            while ($revels = $consulta_revels->fetch()){
                $consulta_comments = $conexion->query('SELECT * FROM comments
                                                WHERE revelid = '.$revels["id"].';');
                
                echo '<div class="revel">';
                echo '<img src="imagenes/user.png" alt="user">'.$_SESSION['iniciada'].' - ';
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
                    <div class="eliminar-revel"><a href="delete.php?action=eliminar&idRevel='.$revels["id"].'">Eliminar</a></div>
                    </div>
                    <br>
                    <div class="linea"></div>';
            }
            
            echo '</div>';
        ?>
    </main>

</body>
</html>