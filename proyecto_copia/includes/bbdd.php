<?php
    //Creamos una función para conectarnos a la base de datos
    function conexion(){
        $dsn = 'mysql:host=localhost;dbname=revels';

        try{
            return new PDO($dsn, 'revel', 'lever');
        } catch (PDOException $e){
            echo 'Fallo durante la conexión: '. $e->getMessage();
        }
    }
?>