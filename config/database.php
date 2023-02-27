<?php
/**
 * JACH
 * Conexion a base de datos
 */
    class Connection {
        public static function conexion(){
            $con = new mysqli('localhost','root','','geniat_test');
            return $con;
        }   
    }
?>