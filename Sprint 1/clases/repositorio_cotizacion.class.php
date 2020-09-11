<?php
    
    include_once '../conexion.class.php';
    include_once 'detalle_pedido.class.php';
    include_once 'cotizaciones.class.php';

    class repositorio_cotizacion{
        
        public static function insertar_detalle_cotizacion($conexion,$detalle){
        
            $detalle_insertado = false;
          
        if (isset($conexion)){
            try{
                $sql = "insert into detalle_cotizacion (cod_cotizacion,nombre,marca,cantidad) values
                 (:cod_cotizacion,:nombre,:marca,:cantidad)";
                
                $cod_cotizaciontemp = $detalle -> obtener_cod_cotizacion();
                $nombretemp = $detalle -> obtener_nombre();
                $marcatemp = $detalle -> obtener_marca();
                $cantidadtemp = $detalle -> obtener_cantidad();
                

                $sentencia = $conexion ->prepare($sql);

                
                $sentencia -> bindParam(':cod_cotizacion', $cod_cotizaciontemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':nombre', $nombretemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':marca', $marcatemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':cantidad', $cantidadtemp, PDO::PARAM_STR);

                
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
                $sql= 'select  MAX(cod_cotizacion) from cotizaciones';
                
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

    public static function insertar_cotizacion($conexion,$cotizacion){
        $cotizacion_insertada = false;
        
        if (isset($conexion)){
            try{

                $sql = "insert into cotizaciones (fecha_emision,estado) values
                 (NOW(),0)";
                
                $cod_cotizaciontemp = $cotizacion -> obtener_cod_cotizacion();
                
                
                $sentencia = $conexion ->prepare($sql);

                
                $sentencia -> bindParam(':cod_cotizacion', $cod_cotizaciontemp, PDO::PARAM_STR);
                
                
                
                $cotizacion_insertada = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $cotizacion_insertada;
        }
        else{
            echo 'No hubo conexion en cotizacion!!';
        }
        
    }

    public static function estado_cotizacion($conexion,$cod_cotizacion){
        
        $cotizacion_actualizada = false;
        
        if (isset($conexion)){
            try{
                $sql = 'update cotizaciones set estado = 1 WHERE cod_cotizacion =' . $cod_cotizacion;
                
                
                
                $sentencia = $conexion ->prepare($sql);
                
                
                
                $cotizacion_actualizada = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $cotizacion_actualizada;
        }
        else{
            echo 'No hubo conexion en detalle pedido!!';
        }
        
    }
    public static function proveedor_cotizacion($conexion,$cod_cotizacion,$proveedor){
        
        $cotizacion_actualizada = false;
        
        if (isset($conexion)){
            try{
                $sql = 'update cotizaciones set proveedor = :proveedor WHERE cod_cotizacion =' . $cod_cotizacion;
                
                $proveedortemp = $proveedor; //-> obtener_proveedor();
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> bindParam(':proveedor', $proveedortemp, PDO::PARAM_STR);
                
                $cotizacion_actualizada = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $cotizacion_actualizada;
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
                $sql= 'select * from detalle_cotizacion where cod_cotizacion='.$id_str;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new detalle_cotizacion($fila['cod_det_cotizacion'],$fila['cod_cotizacion'],
                                    $fila['nombre'], $fila['marca'], $fila['cantidad']);
                 }
            }
            }catch(PDOException $ex){
        print 'ERROR OT' . $ex -> getMessage();
        }
        }else{ echo 'No hay conexion :(';}

        return $filas;
        }

    public static function obtener_cotizaciones_enviadas($conexion){
        
        $filas = [];
        

        if (isset($conexion)){
        
            try{
                $sql= 'select * from cotizaciones where estado=1 or estado=2';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new cotizaciones($fila['cod_cotizacion'],$fila['fecha_emision'],
                                    $fila['fecha_presupuesto'], $fila['proveedor'], $fila['total'], 
                                    $fila['estado']);
                 }
            }
            }catch(PDOException $ex){
        print 'ERROR OT' . $ex -> getMessage();
    }
}else{ echo 'No hay conexion :(';}

return $filas;
    }
}