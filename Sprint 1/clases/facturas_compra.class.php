<?php

include_once '../conexion.class.php';

class facturas_compra {
    private $cod_factura_compra;
    private $numero_factura;
    private $tipo;
    private $fecha;
    private $fecha_entrega_estimada;
    private $proveedor;
    private $total;
    private $estado;
    private $sucursal;
    private $cod_orden_de_compra;
    
    //Constructor 

    public function __construct($cod_factura_compra,$numero_factura,$tipo,$fecha,$fecha_entrega_estimada,
                                $proveedor,$total,$estado,$sucursal,$cod_orden_de_compra){
        $this -> cod_factura_compra =$cod_factura_compra;
        $this -> numero_factura = $numero_factura;
        $this -> tipo = $tipo;
        $this -> fecha =$fecha;
        $this -> fecha_entrega_estimada =$fecha_entrega_estimada;
        $this ->  proveedor =$proveedor;
        $this ->  total =$total;
        $this ->  estado =$estado;
        $this -> sucursal = $sucursal;
        $this ->  cod_orden_de_compra =$cod_orden_de_compra;                           

    }
    //Getters
    public function obtener_cod_factura_compra() {
        return $this -> cod_factura_compra;
    }
    
    public function obtener_fecha() {
        return $this -> fecha;
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
    public function obtener_cod_orden_de_compra() {
        return $this -> cod_orden_de_compra;
    }
    public function obtener_sucursal() {
        return $this -> sucursal;
    }
    public function obtener_tipo() {
        return $this -> tipo;
    }
    public function obtener_numero_factura() {
        return $this -> numero_factura;
    }
    
    //Setters    
    public function cambiar_fecha() {
        $this -> fecha= $fecha;
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
}
?> 
