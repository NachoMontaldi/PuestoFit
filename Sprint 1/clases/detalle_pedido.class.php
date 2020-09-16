<?php

class detalle_pedido {

	
    private $cod_det_pedido;
    private $cod_pedido;
    private $nombre;
    private $cantidad;
    private $observaciones;
   
    

    //Constructor 

    public function __construct($cod_det_pedido,$cod_pedido,$nombre,$marca,$cantidad,$observaciones){
        $this -> cod_det_pedido =$cod_det_pedido;
        $this -> cod_pedido =$cod_pedido;
        $this -> nombre =$nombre;
        $this -> marca = $marca;
        $this -> cantidad =$cantidad;
        $this -> observaciones =$observaciones;
       
    }
    //Getters
    public function obtener_cod_det_pedido() {
        return $this -> cod_det_pedido;
    }
    public function obtener_cod_pedido() {
        return $this -> cod_pedido;
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
    
    public function obtener_observaciones() {
        return $this -> observaciones;
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
    public function cambiar_observaciones($observaciones){  
        $this -> observaciones=$observaciones;
    }
    
}



?>