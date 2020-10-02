<?php
	
class movimientos_stock {

    private $cod_mov;
    private $fecha;
    private $tipo;
    private $sucursal;
    private $cod_remito;
    private $cod_factura_venta;
    private $motivo;
    private $observaciones;
    private $estado;

    //Constructor 

    public function __construct($cod_mov,$fecha,$tipo,$motivo,$sucursal,$cod_remito,$cod_factura_venta,$observaciones,$estado){
        
        $this -> cod_mov =$cod_mov;
        $this -> fecha =$fecha;
        $this -> tipo =$tipo;
        $this -> sucursal =$sucursal;
        $this -> cod_remito =$cod_remito;
        $this -> cod_factura_venta =$cod_factura_venta;
        $this -> motivo =$motivo;
        $this -> observaciones =$observaciones;
        $this -> estado =$estado;
    }

    //Getters
    public function obtener_cod_mov() { 
        return $this -> cod_mov;
    }

    public function obtener_fecha() {
        return $this -> fecha;
    }
    
    public function obtener_tipo() {
        return $this -> tipo;
    }

    public function obtener_sucursal() {
        return $this -> sucursal;
    }

    public function obtener_cod_remito() {
        return $this -> cod_det_remito;
    }

    public function obtener_cod_factura_venta() {
        return $this -> cod_factura_venta;
    }

    public function obtener_motivo() {
        return $this -> motivo;
    }
    
    public function obtener_observaciones() {
        return $this -> observaciones;
    }
    
    public function obtener_estado(){
        return $this -> estado;
    }


    //Setters
    public function cambiar_cod_mov($cod_mov){  
        $this -> cod_mov=$cod_mov;
    }

    public function cambiar_estado($estado){  
        $this -> estado=$estado;
    }
}