<?php

include_once '../conexion.class.php';

class detalle_pagos {

    private $cod_det_pago;
    private $cod_pago;
    private $nombre;
    private $marca;
    private $cantidad;
    private $precio_unitario;

    //Constructor 
    public function __construct($cod_det_pago,$cod_pago,
    $nombre,$marca,$cantidad,$precio_unitario){
        $this -> cod_det_pago =$cod_det_pago;
        $this -> cod_pago =$cod_pago;
        $this -> nombre =$nombre;
        $this -> marca =$marca;
        $this -> cantidad =$cantidad;
        $this -> precio_unitario =$precio_unitario;                        


    }
    //Getters
    public function obtener_cod_det_pago() {
        return $this -> cod_det_pago;
    }
    public function obtener_cod_pago() {
        return $this -> cod_pago;
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