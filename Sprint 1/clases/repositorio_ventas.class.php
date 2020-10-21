<?php
    
    include_once '../conexion.class.php';
    include_once '../clases/ventas.class.php';
    include_once '../clases/detalle_venta.class.php';


    class repositorio_ventas{
        
        public static function insertar_detalle_venta($conexion,$detalle){
            $detalle_insertado = false;
            
            if (isset($conexion)){
                try{
                    $sql = "insert into detalle_ventas (cod_venta,nombre,marca,cantidad,precio_unitario) values
                     (:cod_venta,:nombre,:marca,:cantidad,:precio_unitario)";
                    
                    $cod_ventatemp = $detalle -> obtener_cod_venta();
                    $nombretemp = $detalle -> obtener_nombre();
                    $marcatemp = $detalle -> obtener_marca();
                    $cantidadtemp = $detalle -> obtener_cantidad();
                    $precio_unitariotemp = $detalle -> obtener_precio_unitario();
                    
    
                    $sentencia = $conexion ->prepare($sql);
    
                    
                    $sentencia -> bindParam(':cod_venta', $cod_ventatemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':nombre', $nombretemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':marca', $marcatemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':cantidad', $cantidadtemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':precio_unitario', $precio_unitariotemp, PDO::PARAM_STR);
                    
                    
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

        public static function eliminar_detalle($conexion,$value){
            if (isset($conexion)){
            
                try{
                    $sql= 'delete from detalle_ventas where cod_det_venta=' . $value;
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                        
                   }
     
                catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }
        }

        public static function obtener_venta_filtradas($conexion,$criterio){
        
            $filas = [];
            $criterio_min=strtolower($criterio);
            
            if (isset($conexion)){
        
                try{
                    $sql= 'select * from grilla_ventas_principal where ((cod_venta LIKE "%'.$criterio_min. '%" OR 
                            sucursal LIKE "%'. $criterio_min. '%" OR cliente LIKE "%'  .$criterio_min. '%" OR
                            fecha LIKE "%'  .$criterio_min. '%"OR importe LIKE "%'  .$criterio_min. '%") AND estado=1) order by cod_venta';
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                    
                    $resultado = $sentencia -> fetchAll();
        
                    if(count($resultado)){
                        foreach($resultado as $fila){
                            $filas[] = new ventas($fila['cod_venta'],$fila['fecha'], $fila['num_factura'],$fila['tipo_factura'],
                            $fila['cliente'],$fila['sucursal'],$fila['met_pago'],$fila['observaciones'],$fila['importe'],
                            $fila['estado']);
                        }
                    }
        
        
                }catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }else{ echo 'No hay conexion :(';}
            
            return $filas;
        }
        
        
        public static function obtener_venta($conexion){
            
            $filas = [];
            if (isset($conexion)){
                try{
                    $sql= 'select * from grilla_ventas_principal where estado = 1 order by cod_venta';
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                    
                    $resultado = $sentencia -> fetchAll();
                    
                    if(count($resultado)){
                        foreach($resultado as $fila){
                            $filas[] = new ventas($fila['cod_venta'],$fila['fecha'], $fila['num_factura'],$fila['tipo_factura'],
                            $fila['cliente'],$fila['sucursal'],$fila['met_pago'],$fila['observaciones'],$fila['importe'],
                            $fila['estado']);
                        }
                    } 
                }catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }else{ echo 'No hay conexion';}

            return $filas;
        }
        
        public static function insertar_venta($conexion,$venta){
            $venta_insertada = false;
            
            if (isset($conexion)){
                try{
                    $sql = "insert into ventas (sucursal,estado,fecha) values
                     (1,0,NOW())";                    
                    
                    $sentencia = $conexion ->prepare($sql);
    
                $venta_insertada = $sentencia -> execute();
                    
                } catch(PDOException $ex){
                    print 'ERROR INSCo' . $ex -> getMessage();
                }
                
                return $venta_insertada;
            }
            else{
                echo 'No hubo conexion en detalle pedido!!';
            }
            
        }
  
        public static function obtener_detalles_venta($conexion,$id){
        
            $filas = [];
            $id_str=strval($id);
        
            if (isset($conexion)){
            
                try{
                    $sql= 'select * from detalle_ventas where cod_venta='.$id_str;
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                    
                    $resultado = $sentencia -> fetchAll();
        
                    if(count($resultado)){
                        foreach($resultado as $fila){
                            $filas[] = new detalle_venta($fila['cod_det_venta'],$fila['cod_venta'],
                                        $fila['nombre'],$fila['marca'], $fila['cantidad'], $fila['precio_unitario']);
                        }
                    }
        
                    
                }catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }else{ echo 'No hay conexion :(';}
            
            return $filas;
        }

        public static function obtener_ultimo_id($conexion){        
            if (isset($conexion)){
                $id = 0;
                try{
                    $sql= 'select  MAX(cod_venta) from ventas';
                    
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

        public static function obtener_ultimo_num_fact($conexion){        
            if (isset($conexion)){
                
                try{
                    $sql= 'select  MAX(num_factura) from ventas';
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                    
                    $resultado = $sentencia -> fetchColumn() ;
                    
                    $num_factura = intval($resultado);
                        
    
                    
                }catch(PDOException $ex){
                    print 'ERROR UID' . $ex -> getMessage();
                }
            }else{ echo 'no';}
            
            return $num_factura;
        }

        public static function venta_cargada($conexion,$cod_venta,$num_factura,$tipo_factura,$cod_cliente,$met_pago,$observaciones,$importe){
        
            $venta_actualizada = false;
            
            if (isset($conexion)){
                try{
                    $sql = 'update ventas set num_factura = :num_factura, tipo_factura = :tipo_factura, cod_cliente = :cod_cliente,
                    met_pago = :met_pago, observaciones = :observaciones, importe = :importe  WHERE cod_venta =' . $cod_venta;
                    
                    $num_facturatemp = $num_factura;
                    $tipotemp = $tipo_factura;
                    $cod_clientetemp = $cod_cliente;
                    $met_pagotemp = $met_pago;
                    $observacionestemp = $observaciones;
                    $importetemp = $importe;
                    
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> bindParam(':num_factura', $num_facturatemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':tipo_factura', $tipotemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':cod_cliente', $cod_clientetemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':met_pago', $met_pagotemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':observaciones', $observacionestemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':importe', $importetemp, PDO::PARAM_STR);
                    

                    $venta_actualizada = $sentencia -> execute();
                    
                } catch(PDOException $ex){
                    print 'ERROR INSCo' . $ex -> getMessage();
                }
                
                return $venta_actualizada;
            }
            else{
                echo 'No hubo conexion en ventaaaa!!';
            }
            
        }
        public static function estado_venta($conexion,$cod_venta){
        
            $venta_actualizado = false;
            
            if (isset($conexion)){
                try{
                    $sql = 'update ventas set estado = 1 WHERE cod_venta =' . $cod_venta;
                    
                    
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    
                    
                    $venta_actualizado = $sentencia -> execute();
                    
                } catch(PDOException $ex){
                    print 'ERROR INSCo' . $ex -> getMessage();
                }
                
                return $venta_actualizado;
            }
            else{
                echo 'No hubo conexion!!';
            }
            
        }
    
        public static function eliminar_falsos($conexion){
            if (isset($conexion)){
            
                try{
                    $sql= 'delete from ventas where estado = 0';
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                        
                    print 'se ha borrado con exito!';
                }
        
                catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }
        }

        public static function calcular_precios($cod_venta){
        
            $detalles = self :: obtener_detalles_venta(Conexion::obtenerConexion(),$cod_venta);
            $total=0;
            if(count($detalles)){
    
                foreach($detalles as $detalle){
                    
                    $subtotal = $detalle -> obtener_precio_unitario() * $detalle -> obtener_cantidad();
                    $total= $total + $subtotal;
                }
    
                }
            return $total;
            
        }

        public static function actualizar_estado_anulada($conexion,$cod_venta){
        
            $venta_actualizada = false;
            
            if (isset($conexion)){
                try{
        
                    $sql = 'update ventas set estado = 5 WHERE cod_venta =' . $cod_venta;
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $venta_actualizada = $sentencia -> execute();
                    
                } catch(PDOException $ex){
                    print 'ERROR INSCo' . $ex -> getMessage();
                }
                
                return $venta_actualizada;
            }
            else{
                echo 'No hay conexion!!';
            }
            
        }

        public static function obtener_observaciones($conexion,$cod_venta){
            if (isset($conexion)){ 
            $observaciones = "";
             try{
                     
                     $sql = 'select observaciones from ventas where cod_venta ='.$cod_venta;
                     
                     $sentencia = $conexion -> prepare($sql);
         
                     $sentencia -> execute();
     
                     $resultado = $sentencia -> fetchColumn() ;
                         
                     $observaciones= strval($resultado);
     
                 } catch(PDOException $ex){
                     print 'ERROR INSCo' . $ex -> getMessage();
                 }
             }
             else{
                 echo 'No hubo conexion!!';
             }
            return $observaciones;
    }
}