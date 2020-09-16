<?php
    
    include_once '../conexion.class.php';
    include_once 'detalle_pedido.class.php';
    include_once 'pedido_reposicion.class.php';

    class repositorio_pedido_reposicion{
        
        public static function insertar_detalle_pedido($conexion,$detalle){
        $detalle_insertado = false;
        
        if (isset($conexion)){
            try{
                $sql = "insert into detalle_pedidos_reposicion (cod_pedido,nombre,marca,cantidad,observaciones) values
                 (:cod_pedido,:nombre,:marca,:cantidad,:observaciones)";
                
                $cod_pedidotemp = $detalle -> obtener_cod_pedido();
                $nombretemp = $detalle -> obtener_nombre();
                $marcatemp = $detalle -> obtener_marca();
                $cantidadtemp = $detalle -> obtener_cantidad();
                $observacionestemp = $detalle -> obtener_observaciones();
                

                $sentencia = $conexion ->prepare($sql);

                
                $sentencia -> bindParam(':cod_pedido', $cod_pedidotemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':nombre', $nombretemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':marca', $marcatemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':cantidad', $cantidadtemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':observaciones', $observacionestemp, PDO::PARAM_STR);
                
                
            $detalle_insertado = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $detalle_insertado;
        }
        else{
            echo 'No hubo conexion en detalle pedido!!';
        }
        
    }
    public static function obtener_ultimo_id($conexion){        
        if (isset($conexion)){
            $id = 0;
            try{
                $sql= 'select  MAX(cod_pedido) from pedidos_reposicion';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchColumn() ;
                
                $id = intval($resultado);
                    

                
            }catch(PDOException $ex){
                print 'ERROR UID' . $ex -> getMessage();
            }
        }else{ echo 'no';}
        
        return $id;
    }

    public static function insertar_pedido($conexion,$pedido){
        $pedido_insertado = false;
        
        if (isset($conexion)){
            try{
                $sql = "insert into pedidos_reposicion (fecha,estado) values
                 (NOW(),0)";
                
                $cod_pedidotemp = $pedido -> obtener_cod_pedido();
                
                
                $sentencia = $conexion ->prepare($sql);

                
                $sentencia -> bindParam(':cod_pedido', $cod_pedidotemp, PDO::PARAM_STR);
                
                
                
            $pedido_insertado = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $pedido_insertado;
        }
        else{
            echo 'No hubo conexion en detalle pedido!!';
        }
        
    }

    public static function validar_pedido($conexion,$cod_pedido){
        $pedido_actualizado = false;
        
        if (isset($conexion)){
            try{
                $sql = 'update pedidos_reposicion set estado = 1 WHERE cod_pedido =' . $cod_pedido;
                
                
                
                $sentencia = $conexion ->prepare($sql);
                
                
                
                $pedido_actualizado = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $pedido_actualizado;
        }
        else{
            echo 'No hubo conexion en detalle pedido!!';
        }
        
    }
    public static function obtener_detalles($conexion,$id){
        
        $filas = [];
        $id_str=strval($id);

        if (isset($conexion)){
        
            try{
                $sql= 'select * from detalle_pedidos_reposicion where cod_pedido='.$id_str;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new detalle_pedido($fila['cod_det_pedido'],$fila['cod_pedido'],$fila['nombre'],$fila['marca'],
                                      $fila['cantidad'], $fila['observaciones']);
                    }
                }

                
            }catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $filas;
    }
    public static function eliminar_detalle($conexion,$value){
        if (isset($conexion)){
        
            try{
                $sql= 'delete from detalle_pedidos_reposicion where cod_det_pedido=' . $value;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                    
                print 'se ha borrado con exito!';}
 
            catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }
     }

    public static function eliminar_falsos($conexion){
        if (isset($conexion)){
        
            try{
                $sql= 'delete from pedidos_reposicion where estado = 0';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                    
                print 'se ha borrado con exito!';}
 
            catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }
     }

    public static function obtener_pedidos($conexion){
        
        $filas = [];

        if (isset($conexion)){
        
            try{
                $sql= 'select * from pedidos_reposicion where estado= 1';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new pedido_reposicion($fila['cod_pedido'],$fila['fecha'],$fila['estado']);
                    }
                }
                
            }catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $filas;
    }
}



