<?php 

include_once '../conexion.class.php';
include_once 'remitos.class.php';
include_once '../clases/detalle_remitos.class.php';

Conexion::abrirConexion();

class repositorio_movimientos_stock {

    public static function cargar_mov_stock($cod_remito){
        
        $detalles = self :: obtener_detalles_remito(Conexion::obtenerConexion(),$cod_remito);
        $total=0;
        if(count($detalles)){

            foreach($detalles as $detalle){
                
                
            $codigo= self::obtener_cod_producto_det_remito(Conexion::obtenerConexion(),$detalle -> obtener_nombre());

            self::insertar_mov_stock(Conexion::obtenerConexion(),$codigo,$detalle -> obtener_cantidad(),
                                    $detalle -> obtener_cod_det_remito());
            
            self::actualizar_cantidad_prod(Conexion::obtenerConexion(),$codigo,$detalle -> obtener_cantidad());
            }

        }
        return $total;
    }

    public static function obtener_remito($conexion,$id){
        
        $fila = [];
        $id_str=strval($id);
    
        if (isset($conexion)){
        
            try{
                $sql= 'select * from remitos where cod_remito=' .$id_str;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
    
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $fila[] = new remitos ($fila['cod_remito'] ,$fila['fecha'],
                        $fila['proveedor'],$fila['total'], $fila['estado'], $fila['sucursal'], 
                        $fila['cod_factura_compra']);
                    }
                } 
            } catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $fila;
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

    public static function obtener_cod_producto_det_remito($conexion,$nombre){
        if (isset($conexion)){ 
           $cod_producto = 0; 
            try{
                
                $sql = 'select cod_prod from inventario where nombre ="'.$nombre.'"';
                
            
                $sentencia = $conexion -> prepare($sql);
    
                $sentencia -> execute();

                $resultado = $sentencia -> fetchColumn() ;
                    
                $cod_producto = intval($resultado);

            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
        }
        else{
            echo 'No hubo conexion!!';
        }
        
        return $cod_producto;
    }

    public static function insertar_mov_stock($conexion,$cod_producto,$cantidad,$cod_det_remito){
        
        $mov_insertado = false;
      
        if (isset($conexion)){
            try{
                $sql = 'insert into movimientos_stock (fecha,cod_producto,tipo,cantidad,cod_det_remito,sucursal) values
                (NOW(),:cod_producto,"compra", :cantidad, :cod_det_remito,1)';
                
    
                $cod_productotemp = $cod_producto;
                $cantidadtemp = $cantidad;
                $cod_det_remitotemp = $cod_det_remito;
        

                $sentencia = $conexion ->prepare($sql);


                $sentencia -> bindParam(':cod_producto', $cod_productotemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':cantidad', $cantidadtemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':cod_det_remito', $cod_det_remitotemp, PDO::PARAM_STR);

                
            $detalle_insertado = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $mov_insertado;
        }
        else{
            echo 'No hubo conexion!!';
        }
    }

    public static function actualizar_cantidad_prod($conexion,$cod_prod,$cantidad){
        $mov_insertado = false;
        
        $cantidad_anterior = self::obtener_cantidad_ant(Conexion::obtenerConexion(),$cod_prod);
        echo $cantidad_anterior;
        $cantidad = $cantidad + $cantidad_anterior;

        if (isset($conexion)){
            try{
                $sql = 'update stock_deposito set cantidad=:cantidad where cod_prod=:cod_prod and cod_deposito=1';
                
                $cod_productotemp = $cod_prod;
                $cantidadtemp = $cantidad;
        

                $sentencia = $conexion ->prepare($sql);

                $sentencia -> bindParam(':cod_prod', $cod_productotemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':cantidad', $cantidadtemp, PDO::PARAM_STR);

                
            $detalle_insertado = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $mov_insertado;
        }
        else{
            echo 'No hubo conexion!!';
        }
    }

    public static function obtener_cantidad_ant($conexion,$cod_prod){
        if (isset($conexion)){ 
            $cantidad = 0; 
             try{
                 
                 $sql = 'select cantidad from stock_deposito where cod_prod ='.$cod_prod;
                 
                 $sentencia = $conexion -> prepare($sql);
     
                 $sentencia -> execute();
 
                 $resultado = $sentencia -> fetchColumn() ;
                     
                 $cantidad= intval($resultado);
 
             } catch(PDOException $ex){
                 print 'ERROR INSCo' . $ex -> getMessage();
             }
         }
         else{
             echo 'No hubo conexion!!';
         }
         
         return $cantidad;
    }
}
?>