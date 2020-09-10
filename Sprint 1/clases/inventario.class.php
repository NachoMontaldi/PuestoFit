<?php

include_once '../conexion.class.php';

class Inventario {


    private $cod_prod;
    private $nombre;
    private $existencia;
    private $cantidad_min;
    private $marca;
    private $categoria;
    private $precio_compra;
    private $precio_venta;
    private $contiene_T;
    private $contiene_A;
    private $contiene_L;
    private $descripcion;
    private $fecha_registro;

    //Constructor 

    public function __construct($cod_prod,$nombre,$existencia,$cantidad_min,$marca,$categoria,$precio_compra,
                                $precio_venta,$contiene_T,$contiene_A,$contiene_L,$descripcion,$fecha_registro,
                                $cod_prov,$cod_deposito){
        $this -> cod_prod =$cod_prod;
        $this -> nombre =$nombre;
        $this -> existencia =$existencia;
        $this ->  cantidad_min =$cantidad_min;
        $this ->  marca =$marca;
        $this ->  categoria =$categoria;
        $this ->  precio_compra =$precio_compra;
        $this ->  precio_venta =$precio_venta;
        $this ->  contiene_T =$contiene_T;
        $this ->  contiene_A =$contiene_A;
        $this ->  contiene_L =$contiene_L;
        $this ->  descripcion =$descripcion;
        $this -> fecha_registro =$fecha_registro;
        $this -> cod_prov =$cod_prov;
        $this -> cod_deposito=$cod_deposito;                            

    }
    //Getters
    public function obtener_cod_prod() {
        return $this -> cod_prod;
    }
    
    public function obtener_nombre() {
        return $this -> nombre;
    }
    
    public function obtener_existencia() {
        return $this -> existencia;
    }
    
    public function obtener_cantidad_min() {
        return $this -> cantidad_min;
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
    public function obtener_contiene_T() {
        return $this -> contiene_T;
    }
    public function obtener_contiene_A() {
        return $this -> contiene_A;
    }
    public function obtener_contiene_L() {
        return $this -> contiene_L;
    }
    public function obtener_descripcion() {
        return $this -> descripcion;
    }
    public function obtener_fecha_registro() {
        return $this -> fecha_registro;
    }
    public function obtener_cod_prov() {
        return $this -> cod_prov;
    }
    public function obtener_cod_deposito() {
        return $this -> cod_deposito;
    }

    public function obtener_nombre_deposito($cod_deposito) {
        return $this -> cod_deposito;
    }
    //Setters
    public function cambiar_nombre($nombre){  
        $this -> nombre=$nombre;
    }
    public function cambiar_existencia($existencia){  
        $this -> existencia=$existencia;
    }
    public function cambiar_cantidad_min($cantidad_min){  
        $this -> cantidad_min=$cantidad_min;
    }
    public function cambiar_marca($marca){  
        $this -> marca=$marca;
    }
    public function cambiar_categoria($categoria){  
        $this -> categoria=$categoria;
    }
    public function cambiar_precio_compra($precio_compra){  
        $this -> precio_compra=$precio_compra;
    }
    public function cambiar_precio_venta($precio_venta){  
        $this -> precio_venta=$precio_venta;
    }
    public function cambiar_contiene_T($contiene_T){  
        $this -> contiene_T=$contiene_T;
    }
    public function cambiar_contiene_A($contiene_A){  
        $this -> contiene_A=$contiene_A;
    }
    public function cambiar_contiene_L($contiene_L){  
        $this -> contiene_L=$contiene_L;
    }
    public function cambiar_descripcion($descripcion){  
        $this -> descripcion=$descripcion;
    }
    
}



?>