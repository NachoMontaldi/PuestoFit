<?php
    
    include_once '../conexion.class.php';
    include_once 'proveedores.class.php';

    class repositorio_proveedores{
        
        public static function insertar_proveedor($conexion,$proveedor){
        $proveedor_insertado = false;
        
        if (isset($conexion)){
            try{
                $sql = "insert into proveedores(nombre,CUIL,direccion,telefono,email) values
                 (:nombre,:CUIL,:direccion,:telefono,:email)";
                
                $nombretemp = $proveedor -> obtener_nombre();
                $CUILtemp = $proveedor -> obtener_CUIL();
                $direcciontemp = $proveedor -> obtener_direccion();
                $telefonotemp = $proveedor -> obtener_telefono();
                $emailtemp = $proveedor -> obtener_email();
                
                
                
                $sentencia = $conexion ->prepare($sql);

                
                $sentencia -> bindParam(':nombre', $nombretemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':CUIL', $CUILtemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':direccion', $direcciontemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':telefono', $telefonotemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':email', $emailtemp, PDO::PARAM_STR);
                
                
            $proveedor_insertado = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $proveedor_insertado;
        }
        else{
            echo 'No hubo conexion en proveedores!!';
        }
        
    }

    
}
    ?>