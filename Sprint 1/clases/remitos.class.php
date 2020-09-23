<?php

include_once '../conexion.class.php';

class remitos {
    private $cod_remito;
    private $fecha;
    private $proveedor;
    private $total;
    private $estado;
    private $sucursal;
    private $cod_factura; 
    
    //Constructor 

    public function __construct($cod_remito,$fecha, $proveedor,$total,$estado,$sucursal,$cod_factura){

        $this -> cod_remito =$cod_remito;
        $this -> fecha =$fecha;
        $this ->  proveedor =$proveedor;
        $this ->  total =$total;
        $this ->  estado =$estado;
        $this ->  sucursal =$sucursal;
        $this ->  cod_factura =$cod_factura;                           

    }
    //Getters
    public function obtener_cod_remito() {
        return $this -> cod_remito;
    }
    
    public function obtener_fecha() {
        return $this -> fecha;
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
    public function obtener_cod_factura() {
        return $this -> cod_factura;
    }
    
    //Setters    
    public function cambiar_fecha() {
        $this -> fecha= $fecha;
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