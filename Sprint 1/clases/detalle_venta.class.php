<?php

include_once '../conexion.class.php';

class detalle_venta {

    private $cod_det_venta;
    private $cod_venta;
    private $nombre;
    private $marca;
    private $cantidad;
    private $precio_unitario;

    //Constructor 
    public function __construct($cod_det_venta,$cod_venta,
    $nombre,$marca,$cantidad,$precio_unitario){
        $this -> cod_det_venta =$cod_det_venta;
        $this -> cod_factura_compra =$cod_venta;
        $this -> nombre =$nombre;
        $this -> marca =$marca;
        $this -> cantidad =$cantidad;
        $this -> precio_unitario =$precio_unitario;                        


    }
    //Getters
    public function obtener_cod_det_venta() {
        return $this -> cod_det_venta;
    }
    public function obtener_cod_venta() {
        return $this -> cod_venta;
    }
    public function obtener_nombre() {
        return $this -> nombre;
    }
    public function obtener_marca() {
        return $this -> marca;
    }
    public function obtener_cantidad() {
        return $this -> cantidad;
    }
    public function obtener_precio_unitario() {
        return $this -> precio_unitario;
    }

        
    //Setters
    public function cambiar_nombre($nombre){  
        $this -> nombre=$nombre;
    }
    public function cambiar_marca($marca){  
        $this -> marca=$marca;
    }
    public function cambiar_cantidad($cantidad){  
        $this -> cantidad=$cantidad;
    }
    public function cambiar_precio_unitario($precio_unitario){  
        $this -> precio_unitario=$precio_unitario;
    }
    
    
}



?>