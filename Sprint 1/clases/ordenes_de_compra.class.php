<?php

include_once '../conexion.class.php';

class ordenes_de_compra {
    private $cod_orden_de_compra;
    private $fecha_emision;
    private $fecha_entrega_estimada;
    private $proveedor;
    private $total;
    private $estado;
    private $sucursal;
    private $cod_cotizacion;
    
    //Constructor 

    public function __construct($cod_orden_de_compra,$fecha_emision,$fecha_entrega_estimada,
                                $proveedor,$total,$estado,$sucursal,$cod_cotizacion){
        $this -> cod_orden_de_compra =$cod_orden_de_compra;
        $this -> fecha_emision =$fecha_emision;
        $this -> fecha_entrega_estimada =$fecha_entrega_estimada;
        $this ->  proveedor =$proveedor;
        $this ->  total =$total;
        $this ->  estado =$estado;
        $this ->  sucursal =$sucursal;
        $this ->  cod_cotizacion =$cod_cotizacion;                           

    }
    //Getters
    public function obtener_cod_orden_de_compra() {
        return $this -> cod_orden_de_compra;
    }
    
    public function obtener_fecha_emision() {
        return $this -> fecha_emision;
    }
    
    public function obtener_fecha_entrega_estimada() {
        return $this -> fecha_entrega_estimada;
    }
    
    public function obtener_proveedor() {
        return $this -> proveedor;
    }
    
    public function obtener_total() {
        return $this -> total;
    }
    
    public function obtener_estado() {
        return $this -> estado;
    }

    public function obtener_sucursal() {
        return $this -> sucursal;
    }

    public function obtener_cod_cotizacion() {
        return $this -> cod_cotizacion;
    }
    
    //Setters    
    public function cambiar_fecha_emision() {
        $this -> fecha_emision=$fecha_emision;
    }
    
    public function cambiar_fecha_entrega_estimada() {
        $this -> fecha_entrega_estimada=$fecha_entrega_estimada;
    }
    
    public function cambiar_proveedor() {
        $this -> proveedor=$proveedor;
    }
    
    public function cambiar_total() {
        $this -> total=$total;
    }
    
    public function cambiar_estado() {
        $this -> estado=$estado;
    }

    public function cambiar_sucursal() {
        $this -> estado=$sucursal;
    }
}
?> 
