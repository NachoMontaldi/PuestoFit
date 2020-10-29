<?php 
    
    include_once '../conexion.class.php';
    include_once '../clases/detalle_facturas_compra.class.php';
    include_once '../clases/remitos.class.php';
    include_once '../clases/detalle_remitos.class.php';


    class repositorio_remito{

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
    //METODO PARA OBTENER REMITOS USADO EN OBTENER_REMITOS_PRINCIPAL
    public static function obtener_remitos($conexion){
            
        $filas = [];
        
        if (isset($conexion)){
        
            try{
                $sql= 'select * from remitos where estado != 0';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new remitos($fila['cod_remito'], $fila['num_remito'],$fila['fecha'], $fila['proveedor'],
                                    $fila['total'], $fila['estado'],$fila ['sucursal'], $fila['cod_factura_compra']);
                    }
                }
                
            }catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :( en obtener remito';}
        
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
    public static function obtener_num_factura($conexion,$cod_factura){
        if (isset($conexion)){
            $num = 0;
            try{
                $sql= 'select num_factura from facturas_compra where cod_factura_compra='.$cod_factura;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchColumn() ;
                
                $num = strval($resultado);
                    

                
            }catch(PDOException $ex){
                print 'ERROR UID' . $ex -> getMessage();
            }
        }else{ echo 'no';}
        
        return $num;
    }

    public static function obtener_facturas_compra($conexion){
            
        $filas = [];
        if (isset($conexion)){
            try{
                $sql= 'select * from facturas_compra where estado!=0;';
                
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
    public static function obtener_remito_filtradas($conexion,$criterio){
        
        $filas = [];
    
        $criterio_min=strtolower($criterio);
        
        if (isset($conexion)){
    
            try{
                $sql= 'select * from grilla_remito where (num_remito LIKE "%'.$criterio_min.'%" OR 
                       num_factura LIKE "%'.$criterio_min.'%" OR fecha LIKE "%'.$criterio_min.'%" 
                       OR proveedor LIKE "%'.$criterio_min.'%" OR  sucursal LIKE "%'.$criterio_min.'%"
                       OR estado LIKE "%'.$criterio_min.'%") AND (sucursal = "Santa ana")';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new remitos($fila['cod_remito'],$fila['num_remito'],$fila['fecha'],
                        $fila['proveedor'],null,
                        $fila['estado'],$fila['sucursal'],$fila['num_factura']);
                    }
                }
    
                
            }catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $filas;
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

    public static function calcular_precios($cod_remito){
    
        $detalles = self :: obtener_detalles_remito(Conexion::obtenerConexion(),$cod_remito);
        $total=0;
        if(count($detalles)){

            foreach($detalles as $detalle){
                
                
                $subtotal = $detalle -> obtener_precio_unitario() * $detalle -> obtener_cantidad();
                $total= $total + $subtotal;
            }

            }
        return $total;
        
    }

    public static function insertar_remito($conexion){
        $remito_insertado = false;
        
        if (isset($conexion)){
            try{
    
                $sql = "insert into remitos (fecha,estado,sucursal) values
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
                $sql= 'select  MAX(cod_remito) from remitos';
                
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

    public static function cargar_detalles($cod_oc, $cod_remito){

        $filas = repositorio_factura::obtener_detalles_factura(Conexion::obtenerConexion(),$cod_oc);

        if(count($filas)){

            foreach($filas as $fila){

               
                $marca=$fila -> obtener_marca();
                $nombre = $fila -> obtener_nombre();
                $cantidad = $fila -> obtener_cantidad();
                $precio_unitario = $fila -> obtener_precio_unitario();
                self::insertar_detalle_remito( Conexion :: obtenerConexion(),$cod_remito,$nombre,$marca,$cantidad,$precio_unitario); 


                }

        }

    }

    public static function insertar_detalle_remito($conexion,$cod_remito,$nombre,$marca,$cantidad, $precio_unitario){
        
        $detalle_insertado = false;
      
        if (isset($conexion)){
            try{
                $sql = "insert into detalle_remitos (cod_remito,nombre,marca,cantidad,precio_unitario) values
                (:cod_remito,:nombre,:marca,:cantidad, :precio)";
                
                $cod_remitotemp = $cod_remito;
                $nombretemp = $nombre;
                $marcatemp = $marca;
                $cantidadtemp = $cantidad;
                $preciotemp = $precio_unitario;
                

                $sentencia = $conexion ->prepare($sql);

                
                $sentencia -> bindParam(':cod_remito', $cod_remitotemp, PDO::PARAM_STR);
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

    public static function estado_remito($conexion,$cod_remito){
        
        $remito_actualizado = false;
        
        if (isset($conexion)){
            try{
                $sql = 'update remitos set estado = 1 WHERE cod_remito =' . $cod_remito;
                
                
                
                $sentencia = $conexion ->prepare($sql);
                
                
                
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

    public static function eliminar_falsos($conexion){
        if (isset($conexion)){
        
            try{
                $sql= 'delete from remitos where estado = 0';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                    
                print 'se ha borrado con exito!';
            }
    
            catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }
    }

    public static function remito_cargado($conexion,$cod_remito,$num_remito,$proveedor,$total,$cod_factura_compra){
        
    $remito_actualizado = false;
    
    if (isset($conexion)){
        try{
            $sql = 'update remitos set num_remito = :num_remito, proveedor = :proveedor, total = :total,
            cod_factura_compra = :cod_factura_compra  WHERE cod_remito =' . $cod_remito;
            
            $num_remitotemp = $num_remito;
            $proveedortemp = $proveedor;
            $totaltemp = $total;
            $cod_octemp = $cod_factura_compra;

            $sentencia = $conexion ->prepare($sql);
            
            $sentencia -> bindParam(':num_remito', $num_remitotemp, PDO::PARAM_STR);
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

public static function obtener_facturas_compra_remito($conexion){
            
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
   
}