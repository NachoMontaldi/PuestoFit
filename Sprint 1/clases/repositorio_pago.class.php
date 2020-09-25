<?php
    
    include_once '../conexion.class.php';
    include_once 'pagos.class.php';
    include_once 'detalle_pagos.class.php';

    class repositorio_pago{

        public static function obtener_facturas_compra_pago($conexion){
            
            $filas = [];
            if (isset($conexion)){
                try{
                    $sql= 'select * from facturas_compra where estado=1;';
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                    
                    $resultado = $sentencia -> fetchAll();
                    
                    if(count($resultado)){
                        foreach($resultado as $fila){
                            $filas[] = new facturas_compra($fila['cod_factura_compra'],$fila['num_factura'],$fila['tipo'],
                            $fila['fecha'], $fila['fecha_entrega_estimada'], $fila['proveedor'], $fila['total'], 
                            $fila['estado'], $fila['sucursal'], $fila['cod_oc']);
                        }
                    } 
                }catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }else{ echo 'No hay conexion en reposito_factura:(';}
        
            return $filas;
        }

    
        public static function obtener_detalles_factura($conexion,$id){
            
            $filas = [];
            $id_str=strval($id); 

            if (isset($conexion)){

                try{
                    $sql= 'select * from detalle_facturas_compra where cod_factura_compra='.$id_str;
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                    
                    $resultado = $sentencia -> fetchAll();

                    if(count($resultado)){
                        foreach($resultado as $fila){
                            $filas[] = new detalle_facturas_compra($fila['cod_det_factura_compra'],
                                        $fila['cod_factura_compra'],  $fila['nombre'],$fila['marca'], 
                                        $fila['cantidad'], $fila['precio_unitario']);
                        }
                    }

                    
                }catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }else{ echo 'No hay conexion :(';}
            
            return $filas;
        }

        public static function obtener_pagos($conexion){
            
            $filas = [];
            if (isset($conexion)){
                try{
                    $sql= 'select * from pagos where estado!=0 and sucursal=1 ;';
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                    
                    $resultado = $sentencia -> fetchAll();
                    
                    if(count($resultado)){
                        foreach($resultado as $fila){
                            $filas[] = new pagos($fila['cod_pago'],$fila['num_factura'],$fila['metodo_pago'],
                            $fila['sucursal'], $fila['fecha'], $fila['proveedor'], $fila['total'], 
                            $fila['estado'],  $fila['cod_factura_compra']);
                        }
                    } 
                }catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }else{ echo 'No hay conexion en pagos_principal:(';}

            return $filas;
        }

        public static function obtener_pagos_filtrados($conexion,$criterio){
        
            $filas = [];
        
            $criterio_min=strtolower($criterio);
            
            if (isset($conexion)){
        
                try{
                    $sql= 'select * from grilla_pagos where (cod_pago LIKE "%'.$criterio_min.'%" OR 
                           num_factura LIKE "%'.$criterio_min.'%" OR metodo_pago LIKE "%'.$criterio_min.'%" OR 
                           sucursal LIKE "%'.$criterio_min.'%" OR fecha LIKE "%'.$criterio_min.'%" OR 
                           proveedor LIKE "%'.$criterio_min.'%" OR total LIKE "%'.$criterio_min.'%")
                            AND (sucursal = "Santa ana")';
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                    
                    $resultado = $sentencia -> fetchAll();
                    
                    if(count($resultado)){
                        foreach($resultado as $fila){
                            $filas[] = new pagos($fila['cod_pago'], $fila['num_factura'], $fila['metodo_pago'], 
                            $fila['sucursal'], $fila['fecha'],  $fila['proveedor'], $fila['total'],$fila['estado'],
                            null);
                        }
                    }
                    
                }catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }else{ echo 'No hay conexion :(';}
            
            return $filas;
        }
        
        public static function obtener_detalles_pago($conexion,$id){
        
            $filas = [];
            $id_str=strval($id);
    
            if (isset($conexion)){
            
                try{
                    $sql= 'select * from detalle_pagos where cod_pago='.$id_str;
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                    
                    $resultado = $sentencia -> fetchAll();
    
                    if(count($resultado)){
                        foreach($resultado as $fila){
                            $filas[] = new detalle_pagos($fila['cod_det_pago'],$fila['cod_pago'],
                                        $fila['nombre'],$fila['marca'], $fila['cantidad'], $fila['precio_unitario']);
                        }
                    }
    
                    
                }catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }else{ echo 'No hay conexion :(';}
            
            return $filas;
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


        public static function obtener_facturas_filtradas($conexion,$criterio){
        
            $filas = [];
            $criterio_min=strtolower($criterio);
            
            if (isset($conexion)){
        
                try{
                    $sql= 'select * from grilla_facturas_remito where (cod_factura_compra LIKE "%'.$criterio_min. '%" OR 
                            fecha LIKE "%'. $criterio_min. '%" OR proveedor LIKE "%'  .$criterio_min. '%" OR
                            sucursal LIKE "%'  .$criterio_min. '%" OR  total LIKE "%'  .$criterio_min. '%" OR 
                            estado LIKE "%'  .$criterio_min. '%" OR  num_factura LIKE "%'  .$criterio_min. '%" ) 
                            and (sucursal = "santa ana")';
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                    
                    $resultado = $sentencia -> fetchAll();
        
                    if(count($resultado)){
                        foreach($resultado as $fila){
                            $filas[] = new facturas_compra($fila['cod_factura_compra'],$fila['num_factura'], $fila['tipo'],
                                                        $fila['fecha'], null, $fila['proveedor'], $fila['total'], 
                                                        $fila['estado'], $fila['sucursal'], null);
                        }
                    }
        
        
                }catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }else{ echo 'No hay conexion :(';}
            
            return $filas;
        }
        public static function insertar_pago($conexion){
            $remito_insertado = false;
            
            if (isset($conexion)){
                try{
        
                    $sql = "insert into pagos (fecha,estado,sucursal) values
                    (NOW(),0,1)";
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $remito_insertado = $sentencia -> execute();
                    
                } catch(PDOException $ex){
                    print 'ERROR INSCo' . $ex -> getMessage();
                }
                
                return $remito_insertado;
            }
            else{
                echo 'No hubo conexion!!';
            }
            
        }
        public static function obtener_ultimo_id($conexion){        
            if (isset($conexion)){
                $id = 0;
                try{
                    $sql= 'select  MAX(cod_pago) from pagos';
                    
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
        public static function estado_pago ($conexion,$cod_pago){
        
            $pago_actualizado = false;
            
            if (isset($conexion)){
                try{
                    $sql = 'update pagos set estado = 1 WHERE cod_pago =' . $cod_pago;
                    
                    
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    
                    
                    $pago_actualizado = $sentencia -> execute();
                    
                } catch(PDOException $ex){
                    print 'ERROR INSCo' . $ex -> getMessage();
                }
                
                return $pago_actualizado;
            }
            else{
                echo 'No hubo conexion!!';
            }
            
        }
    
        public static function eliminar_falsos($conexion){
            if (isset($conexion)){
            
                try{
                    $sql= 'delete from pagos where estado = 0';
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                        
                    print 'se ha borrado con exito!';
                }
        
                catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }
        }
        public static function insertar_detalle_pago($conexion,$cod_pago,$nombre,$marca,$cantidad, $precio_unitario){
        
            $detalle_insertado = false;
          
            if (isset($conexion)){
                try{
                    $sql = "insert into detalle_pagos (cod_pago,nombre,marca,cantidad,precio_unitario) values
                    (:cod_pago,:nombre,:marca,:cantidad, :precio)";
                    
                    $cod_pagotemp = $cod_pago;
                    $nombretemp = $nombre;
                    $marcatemp = $marca;
                    $cantidadtemp = $cantidad;
                    $preciotemp = $precio_unitario;
                    
    
                    $sentencia = $conexion ->prepare($sql);
    
                    
                    $sentencia -> bindParam(':cod_pago', $cod_pagotemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':nombre', $nombretemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':marca', $marcatemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':cantidad', $cantidadtemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':precio', $preciotemp, PDO::PARAM_STR);
    
                    
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
        public static function cargar_detalles($cod_fac, $cod_pago){

            $filas = repositorio_factura::obtener_detalles_factura(Conexion::obtenerConexion(),$cod_fac);
    
            if(count($filas)){
    
                foreach($filas as $fila){
    
                   
                    $marca=$fila -> obtener_marca();
                    $nombre = $fila -> obtener_nombre();
                    $cantidad = $fila -> obtener_cantidad();
                    $precio_unitario = $fila -> obtener_precio_unitario();
                    self::insertar_detalle_pago( Conexion :: obtenerConexion(),$cod_pago,$nombre,$marca,$cantidad,$precio_unitario); 
    
    
                    }
    
            }
    
        }
        public static function pago_cargado($conexion,$cod_pago,$num_factura,$metodo_pago,$proveedor,$total,$cod_factura_compra){
        
            $remito_actualizado = false;
            
            if (isset($conexion)){
                try{
                    $sql = 'update pagos set num_factura = :num_factura, metodo_pago = :metodo_pago, proveedor = :proveedor, total = :total,
                    cod_factura_compra = :cod_factura_compra  WHERE cod_pago =' . $cod_pago;
                    
                    $proveedortemp = $proveedor;
                    $totaltemp = $total;
                    $cod_octemp = $cod_factura_compra;
                    $metodotemp = $metodo_pago;
                    $numfactemp = $num_factura;
        
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> bindParam(':num_factura', $numfactemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':metodo_pago', $metodotemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':proveedor', $proveedortemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':total', $totaltemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':cod_factura_compra', $cod_factura_compra, PDO::PARAM_STR);
                    
                    
                    $remito_actualizado = $sentencia -> execute();
                    
                } catch(PDOException $ex){
                    print 'ERROR INSCo' . $ex -> getMessage();
                }
                
                return $remito_actualizado;
            }
            else{
                echo 'No hubo conexion!!';
            }
            
        }
        public static function insertar_egreso_factura($conexion,$monto){
        
            $insertado = false;
        
        if (isset($conexion)){
            try{
                $sql = 'insert into egresos(motivo,fecha,monto) values
                 ("Factura", NOW(), :monto)';
                


               
                $montotemp = $monto;
                
                
                $sentencia = $conexion ->prepare($sql);

                
                $sentencia -> bindParam(':monto', $montotemp, PDO::PARAM_STR);
                
                
                
            $inventario_insertado = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $insertado;
        }
        else{
            echo 'No hubo conexion !!!';
        }
        
    } 
    }
?>