<?php
    //Creamos una función para conectarnos a la base de datos
    function conexion(){
        $dsn = 'mysql:host=localhost;dbname=tiendamercha';

        try{
            return new PDO($dsn, 'Lumos', 'Nox');
        } catch (PDOException $e){
            echo 'Fallo durante la conexión: '. $e->getMessage();
        }
    }
?>