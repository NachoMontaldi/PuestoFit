<?php 
    
    include_once '../conexion.class.php';
    include_once 'detalle_ordenes_de_compra.class.php'; 
    include_once 'detalle_facturas_compra.class.php'; 
    include_once 'cotizaciones.class.php';
    include_once 'ordenes_de_compra.class.php';
    include_once 'repositorio_ordenes_de_compra.class.php';
    include_once 'facturas_compra.class.php';

    class repositorio_factura{

        public static function obtener_facturas_compra($conexion){
            
            $filas = [];
            if (isset($conexion)){
                try{
                    $sql= 'select * from facturas_compra where estado!=0 and sucursal=1 ;';
                    
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

        public static function obtener_oc($conexion){
        
            $filas = [];
    
            if (isset($conexion)){
            
                try{
                    $sql= 'select * from ordenes_de_compra where estado= 1';
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                    
                    $resultado = $sentencia -> fetchAll();
                    
                    if(count($resultado)){
                        foreach($resultado as $fila){
                            $filas[] = new ordenes_de_compra($fila['cod_orden_de_compra'],$fila['fecha_emision'],
                                    $fila['fecha_entrega_estimada'], $fila['proveedor'], $fila['total'],
                                    $fila['estado'],$fila['sucursal'],$fila['cod_cotizacion']);
                        }
                    }
                    
                }catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }else{ echo 'No hay conexion :(';}
            
            return $filas;
        }
    
    public static function estado_factura($conexion,$cod_factura){
        
            $factura_actualizada = false;
            
            if (isset($conexion)){
                try{
                    $sql = 'update facturas_compra set estado = 1 WHERE cod_factura_compra =' . $cod_factura;
                    
                    
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    
                    
                    $factura_actualizada = $sentencia -> execute();
                    
                } catch(PDOException $ex){
                    print 'ERROR INSCo' . $ex -> getMessage();
                }
                
                return $factura_actualizada;
            }
            else{
                echo 'No hubo conexion!!';
            }
            
        }

    public static function cargar_detalles($cod_oc, $cod_factura){

            $filas = repositorio_ordenes_de_compra::obtener_detalles_oc(Conexion::obtenerConexion(),$cod_oc);
    
            if(count($filas)){
    
                foreach($filas as $fila){
    
                   
                    $marca=$fila -> obtener_marca();
                    $nombre = $fila -> obtener_nombre();
                    $cantidad = $fila -> obtener_cantidad();
                    $precio_unitario = $fila -> obtener_precio_unitario();
                    self::insertar_detalle_factura( Conexion :: obtenerConexion(),$cod_factura,$nombre,$marca,$cantidad,$precio_unitario); 
    
                    }
    
                }
    
    }
    
    public static function insertar_detalle_factura($conexion,$cod_factura,$nombre,$marca,$cantidad, $precio_unitario){
        
        $detalle_insertado = false;
      
    if (isset($conexion)){
        try{
            $sql = "insert into detalle_facturas_compra (cod_factura_compra,nombre,marca,cantidad,precio_unitario) values
             (:cod_factura_compra,:nombre,:marca,:cantidad, :precio)";
            
            $cod_facturatemp = $cod_factura;
            $nombretemp = $nombre;
            $marcatemp = $marca;
            $cantidadtemp = $cantidad;
            $preciotemp = $precio_unitario;
            

            $sentencia = $conexion ->prepare($sql);

            
            $sentencia -> bindParam(':cod_factura_compra', $cod_facturatemp, PDO::PARAM_STR);
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

public static function insertar_factura($conexion){
    $factura_insertada = false;
    
    if (isset($conexion)){
        try{

            $sql = "insert into facturas_compra (fecha,estado,sucursal) values
             (NOW(),0,1)";
            
            ;
            
            
            $sentencia = $conexion ->prepare($sql);

            
            
            
            
            
            $factura_insertada = $sentencia -> execute();
            
        } catch(PDOException $ex){
            print 'ERROR INSCo' . $ex -> getMessage();
        }
        
        return $factura_insertada;
    }
    else{
        echo 'No hubo conexion en cotizacion!!';
    }
    
}

public static function obtener_ultimo_id($conexion){        
    if (isset($conexion)){
        $id = 0;
        try{
            $sql= 'select  MAX(cod_factura_compra) from facturas_compra';
            
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

public static function eliminar_falsos($conexion){
    if (isset($conexion)){
    
        try{
            $sql= 'delete from facturas_compra where estado = 0';
            
            $sentencia = $conexion ->prepare($sql);
            
            $sentencia -> execute();
                
            print 'se ha borrado con exito!';}

        catch(PDOException $ex){
            print 'ERROR OT' . $ex -> getMessage();
        }
    }
 }
public static function factura_cargada($conexion,$cod_factura,$proveedor,$num_factura,$tipo,
                                        $fecha,$total,$cod_oc){
        
    $factura_actualizada = false;
    
    if (isset($conexion)){
        try{
            $sql = 'update facturas_compra set fecha_entrega_estimada = :fecha, proveedor = :proveedor, total = :total,
                    cod_oc = :cod_oc, num_factura = :num_factura, tipo = :tipo  WHERE cod_factura_compra =' . $cod_factura;
            
            $proveedortemp = $proveedor;
            $totaltemp = $total;
            $fechatemp = $fecha;
            $cod_octemp = $cod_oc;
            $num_facturatemp = $num_factura;
            $tipotemp = $tipo;

            $sentencia = $conexion ->prepare($sql);
            
            $sentencia -> bindParam(':proveedor', $proveedortemp, PDO::PARAM_STR);
            $sentencia -> bindParam(':total', $totaltemp, PDO::PARAM_STR);
            $sentencia -> bindParam(':fecha', $fechatemp, PDO::PARAM_STR);
            $sentencia -> bindParam(':cod_oc', $cod_octemp, PDO::PARAM_STR);
            $sentencia -> bindParam(':num_factura', $num_facturatemp, PDO::PARAM_STR);
            $sentencia -> bindParam(':tipo', $tipotemp, PDO::PARAM_STR);
            
            $factura_actualizada = $sentencia -> execute();
            
        } catch(PDOException $ex){
            print 'ERROR INSCo' . $ex -> getMessage();
        }
        
        return $factura_actualizada;
    }
    else{
        echo 'No hubo conexion en detalle pedido!!';
    }
    
}
public static function obtener_factura_filtradas($conexion,$criterio){
        
    $filas = [];

    $criterio_min=strtolower($criterio);
    
    if (isset($conexion)){

        try{
            $sql= 'select * from grilla_facturas_compra where (num_factura LIKE "%'.$criterio_min.'%" OR 
                   tipo LIKE "%'.$criterio_min.'%" OR fecha LIKE "%'.$criterio_min.'%" 
                   OR fecha_entrega_estimada LIKE "%'.$criterio_min.'%" OR cod_oc LIKE "%'.$criterio_min.'%"
                   OR proveedor LIKE "%'.$criterio_min.'%" OR  sucursal LIKE "%'.$criterio_min.'%"
                   OR estado LIKE "%'.$criterio_min.'%") AND (sucursal = "Santa ana")';
            
            $sentencia = $conexion ->prepare($sql);
            
            $sentencia -> execute();
            
            $resultado = $sentencia -> fetchAll();
            
            if(count($resultado)){
                foreach($resultado as $fila){
                    $filas[] = new facturas_compra(null,$fila['num_factura'],$fila['tipo'],
                    $fila['fecha'],$fila['fecha_entrega_estimada'],$fila['proveedor'],null,
                    $fila['estado'],$fila['sucursal'],$fila['cod_oc']);
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
                    $filas[] = new detalle_facturas_compra($fila['cod_det_factura_compra'],$fila['cod_factura_compra'],
                                $fila['nombre'],$fila['marca'], $fila['cantidad'], $fila['precio_unitario']);
                }
            }

            
        }catch(PDOException $ex){
            print 'ERROR OT' . $ex -> getMessage();
        }
    }else{ echo 'No hay conexion :(';}
    
    return $filas;
}

public static function calcular_precios($nro_factura){
        
    $detalles = self :: obtener_detalles_factura(Conexion::obtenerConexion(),$nro_factura);
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

    public static function actualizar_estado_listo_factura($conexion,$cod_factura_compra){
        
    $factura_compra_actualizada = false;
    
    if (isset($conexion)){
        try{

            $sql = 'update facturas_compra set estado = 2 WHERE cod_factura_compra =' . $cod_factura_compra;
            
            $sentencia = $conexion ->prepare($sql);
            
            $factura_compra_actualizada = $sentencia -> execute();
            
        } catch(PDOException $ex){
            print 'ERROR INSCo' . $ex -> getMessage();
        }
        
        return $factura_compra_actualizada;
    }
    else{
        echo 'No hay conexion!!';
    }
    
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
                    and (sucursal = "santa ana") and (estado = "Listo")';
            
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





}