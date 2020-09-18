<?php 
    
    include_once '../conexion.class.php';
    include_once '../clases/detalle_facturas_compra.class.php';
    include_once '../clases/remitos.class.php';


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
            $sql= 'select * from remitos';
            
            $sentencia = $conexion ->prepare($sql);
            
            $sentencia -> execute();
            
            $resultado = $sentencia -> fetchAll();
            
            if(count($resultado)){
                foreach($resultado as $fila){
                    $filas[] = new remitos($fila['cod_remito'], $fila['fecha'], $fila['proveedor'],
                                  $fila['total'], $fila['estado'], $fila['cod_factura']);
                }
            }
            
        }catch(PDOException $ex){
            print 'ERROR OT' . $ex -> getMessage();
        }
    }else{ echo 'No hay conexion :( en obtener remito';}
    
    return $filas;
}

    }