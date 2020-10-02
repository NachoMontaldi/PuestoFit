<?php 

include_once '../conexion.class.php';
include_once 'remitos.class.php';
include_once '../clases/detalle_remitos.class.php';
include_once '../clases/movimientos_stock.class.php';
include_once '../clases/detalle_movimientos_stock.class.php';

Conexion::abrirConexion();

class repositorio_movimientos_stock {

    public static function cargar_mov_stock($cod_remito){
        
        $detalles = self :: obtener_detalles_remito(Conexion::obtenerConexion(),$cod_remito);
        $total=0;
        if(count($detalles)){

            foreach($detalles as $detalle){
                
                
            $codigo= self::obtener_cod_producto_det_remito(Conexion::obtenerConexion(),$detalle -> obtener_nombre());

            self::insertar_mov_stock(Conexion::obtenerConexion(),$codigo,$detalle -> obtener_cantidad(),
                                    $detalle -> obtener_cod_det_remito());
            
            self::actualizar_cantidad_prod(Conexion::obtenerConexion(),$codigo,$detalle -> obtener_cantidad());
            }

        }
        return $total;
    }

    public static function obtener_remito($conexion,$id){
        
        $fila = [];
        $id_str=strval($id);
    
        if (isset($conexion)){
        
            try{
                $sql= 'select * from remitos where cod_remito=' .$id_str;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
    
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $fila[] = new remitos ($fila['cod_remito'] ,$fila['fecha'],
                        $fila['proveedor'],$fila['total'], $fila['estado'], $fila['sucursal'], 
                        $fila['cod_factura_compra']);
                    }
                } 
            } catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $fila;
    }

    public static function obtener_detalles_remito($conexion,$id){
        
        $filas = [];
        $id_str=strval($id);
    
        if (isset($conexion)){
        
            try{
                $sql= 'select * from detalle_remitos where cod_remito='.$id_str;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
    
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new detalle_remitos($fila['cod_det_remito'],$fila['cod_remito'],
                                    $fila['nombre'],$fila['marca'], $fila['cantidad'], $fila['precio_unitario']);
                    }
                }
                
            }catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $filas;
    }

    public static function obtener_cod_producto_det_remito($conexion,$nombre){
        if (isset($conexion)){ 
           $cod_producto = 0; 
            try{
                
                $sql = 'select cod_prod from inventario where nombre ="'.$nombre.'"';
                
            
                $sentencia = $conexion -> prepare($sql);
    
                $sentencia -> execute();

                $resultado = $sentencia -> fetchColumn() ;
                    
                $cod_producto = intval($resultado);

            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
        }
        else{
            echo 'No hubo conexion!!';
        }
        
        return $cod_producto;
    }

    public static function insertar_mov_stock($conexion,$cod_producto,$cantidad,$cod_det_remito){
        
        $mov_insertado = false;
      
        if (isset($conexion)){
            try{
                $sql = 'insert into movimientos_stock (fecha,cod_producto,tipo,cantidad,cod_det_remito,sucursal) values
                (NOW(),:cod_producto,"compra", :cantidad, :cod_det_remito,1)';
                
    
                $cod_productotemp = $cod_producto;
                $cantidadtemp = $cantidad;
                $cod_det_remitotemp = $cod_det_remito;
        

                $sentencia = $conexion ->prepare($sql);


                $sentencia -> bindParam(':cod_producto', $cod_productotemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':cantidad', $cantidadtemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':cod_det_remito', $cod_det_remitotemp, PDO::PARAM_STR);

                
            $detalle_insertado = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $mov_insertado;
        }
        else{
            echo 'No hubo conexion!!';
        }
    }

    public static function actualizar_cantidad_prod($conexion,$cod_prod,$cantidad){
        $mov_insertado = false;
        
        $cantidad_anterior = self::obtener_cantidad_ant(Conexion::obtenerConexion(),$cod_prod);
        
        $cantidad = $cantidad + $cantidad_anterior;

        if (isset($conexion)){
            try{
                $sql = 'update stock_deposito set cantidad=:cantidad where cod_prod=:cod_prod and cod_deposito=1';
                
                $cod_productotemp = $cod_prod;
                $cantidadtemp = $cantidad;
        

                $sentencia = $conexion ->prepare($sql);

                $sentencia -> bindParam(':cod_prod', $cod_productotemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':cantidad', $cantidadtemp, PDO::PARAM_STR);

                
            $detalle_insertado = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $mov_insertado;
        }
        else{
            echo 'No hubo conexion!!';
        }
    }

    public static function obtener_cantidad_ant($conexion,$cod_prod){
        if (isset($conexion)){ 
            $cantidad = 0; 
             try{
                 
                 $sql = 'select cantidad from stock_deposito where cod_prod ='.$cod_prod;
                 
                 $sentencia = $conexion -> prepare($sql);
     
                 $sentencia -> execute();
 
                 $resultado = $sentencia -> fetchColumn() ;
                     
                 $cantidad= intval($resultado);
 
             } catch(PDOException $ex){
                 print 'ERROR INSCo' . $ex -> getMessage();
             }
         }
         else{
             echo 'No hubo conexion!!';
         }
         
         return $cantidad;
    }


    public static function obtener_movimientos_filtrados($conexion,$criterio){
            
        $filas = [];
        $criterio_min=strtolower($criterio);
        
        if (isset($conexion)){

            try{
                $sql= 'select * from grilla_movimientos where (cod_mov LIKE "%'.$criterio_min.'%" OR 
                fecha LIKE "%'.$criterio_min.'%" OR tipo LIKE "%'.$criterio_min.'%" OR sucursal LIKE "%'.$criterio_min.'%"
                OR motivo LIKE "%'.$criterio_min.'%" OR observaciones LIKE "%'.$criterio_min.'%") AND (sucursal = "Santa ana")';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();

                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new movimientos_stock($fila['cod_mov'],$fila['fecha'],$fila['tipo'],$fila['motivo'], 
                                                                $fila['sucursal'],null,
                                                                null, $fila['observaciones'], null);
                                                    
                    }
                }

            }catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $filas;
    }

    public static function obtener_movimientos($conexion){
            
        $filas = [];
        if (isset($conexion)){
            try{
                $sql= 'select * from movimientos_stock where estado!=0 and sucursal=1 ;';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new movimientos_stock($fila['cod_mov'],$fila['fecha'],$fila['tipo'],$fila['motivo'],$fila['sucursal'],$fila['cod_remito'],
                                                                $fila['cod_factura_venta'], $fila['observaciones'],$fila['estado']);
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
                $sql= 'select  MAX(cod_mov) from movimientos_stock';
                
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

    public static function validar_movimiento_stock($conexion,$cod_mov){
        $pedido_actualizado = false;
        
        if (isset($conexion)){
            try{
                $sql = 'update movimientos_stock set estado = 1 WHERE cod_mov =' . $cod_mov;
                
                $sentencia = $conexion ->prepare($sql);
                
                $pedido_actualizado = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $pedido_actualizado;
        }
        else{
            echo 'No hubo conexion';
        }
    }

    public static function eliminar_falsos($conexion){
        if (isset($conexion)){
            try{
                $sql= 'delete from movimientos_stock where estado = 0';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
            
            }
 
            catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }
     }

     public static function insertar_movimiento_stock($conexion){
        $movimiento_stock_insertado = false;
        
        if (isset($conexion)){
            try{

                $sql = "insert into movimientos_stock(estado,sucursal) values (0,1)";
                   
                $sentencia = $conexion ->prepare($sql);

                $orden_de_compra_insertada = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $movimiento_stock_insertado;
        }
        else{
            echo 'No hubo conexion en cotizacion!!';
        }
        
    }

    public static function insertar_detalle_movimiento_stock($conexion,$detalle){
        $detalle_insertado = false;
        
        if (isset($conexion)){
            try{
                
                $sql = "insert into detalle_movimientos_stock (cod_producto,cantidad,cod_mov) values
                 (:cod_producto,:cantidad,:cod_mov)";
                
                $cod_prodtemp = $detalle -> obtener_cod_prod();
                $cantidadtemp = $detalle -> obtener_cantidad();
                $cod_movtemp = $detalle -> obtener_cod_mov();
                

                $sentencia = $conexion ->prepare($sql);

                
                $sentencia -> bindParam(':cod_producto', $cod_prodtemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':cantidad', $cantidadtemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':cod_mov', $cod_movtemp, PDO::PARAM_STR);
                
                
            $detalle_insertado = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print ' ERROR INSCo' . $ex -> getMessage();
            }
            
            return $detalle_insertado;
        }
        else{
            echo 'No hubo conexion!';
        }
        
    }

    public static function obtener_sucursal($conexion,$cod_deposito){
        if (isset($conexion)){
            $sucursal = 0;
            try{
                $sql= 'select nombre from depositos where cod_deposito='.$cod_deposito;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchColumn() ;
                
                $sucursal = strval($resultado);
                    
    
                
            }catch(PDOException $ex){
                print 'ERROR UID' . $ex -> getMessage();
            }
        }else{ echo 'no';}
        
        return $sucursal;
    }

    public static function insertar_movimiento_stock_validado($conexion, $tipo, $motivo, $observaciones ,$cod_mov){
        $mov_actualizado = false;
        
        if (isset($conexion)){
            try{
                $sql = 'update movimientos_stock set
                        fecha = NOW(),
                        tipo = :tipo,
                        motivo = :motivo,
                        sucursal = 1,
                        observaciones= :observaciones
                        where cod_mov =' .$cod_mov;
                
                
                $tipotemp = $tipo;
                $motivotemp = $motivo;
                $observacionestemp = $observaciones;
                

                $sentencia = $conexion ->prepare($sql);

                
                
                $sentencia -> bindParam(':tipo', $tipotemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':motivo', $motivotemp , PDO::PARAM_STR);
                $sentencia -> bindParam(':observaciones', $observacionestemp, PDO::PARAM_STR);
                
                
            $mov_actualizado = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $mov_actualizado;
        }
        else{
            echo 'No hubo conexion en detalle pedido!!';
        }
    }
    public static function obtener_detalles_movimientos_stock($conexion,$id){
        
        $filas = [];
        $id_str=strval($id);

        if (isset($conexion)){
        
            try{
                $sql= 'select * from grilla_det_mov_stock where cod_mov='.$id_str;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        
                        $filas[] = new detalle_movimientos_stock($fila['cod_det_mov_stock'],$fila['cod_producto'],$fila['cantidad'],
                        $fila['cod_mov'], $fila['nombre'], $fila['marca']);
                        
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
                $sql= 'delete from detalle_movimientos_stock where cod_det_mov_stock=' . $value;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
            }
 
            catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }
        else{ echo 'No hay conexion :(';}
     }
}
?>