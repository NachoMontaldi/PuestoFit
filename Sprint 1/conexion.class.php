<?php
//Conexion a la base de datos
class Conexion{
    
    private static $conexion;
    
    public static function abrirConexion(){
        if (!isset(self::$conexion)){
            try{
                include_once 'config.inc.php';
                
                self::$conexion = new PDO('mysql:host='.nombreServidor.';dbname='.nombreBD, nombreUsuario ,password);   
                self::$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexion ->exec("SET CHARACTER SET utf8");
                

                
                /* Se inicia la conexion mediante PDO y no mysql porque pdo es mas versatil y la otra solo sirve para mysql */
            } 
            catch (PDOException $ex){
                print "ERROR: " .$ex -> getMessage() . "<br>"."No se ha podido conectar al servidor";
                die();
            }
        }
    }
    
    public static function cerrarConexion(){
        if (isset(self::$conexion)){
            self::$conexion =null;
            
        }
    }
    
    public static function obtenerConexion(){
        return self::$conexion;
    }
    
}