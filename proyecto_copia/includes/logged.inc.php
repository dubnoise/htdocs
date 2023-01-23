<?php
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
    <section class="main">
        <?php
            //Mostramos las publicaciones de los usuarios seguidos
            $conexion = conexion();
            $consulta_revels_seguidos = $conexion->query('SELECT r.id, r.texto, r.fecha, f.*, u.usuario FROM revels r, follows f, users u WHERE u.id = f.userfollowed AND f.userid = '.$_SESSION['idUsuario'].' AND r.userid = u.id ORDER BY r.fecha DESC;');
            
            
            echo '<div class="revels">';
            echo '<p>Novedades de tus amigos</p>';
            echo '<div class="linea"></div>';
            while ($revels = $consulta_revels_seguidos->fetch()){
                // $consulta_users = $conexion->query('SELECT usuario FROM users
                //                                 WHERE id = '.$revels["userid"].';');
                // $users = $consulta_users->fetch();
                $consulta_comments = $conexion->query('SELECT * FROM comments
                                                WHERE revelid = '.$revels["id"].';');
                
                echo '<div class="revel">
                        <a href="revel.php?idRevel='.$revels["id"].'"><img src="imagenes/user.png" alt="user">'.
                            $revels['usuario'].' - '.$revels['texto'];
                            

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
                    </a>
                </div>
                    <br>
                    <div class="linea"></div>';
            }
            echo '</div>';
        ?>
        
    </section>
    <!-- Barra lateral con los usuarios seguidos -->
    <section class="usuarios-seguidos">
        <?php
            $consulta_users = $conexion->query('SELECT u.id, u.usuario FROM follows f INNER JOIN users u ON u.id = f.userfollowed WHERE f.userid = '.$_SESSION['idUsuario'].';');
            while ($users = $consulta_users->fetch()){
                echo '<div class="usuario">';
                echo '<a href="perfil_usuarios.php?nombreUsuario='.$users['usuario'].'&idUsuario='.$users['id'].'">'.$users['usuario'].'</a>';
                echo '<a class="dejarSeguir" href="index.php?idUsuario='.$users['id'].'&action=dejarSeguir">-</a>';
                echo '</div>';
            }
        ?>
    </section>
</body>
</html>