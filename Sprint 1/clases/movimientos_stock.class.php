<?php
	
class movimientos_stock {

    private $cod_mov;
    private $fecha;
    private $cod_producto;
    private $tipo;
    private $cantidad;
    private $cod_det_remito;
   
    //Constructor 

    public function __construct($cod_mov,$fecha,$cod_producto,$tipo,$cantidad,$cod_det_remito){
        
        $this -> cod_mov =$cod_mov;
        $this -> fecha =$fecha;
        $this -> cod_producto =$cod_producto;
        $this -> tipo =$tipo;
        $this -> cantidad =$cantidad;
        $this -> cod_det_remito =$cod_det_remito;

       
    }

    //Getters
    public function obtener_cod_mov() {
        return $this -> cod_mov;
    }

    public function obtener_fecha() {
        return $this -> fecha;
    }

    public function obtener_cod_producto() {
        return $this -> cod_producto;
    }
    
    public function obtener_tipo() {
        return $this -> fecha_tipo;
    }

    public function obtener_cantidad() {
        return $this -> cantidad;
    }

    public function obtener_cod_det_remito() {
        return $this -> cod_det_remito;
    }
    
    //Setters
    public function cambiar_cod_mov($cod_mov){  
        $this -> cod_mov=$cod_mov;
    }
}