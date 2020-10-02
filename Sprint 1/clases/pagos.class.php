<?php

include_once '../conexion.class.php';

class pagos {
    private $cod_pago;
    private $num_factura;
    private $metodo_pago;
    private $obsrvaciones;
    private $sucursal;
    private $fecha;
    private $proveedor;
    private $total;
    private $estado;
    private $cod_factura_compra;
    
    
    //Constructor 

    public function __construct($cod_pago,$num_factura,$metodo_pago,$observaciones,$sucursal,$fecha,
                                $proveedor,$total,$estado,$cod_factura_compra){
        $this -> cod_pago =$cod_pago;
        $this -> num_factura = $num_factura;
        $this -> metodo_pago = $metodo_pago;
        $this -> observaciones = $observaciones;
        $this -> sucursal = $sucursal;
        $this -> fecha =$fecha;
        $this -> proveedor =$proveedor;
        $this -> total =$total;
        $this -> estado =$estado;
        $this ->  cod_factura_compra =$cod_factura_compra;                           

    }
    //Getters
    public function obtener_cod_pago() {
        return $this -> cod_pago;
    }
    
    public function obtener_num_factura() {
        return $this -> num_factura;
    }

    public function obtener_metodo_pago() {
        return $this -> metodo_pago;
    }

    public function obtener_observaciones() {
        return $this -> observaciones;
    }

    public function obtener_sucursal() {
        return $this -> sucursal;
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
    public function obtener_cod_factura_compra() {
        return $this -> cod_orden_de_compra;
    }
    
   
    
    //Setters    
    public function cambiar_fecha($fecha) {
        $this -> fecha= $fecha;
    }
    
    public function cambiar_proveedor($proveedor) {
        $this -> proveedor=$proveedor;
    }
    
    public function cambiar_total($total) {
        $this -> total=$total;
    }
    
    public function cambiar_estado($estado) {
        $this -> estado=$estado;
    }

    public function cambiar_sucursal($sucursal) {
        $this -> sucursal=$sucursal;
    }

    public function cambiar_metodo_pago($metodo_pago) {
        return $this -> metodo_pago=$metodo_pago;
    }

    public function obtener_obvservaciones($observaciones) {
        return $this -> observaciones=$observaciones;
    }
}
?> 
