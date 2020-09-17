<?php 
    
    include_once '../conexion.class.php';
    include_once 'detalle_ordenes_de_compra.class.php'; 
    include_once 'cotizaciones.class.php';
    include_once 'ordenes_de_compra.class.php';

    class repositorio_factura{


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
                                    $fila['estado'],$fila['cod_cotizacion']);
                        }
                    }
                    
                }catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }else{ echo 'No hay conexion :(';}
            
            return $filas;
        }





    }