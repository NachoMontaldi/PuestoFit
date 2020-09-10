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
    public static function obtener_proveedores($conexion){
        
        $filas = [];
        
        if (isset($conexion)){
        
            try{
                $sql= 'select * from proveedores';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new Proveedores($fila['cod_prov'], $fila['cuil'], $fila['nombre'],
                                      $fila['direccion'], $fila['telefono'], $fila['email']);
                    }
                }
                
            }catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $filas;
    }
    public static function eliminar_proveedor($conexion,$value){
        if (isset($conexion)){
        
            try{
                $sql= 'delete from proveedores where cod_prov=' . $value;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                    
                print 'se ha borrado con exito!';}
 
            catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }
     }
     public static function obtener_proveedores_filtrado($conexion,$criterio){
        
        $filas = [];
        $criterio_min=strtolower($criterio);
        
        if (isset($conexion)){
        
            try{
                $sql= 'select * from proveedores where (cod_prov LIKE "%'.$criterio_min. '%" 
                       OR cuil LIKE "%' .$criterio_min. '%" OR nombre LIKE "%'. $criterio_min. '%" 
                       OR direccion LIKE "%' .$criterio_min.'%" OR telefono LIKE "%'  .$criterio_min.'%" 
                       OR email LIKE "%' .$criterio_min.'%")';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new Proveedores($fila['cod_prov'],$fila['cuil'],$fila['nombre'],
                                      $fila['direccion'], $fila['telefono'], $fila['email']);
                    }
                }

                
            }catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $filas;
    }
    public static function obtener_proveedor($conexion,$cod_prov){
        
        $filas = '';
        
        if (isset($conexion)){
        
            try{
                $sql= " SELECT * from proveedores where cod_prov =" .$cod_prov;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas = new Proveedores($fila['cod_prov'], $fila['cuil'], $fila['nombre'],
                        $fila['direccion'], $fila['telefono'], $fila['email']);
                    }
                }
            }
                catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $filas;
    }

    public static function actualizar_proveedores($conexion, $cod_prov, $CUIL, $nombre, $direccion, $telefono, $email){
        $actualizacion_correcta = false;
        
        if (isset($conexion)){
            
            try{
                $sql = "UPDATE proveedores set nombre = :nombre, cuil = :cuil, direccion = :direccion, telefono = :telefono, email = :email
                        WHERE cod_prov = :cod_prov ";

                $sentencia = $conexion ->prepare($sql);

                $sentencia -> bindParam (':nombre', $nombre, PDO :: PARAM_STR);
                $sentencia -> bindParam (':cuil', $CUIL, PDO :: PARAM_STR);
                $sentencia -> bindParam (':direccion', $direccion, PDO :: PARAM_STR);
                $sentencia -> bindParam (':telefono', $telefono, PDO :: PARAM_STR);
                $sentencia -> bindParam (':email', $email, PDO :: PARAM_STR);
                $sentencia -> bindParam (':cod_prov', $cod_prov, PDO :: PARAM_STR);


                $sentencia -> execute();

                
                /*$resultado = $sentencia -> rowCount();

                if (count($resultado)) {
                    $actualizacion_correcta = true;
                } else {
                    $actualizacion_correcta = false;
                }*/
            
        }catch(PDOException $ex){
                print 'ERROR ' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion padre';}

        return $actualizacion_correcta;
    }

    public function obtener_id_proveedor($conexion, $nombre_prov) {
        $id = '';
        
        if (isset($conexion)){
        
            try{

                $sql= "SELECT cod_prov from proveedores where nombre =". "'".$nombre_prov."'";
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $id = $sentencia -> fetchColumn();

                $resultado= intval($id) ;
  
            }
                catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }else{ echo 'No hay conexion :(';}
        return $resultado;
        
    }

    public function obtener_nombre_proveedor($conexion,$cod_prov) {
        $nombre = '';
        
        if (isset($conexion)){
        
            try{
                $sql= " SELECT nombre from proveedores where cod_prov =" . $cod_prov;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $nombre = $sentencia -> fetchColumn();

                $resultado= strval($nombre) ;
  
            }
                catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }else{ echo 'No hay conexion :(';}
        return $resultado;
        
    }
                                

}
    ?>