<?php
	
class cotizaciones {

    private $cod_cotizacion;
    private $fecha_emision;
    private $fecha_presupuesto;
    private $proveedor;
    private $total;
    private $estado;
   
    //Constructor 

    public function __construct($cod_cotizacion,$fecha_emision,$fecha_presupuesto,
                                $proveedor,$total,$estado){
        
        $this -> cod_cotizacion =$cod_cotizacion;
        $this -> fecha_emision =$fecha_emision;
        $this -> fecha_presupuesto =$fecha_presupuesto;
        $this -> proveedor =$proveedor;
        $this -> total =$total;
        $this -> estado =$estado;
       
    }





    //Getters
    public function obtener_cod_cotizacion() {
        return $this -> cod_cotizacion;
    }

    public function obtener_fecha_emision() {
        return $this -> fecha_emision;
    }
    
    public function obtener_fecha_presupuesto() {
        return $this -> fecha_presupuesto;
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
    
    //Setters
    public function cambiar_estado($estado){  
        $this -> estado=$estado;
    }

    public function cambiar_total() {
        $this -> total=$total;
    }
   
    
}