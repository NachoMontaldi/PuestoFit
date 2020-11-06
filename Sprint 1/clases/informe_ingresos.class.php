<?php

class informe_ingresos {


    private $mes;
    private $cantidad;
    private $total;
    

    //Constructor 

    public function __construct($mes,$cantidad,$total){
        $this -> mes =$mes;
        $this -> cantidad =$cantidad;
        $this -> total =$total;
        
        
    }
    //Getters
    public function obtener_mes() {
        return $this -> mes;
    }
    
    public function obtener_cantidad() {
        return $this -> cantidad;
    }
    
    public function obtener_total() {
        return $this -> total;
    }
   

    
}



?>