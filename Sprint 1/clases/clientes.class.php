<?php

class Clientes {


    private $cod_cliente;
    private $nombre;
    private $dni;
    private $fecha_nacimiento;
    private $direccion;
    private $telefono;
    private $email;
    

    //Constructor 

    public function __construct($cod_cliente,$nombre,$dni,$fecha_nacimiento,$direccion,$telefono,$email){
        $this -> cod_cliente =$cod_cliente;
        $this -> nombre =$nombre;
        $this -> dni =$dni;
        $this -> fecha_nacimiento = $fecha_nacimiento;
        $this ->  direccion =$direccion;
        $this ->  telefono =$telefono;
        $this ->  email =$email;
        
    }
    //Getters
    public function obtener_cod_cliente() {
        return $this -> cod_cliente;
    }
    
    public function obtener_nombre() {
        return $this -> nombre;
    }
    
    public function obtener_dni() {
        return $this -> dni;
    }
    public function obtener_fecha_nacimiento() {
        return $this -> fecha_nacimiento;
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