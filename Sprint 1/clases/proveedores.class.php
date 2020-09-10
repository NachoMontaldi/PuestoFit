<?php

class Proveedores {


    private $cod_prov;
    private $nombre;
    private $CUIL;
    private $direccion;
    private $telefono;
    private $email;
    

    //Constructor 

    public function __construct($cod_prov,$CUIL,$nombre,$direccion,$telefono,$email){
        $this -> cod_prov =$cod_prov;
        $this -> nombre =$nombre;
        $this -> CUIL =$CUIL;
        $this ->  direccion =$direccion;
        $this ->  telefono =$telefono;
        $this ->  email =$email;
        
       
    }
    //Getters
    public function obtener_cod_prov() {
        return $this -> cod_prov;
    }
    
    public function obtener_nombre() {
        return $this -> nombre;
    }
    
    public function obtener_CUIL() {
        return $this -> CUIL;
    }
    
    public function obtener_direccion() {
        return $this -> direccion;
    }
    
    public function obtener_telefono() {
        return $this -> telefono;
    }
    
    public function obtener_email() {
        return $this -> email;
    }
    
    //Setters
    public function cambiar_nombre($nombre){  
        $this -> nombre=$nombre;
    }
    public function cambiar_CUIL($CUIL){  
        $this -> CUIL=$CUIL;
    }
    public function cambiar_direccion($direccion){  
        $this -> direccion=$direccion;
    }
    public function cambiar_telefono($telefono){  
        $this -> telefono=$telefono;
    }
    public function cambiar_email($email){  
        $this -> email=$email;
    }

    
}



?>