<?php

include_once '../conexion.class.php';

class detalle_movimientos_stock {

    private $cod_det_mov;
    private $cod_prod;
    private $cantidad;
    private $cod_mov;
    private $cod_det_remito;
    private $cod_det_factura_venta;

    //Constructor 
    public function __construct($cod_det_mov, $cod_prod, $cantidad, $cod_mov, $cod_det_remito,$cod_det_factura_venta){
        $this -> cod_det_mov =$cod_det_mov;
        $this -> cod_prod =$cod_prod;
        $this -> cantidad =$cantidad;
        $this -> cod_mov =$cod_mov;
        $this -> cod_det_remito =$cod_det_remito; 
        $this -> cod_det_factura_venta =$cod_det_factura_venta;                        


    }
    //Getters
    public function obtener_cod_det_mov() {
        return $this -> cod_det_mov;
    }
    public function obtener_cod_prod() {
        return $this -> cod_prod;
    }
    public function obtener_cantidad() {
        return $this -> cantidad;
    }
    public function obtener_cod_mov() {
        return $this -> cod_mov;
    }
    public function obtener_cod_det_remito() {
        return $this -> cod_det_remito;
    }
    public function obtener_cod_det_factura_venta() {
        return $this -> cod_det_factura_venta;
    }

        
    //Setters
    public function cambiar_marca($marca){  
        $this -> marca=$marca;
    }
    public function cambiar_cantidad($cantidad){  
        $this -> cantidad=$cantidad; 
    }
    
}



?>