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
                            $fila['observaciones'],$fila['sucursal'], $fila['fecha'], $fila['proveedor'], 
                            $fila['total'],$fila['estado'],  $fila['cod_factura_compra']);
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
                            $fila['observaciones'],$fila['sucursal'], $fila['fecha'],  $fila['proveedor'], 
                            $fila['total'],$fila['estado'],null);
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
                            estado LIKE "%'  .$criterio_min. '%" OR  num_factura LIKE "%'  .$criterio_min. '%" OR
                            tipo LIKE "%'  .$criterio_min. '%") 
                            and (sucursal = "santa ana") and (estado="Pendiente")';
                    
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
    public static function pago_cargado($conexion,$cod_pago,$num_factura,$metodo_pago,$observaciones,$proveedor,$total,
                                        $cod_factura_compra){
        
            $remito_actualizado = false;
            
            if (isset($conexion)){
                try{
                    $sql = 'update pagos set num_factura = :num_factura, metodo_pago = :metodo_pago, 
                    observaciones = :observaciones, proveedor = :proveedor, total = :total,
                    cod_factura_compra = :cod_factura_compra  WHERE cod_pago =' . $cod_pago;
                    
                    $proveedortemp = $proveedor;
                    $totaltemp = $total;
                    $cod_octemp = $cod_factura_compra;
                    $metodotemp = $metodo_pago;
                    $observacionestemp = $observaciones;
                    $numfactemp = $num_factura;
        
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> bindParam(':num_factura', $numfactemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':metodo_pago', $metodotemp, PDO::PARAM_STR);
                    $sentencia -> bindParam(':observaciones', $observacionestemp, PDO::PARAM_STR);
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
    public static function actualizar_estado_listo_pago($conexion,$cod_pago){
        
        $pago_actualizado = false;
        
        if (isset($conexion)){
            try{
    
                $sql = 'update pagos set estado = 2 WHERE cod_pago =' . $cod_pago;
                
                $sentencia = $conexion ->prepare($sql);
                
                $pago_actualizado = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $pago_actualizado;
        }
        else{
            echo 'No hay conexion!!';
        }
        
    }
    
    public static function obtener_cod_pago($conexion,$cod_factura_compra){        
        if (isset($conexion)){
            $id = 0;
            try{
                $sql= 'select cod_pago from pagos where cod_factura_compra=' .$cod_factura_compra;
                
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
     /* OBTIENE CANTIDAD DE EGRESOS EN UN MES */
     public static function obtener_egresos($conexion,$mes){
        if (isset($conexion)){ 
        $total = "";
    
        try{
                
                $sql = 'select sum(total) from pagos where fecha LIKE "%' .$mes. '%"' ;
                
                $sentencia = $conexion -> prepare($sql);
    
                $sentencia -> execute();

                $resultado = $sentencia -> fetchColumn() ;
                    
                $total= intval($resultado);

            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
        }
        else{
            echo 'No hubo conexion!!';
        }
        return $total;
    }
/* OBTIENE EL GRAFICO HAY QUE HACER QUE ESTO SEA GENERICO */
    public static function obtener_grafica_egresos($conexion/* ,$mes_inicio */){
        if (isset($conexion)){ 
        $total = "";
        
        try{

            $s1 = array(
                array(6,repositorio_pago::obtener_egresos(Conexion::obtenerConexion(),"-06-"),'Junio'),
                array(7,repositorio_pago::obtener_egresos(Conexion::obtenerConexion(),"-07-"),'Julio'),
                array(8,repositorio_pago::obtener_egresos(Conexion::obtenerConexion(),"-08-"),'Agosto'),
                array(9,repositorio_pago::obtener_egresos(Conexion::obtenerConexion(),"-09-"),'Septiembre'),
                array(10,repositorio_pago::obtener_egresos(Conexion::obtenerConexion(),"-10-"),'Octubre'),
                array(11,repositorio_pago::obtener_egresos(Conexion::obtenerConexion(),"-11-"),'Noviembre'));

            $total = new C_PhpChartX(array($s1),'chart1');
            $total->set_title(array('text'=>'Ultimo semestre - 
            Eje Vertical:$$
            - Eje Horizontal:Meses '));
            $total->add_plugins(array('cursor','pointLabels','barRenderer','categoryAxisRenderer'),true);
            $total->set_animate(true);
            $total->set_series_default(array(
        'pointLabels'=> array(
            'show'=> true,
            'escapeHTML'=> false,
            'ypadding'=> -15)));  

            $total->set_animate(true);
            

            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
        }
        else{
            echo 'No hubo conexion!!';
        }
        return $total->draw(900, 500);
    }
    public static function obtener_grilla_informe($conexion){
        
        $filas = [];
    
        
        if (isset($conexion)){
    
            try{
                $sql= 'select * from grilla_informes_egresos ';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new informe_ingresos ($fila['MES'],$fila['CANTIDAD DE OPERACIONES'],$fila['TOTAL EGRESOS']);
                    }
                }

            }catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $filas;
    }


}

?>