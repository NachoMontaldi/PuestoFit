<?php

include_once '../conexion.class.php';

class ventas {

    private $cod_venta;
    private $fecha;
    private $num_factura;
    private $tipo_factura;
    private $cod_cliente;
    private $sucursal;
    private $met_pago;
    private $observaciones;
    private $importe;

    //Constructor 

    public function __construct($cod_venta,$fecha,$num_factura, $tipo_factura, $cod_cliente,
                                $sucursal, $met_pago, $observaciones, $importe){

        $this -> cod_venta = $cod_venta;
        $this -> fecha = $fecha;
        $this -> num_factura = $num_factura;
        $this -> tipo_factura = $tipo_factura;
        $this -> cod_cliente =$cod_cliente;
        $this -> sucursal = $sucursal;   
        $this -> met_pago = $met_pago;
        $this -> observaciones = $observaciones;
        $this -> importe = $importe;
                     
    }
    //Getters
    public function obtener_venta() {
        return $this -> cod_venta;
    }
    
    public function obtener_fecha() {
        return $this -> fecha;
    }
    
    public function obtener_num_factura() {
        return $this -> num_factura;
    }
    
    public function obtener_tipo_factura() {
        return $this -> tipo_factura;
    }
    
    public function obtener_cod_cliente() {
        return $this -> cod_cliente;
    }
    
    public function obtener_sucursal() {
        return $this -> sucursal;
    }

    public function obtener_met_pago() {
        return $this -> met_pago;
    }
    
    public function obtener_observaciones() {
        return $this -> observaciones;
    }

    public function obtener_importe() {
        return $this -> importe;
    }
    
    
    //Setters    
    public function cambiar_fecha($fecha) {
        $this -> fecha= $fecha;
    }
    
    public function cambiar_num_factura($num_factura) {
        $this -> num_factura = $num_factura;
    }
    
    public function cambiar_tipo_factura($tipo_factura) {
        $this -> tipo_factura = $tipo_factura;
    }

    public function cambiar_sucursal($sucursal) {
        $this -> sucursal = $sucursal;
    }

    public function cambiar_met_pago($met_pago) {
        $this -> met_pago = $met_pago;
    }
    
    public function cambiar_observaciones($observaciones) {
        $this -> observaciones = $observaciones;
    }
}
?> 
