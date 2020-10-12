<?php
    
    include_once '../conexion.class.php';
    include_once '../clases/ventas.class.php';
    include_once '../clases/detalle_venta.class.php';


    class repositorio_ventas{
/* 
        public static function obtener_venta_filtradas($conexion,$criterio){
        
            $filas = [];
            $criterio_min=strtolower($criterio);
            
            if (isset($conexion)){
        
                try{
                    $sql= 'select * from grilla_ventas where (cod_venta LIKE "%'.$criterio_min. '%" OR 
                            sucursal LIKE "%'. $criterio_min. '%" OR cliente LIKE "%'  .$criterio_min. '%" OR
                            fecha LIKE "%'  .$criterio_min. '%"OR importe LIKE "%'  .$criterio_min. '%");
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                    
                    $resultado = $sentencia -> fetchAll();
        
                    if(count($resultado)){
                        foreach($resultado as $fila){
                            $filas[] = new ventas($fila['cod_venta'],$fila['fecha'], $fila['num_factura'],
                                                        $fila['tipo_factura'],$fila['cod_cliente']);
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
        
        
        */
        
  
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

    }