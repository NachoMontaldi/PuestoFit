<?php
    include_once '../conexion.class.php';
    include_once 'ordenes_de_compra.class.php';

    class repositorio_ordenes_de_compra {

        public static function obtener_ordenes_de_compra($conexion){
            
            $filas = [];
            if (isset($conexion)){
                try{
                    $sql= 'select * from ordenes_de_compra;';
                    
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
    }

?>