<?php
    
    include_once '../conexion.class.php';
    include_once '../clases/ranking_prod.class.php';
    include_once '../clases/informe_ingresos.class.php';
    include_once '../clases/detalle_venta.class.php';
    require_once("../phpChart_Lite/phpChart_Lite/conf.php");


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
/* OBTIENE EL NUMERO DE VENTAS EN UN MES PARA LUEGO UTILIZARLO PARA EL GRAFICO */
    public static function obtener_numero_ventas($conexion,$mes){
        if (isset($conexion)){ 
        $ventas = "";
    
        try{
                
                $sql = 'select count(cod_venta) from ventas where fecha LIKE "%'.$mes. '%"' ;
                
                $sentencia = $conexion -> prepare($sql);
    
                $sentencia -> execute();

                $resultado = $sentencia -> fetchColumn() ;
                    
                $ventas= intval($resultado);

            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
        }
        else{
            echo 'No hubo conexion!!';
        }
        return $ventas;
    }
/* OBTIENE EL GRAFICO HAY QUE HACER QUE ESTO SEA GENERICO */
    public static function obtener_grafica_ventas($conexion/* ,$mes_inicio */){
        if (isset($conexion)){ 
        $ventas = "";
        
        try{

            $s1 = array(
                array(6,repositorio_ventas::obtener_numero_ventas(Conexion::obtenerConexion(),"-06-"),'Junio'),
                array(7,repositorio_ventas::obtener_numero_ventas(Conexion::obtenerConexion(),"-07-"),'Julio'),
                array(8,repositorio_ventas::obtener_numero_ventas(Conexion::obtenerConexion(),"-08-"),'Agosto'),
                array(9,repositorio_ventas::obtener_numero_ventas(Conexion::obtenerConexion(),"-09-"),'Septiembre'),
                array(10,repositorio_ventas::obtener_numero_ventas(Conexion::obtenerConexion(),"-10-"),'Octubre'),
                array(11,repositorio_ventas::obtener_numero_ventas(Conexion::obtenerConexion(),"-11-"),'Noviembre'));

            $ventas = new C_PhpChartX(array($s1),'chart1');
            $ventas->set_title(array('text'=>'Ultimos cinco meses'));
            $ventas->add_plugins(array('cursor','pointLabels','barRenderer','categoryAxisRenderer'),true);
            $ventas->set_animate(true);
            $ventas->set_series_default(array(
        'pointLabels'=> array(
            'show'=> true,
            'escapeHTML'=> false,
            'ypadding'=> -15 
        )
    ));  
            $ventas->set_animate(true);
            
            

            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
        }
        else{
            echo 'No hubo conexion!!';
        }
        return $ventas->draw(900, 500);
    }
/* OBTIENE CANTIDAD DE EGRESOS EN UN MES */
    public static function obtener_ingresos($conexion,$mes){
        if (isset($conexion)){ 
        $importes = "";
    
        try{
                
                $sql = 'select sum(importe) from ventas where estado = 1 and (fecha LIKE "%' .$mes. '%")' ;
                
                $sentencia = $conexion -> prepare($sql);
    
                $sentencia -> execute();

                $resultado = $sentencia -> fetchColumn() ;
                    
                $importes= intval($resultado);

            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
        }
        else{
            echo 'No hubo conexion!!';
        }
        return $importes;
    }
/* OBTIENE EL GRAFICO HAY QUE HACER QUE ESTO SEA GENERICO (QUE SE INGRESE EL MES ACTUAL Y SE CALCULEN 5 PARA ATRAS) */
    public static function obtener_grafica_ingresos($conexion/* ,$mes_inicio */){
        if (isset($conexion)){ 
        $importes = "";
        
        try{

            $s1 = array(
                array(6,repositorio_ventas::obtener_ingresos(Conexion::obtenerConexion(),"-06-"),'Junio'),
                array(7,repositorio_ventas::obtener_ingresos(Conexion::obtenerConexion(),"-07-"),'Julio'),
                array(8,repositorio_ventas::obtener_ingresos(Conexion::obtenerConexion(),"-08-"),'Agosto'),
                array(9,repositorio_ventas::obtener_ingresos(Conexion::obtenerConexion(),"-09-"),'Septiembre'),
                array(10,repositorio_ventas::obtener_ingresos(Conexion::obtenerConexion(),"-10-"),'Octubre'),
                array(11,repositorio_ventas::obtener_ingresos(Conexion::obtenerConexion(),"-11-"),'Noviembre'));

            $importes = new C_PhpChartX(array($s1),'chart1');
            $importes->set_title(array('text'=>'Ultimo semestre - Eje Vertical:$$
            - Eje Horizontal:Meses'));
            $importes->add_plugins(array('cursor','pointLabels','barRenderer','categoryAxisRenderer'),true);
            $importes->set_animate(true);
            $importes->set_series_default(array(
            'pointLabels'=> array(
            'show'=> true,
            'escapeHTML'=> false,
            'ypadding'=> -15)));  


            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
        }
        else{
            echo 'No hubo conexion!!';
        }
        return $importes->draw(900, 500);
    }
    public static function obtener_grilla_informe($conexion){
        
        $filas = [];
    
        
        if (isset($conexion)){
    
            try{
                $sql= 'select * from grilla_informes_ingresos ';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new informe_ingresos ($fila['MES'],$fila['CANTIDAD DE VENTAS'],$fila['TOTAL INGRESOS']);
                    }
                }

            }catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $filas;
    }
    public static function obtener_ingresos_excel($conexion){
 
        if (isset($conexion)){
    
            try{

                $sql= 'select * from grilla_informes_ingresos ';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();

                $titulos = ['Numero','Mes','Cantidad Operaciones','Total Egresos'];
    
                $resultadoaux = [];
    
                $resultadoaux[0] = $titulos;
            
                if(count($resultado)){ 
                    $arrlength = count($resultado);
                    for($i = 0; $i < $arrlength; $i=$i+1) {
                        $fila = $resultado[$i];
                        $arrlengthinterno = count($fila);
                        $filaaux = [];
                        for($j = 0; $j < $arrlengthinterno/2; $j=$j+1) {
                            $filaaux[$j] = $fila[$j];
                        }
                        $resultadoaux[$i+1] = $filaaux;
                    }
                }

            }catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $resultadoaux;
    }

    
}