<?php 
    include_once '../conexion.class.php';
    include_once 'ordenes_de_compra.class.php';
    include_once 'detalle_ordenes_de_compra.class.php';

    class repositorio_ordenes_de_compra {

        public static function obtener_ordenes_de_compra($conexion){
            
            $filas = [];
            if (isset($conexion)){
                try{
                    $sql= 'select * from ordenes_de_compra where estado=1;';
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                    
                    $resultado = $sentencia -> fetchAll();
                    
                    if(count($resultado)){
                        foreach($resultado as $fila){
                            $filas[] = new ordenes_de_compra($fila['cod_orden_de_compra'],$fila['fecha_emision'],
                                        $fila['fecha_entrega_estimada'], $fila['proveedor'], $fila['total'], 
                                        $fila['estado'], $fila['cod_cotizacion']);
                        }
                    } 
                }catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }else{ echo 'No hay conexion :(';}

            return $filas;
        }
 
        public static function insertar_ordenes_de_compra($conexion,$orden_de_compra){
            $orden_de_compra_insertada = false;
            
            if (isset($conexion)){
                try{
    
                    $sql = "insert into ordenes_de_compra(fecha_emision,estado) values
                     (NOW(),0)";
                    
                    $cod_oc_temp = $orden_de_compra -> obtener_cod_orden_de_compra();
                    $sentencia = $conexion ->prepare($sql);
                    $sentencia -> bindParam(':cod_orden_de_compra',$cod_oc_temp, PDO::PARAM_STR);
                    $orden_de_compra_insertada = $sentencia -> execute();
                    
                } catch(PDOException $ex){
                    print 'ERROR INSCo' . $ex -> getMessage();
                }
                
                return $orden_de_compra_insertada;
            }
            else{
                echo 'No hubo conexion en cotizacion!!';
            }
            
        }

        public static function obtener_ultimo_id($conexion){        
            if (isset($conexion)){
                $id = 0;
                try{
                    $sql= 'select  MAX(cod_orden_de_compra) from ordenes_de_compra';
                    
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

        
        
        ///a partir de aca van metodos nachito(?) 

        public static function estado_orden_de_compra($conexion,$cod_orden_de_compra){
        
            $orden_de_compra_actualizada = false;
            
            if (isset($conexion)){
                try{
                    $sql = 'update ordenes_de_compra set estado = 1 WHERE cod_orden_de_compra ='. $cod_orden_de_compra;
                    
                    
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    
                    
                    $orden_de_compra_actualizada = $sentencia -> execute();
                    
                } catch(PDOException $ex){
                    print 'ERROR INSCo' . $ex -> getMessage();
                }
                
                return $orden_de_compra_actualizada;
            }
            else{
                echo 'No hubo conexion en detalle orden_de_compra!!';
            }
            
        }

        public static function proveedor_orden_de_compra($conexion,$cod_orden_de_compra,$proveedor){
        
            $orden_de_compra_actualizada = false;
            
            if (isset($conexion)){
                try{
                    $sql = 'update ordenes_de_compra set proveedor = :proveedor WHERE cod_orden_de_compra =' . $cod_orden_de_compra;
                    
                    $proveedortemp = $proveedor; //-> obtener_proveedor();
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> bindParam(':proveedor', $proveedortemp, PDO::PARAM_STR);
                    
                    $orden_de_compra_actualizada = $sentencia -> execute();
                    
                } catch(PDOException $ex){
                    print 'ERROR INSCo' . $ex -> getMessage();
                }
                
                return $orden_de_compra_actualizada;
            }
            else{
                echo 'No hubo conexion en detalle orden_de_compra!!';
            }
        }

        public static function total_orden_de_compra($conexion,$cod_orden_de_compra,$total){
        
            $orden_de_compra_actualizada = false;
            
            if (isset($conexion)){
                try{
                    $sql = 'update ordenes_de_compra set total = :total WHERE cod_orden_de_compra =' . $cod_orden_de_compra;
                    
                    $totaltemp = $total; //-> obtener_proveedor();
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> bindParam(':total', $totaltemp, PDO::PARAM_STR);
                    
                    $orden_de_compra_actualizada = $sentencia -> execute();
                    
                } catch(PDOException $ex){
                    print 'ERROR INSCo' . $ex -> getMessage();
                }
                
                return $orden_de_compra_actualizada;
            }
            else{
                echo 'No hubo conexion en detalle orden_de_compra!!';
            }
        }
    
        public static function cotizacion_orden_de_compra($conexion,$cod_orden_de_compra,$cod_cotizacion){
        
            $orden_de_compra_actualizada = false;
            
            if (isset($conexion)){
                try{
                    $sql = 'update ordenes_de_compra set cod_cotizacion = :codcotizacion WHERE cod_orden_de_compra ='. $cod_orden_de_compra;
                    
                    $codcotizaciontemp = $cod_cotizacion; 
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> bindParam(':codcotizacion', $codcotizaciontemp, PDO::PARAM_STR);
                    
                    $orden_de_compra_actualizada = $sentencia -> execute();
                    
                } catch(PDOException $ex){
                    print 'ERROR INSCo' . $ex -> getMessage();
                }
                
                return $orden_de_compra_actualizada;
            }
            else{
                echo 'No hubo conexion en detalle orden de compra!!';
            }
            
        }

        public static function cargar_detalles($cod_cotizacion, $cod_orden_de_compra){

            $filas = repositorio_cotizacion::obtener_detalles(Conexion::obtenerConexion(),$cod_cotizacion);
    
            if(count($filas)){
    
                foreach($filas as $fila){
    
                    $nombre = $fila -> obtener_nombre();
                    $marca=$fila -> obtener_marca();
                    $cantidad = $fila -> obtener_cantidad();
                    $precio_unitario = $fila -> obtener_precio_unitario();
                    self::insertar_detalle_ordenes_de_compra(Conexion :: obtenerConexion(),$cod_orden_de_compra,$nombre,$marca,$cantidad, $precio_unitario); 
    
                }
    
            }

        }

        public static function insertar_detalle_ordenes_de_compra($conexion,$cod_orden_de_compra,$nombre,$marca,$cantidad,$precio_unitario){
        
            $detalle_insertado = false;
          
            if (isset($conexion)){
                try{
                    $sql = "insert into detalle_ordenes_de_compra(cod_orden_de_compra,nombre,marca,cantidad,precio_unitario) values
                    (:cod_orden_de_compra,:nombre,:marca,:cantidad,:precio_unitario)";
                    
                    $cod_orden_de_compratemp = $cod_orden_de_compra;
                    $nombretemp = $nombre;
                    $marcatemp = $marca;
                    $cantidadtemp = $cantidad;
                    $precio_unitariotemp = $precio_unitario;
                    

                    $sentencia = $conexion ->prepare($sql);

                    
                    $sentencia -> bindParam(':cod_orden_de_compra', $cod_orden_de_compratemp, PDO::PARAM_STR);
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

        public static function eliminar_falsos($conexion){
            if (isset($conexion)){
            
                try{
                    $sql= 'delete from ordenes_de_compra where estado = 0';
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                        
                    print 'se ha borrado con exito!';}
     
                catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }
        }

        public static function obtener_detalles_oc($conexion,$id){
        
            $filas = [];
            $id_str=strval($id);
    
            if (isset($conexion)){
            
                try{
                    $sql= 'select * from detalle_ordenes_de_compra where cod_orden_de_compra='.$id_str;
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                    
                    $resultado = $sentencia -> fetchAll();

                    if(count($resultado)){
                        foreach($resultado as $fila){
                            $filas[] = new detalle_ordenes_de_compra($fila['cod_det_orden_de_compra'],$fila['cod_orden_de_compra'],
                                        $fila['nombre'],$fila['marca'], $fila['cantidad'], $fila['precio_unitario']);
                        }
                    }
    
                    
                }catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }else{ echo 'No hay conexion :(';}
            
            return $filas;
        }

        public static function calcular_precios($cod_oc){
        
            $detalles = self :: obtener_detalles_oc(Conexion::obtenerConexion(),$cod_oc);
            $total=0;
            if(count($detalles)){
    
                foreach($detalles as $detalle){
                    
                    //$precio = self::calcular_precio($detalle);
                    $subtotal = $detalle -> obtener_precio_unitario() * $detalle -> obtener_cantidad();
                    $total= $total + $subtotal;
                }
    
                }
            return $total;
            
        }
    }
?>                                                                                                                                    