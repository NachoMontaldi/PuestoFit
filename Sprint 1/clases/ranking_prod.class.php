<?php

include_once '../conexion.class.php';

class ranking_prod {

    private $posicion;
    private $totalunidades;
    private $total;
    private $cod_prod;
    private $nombre;
    private $marca;
    private $categoria;
    private $precio_compra;
    private $precio_venta;

    //Constructor 

    public function __construct($posicion,$totalunidades,$total,$cod_prod,$nombre,$marca,$categoria,
                                $precio_compra,$precio_venta){

        $this -> posicion = $posicion;
        $this -> totalunidades = $totalunidades;
        $this -> total = $total;
        $this -> cod_prod = $cod_prod;
        $this -> nombre = $nombre;
        $this -> marca =$marca;
        $this -> categoria = $categoria;   
        $this -> precio_compra = $precio_compra;
        $this -> precio_venta = $precio_venta;
                     
    }
    //Getters
    public function obtener_posicion() {
        return $this -> posicion;
    }
    
    public function obtener_totalunidades() {
        return $this -> totalunidades;
    }

    public function obtener_total() {
        return $this -> total;
    }
    
    public function obtener_cod_prod() {
        return $this -> cod_prod;
    }
    
    public function obtener_nombre() {
        return $this -> nombre;
    }
    
    public function obtener_marca() {
        return $this -> marca;
    }
    
    public function obtener_categoria() {
        return $this -> categoria;
    }

    public function obtener_precio_compra() {
        return $this -> precio_compra;
    }
    
    public function obtener_precio_venta() {
        return $this -> precio_venta;
    }
    
    
    //Setters    
   
}
?> 
