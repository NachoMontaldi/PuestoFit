<?php

    include_once '../conexion.class.php';
    include_once '../config.inc.php';
    include_once '../clases/repositorio_ordenes_de_compra.class.php';
    include_once '../clases/ordenes_de_compra.class.php';


    class escritor_filas_ordenes_de_compra{
        
        public static function escribir_ordenes_de_compra(){
            
            $filas = repositorio_ordenes_de_compra::obtener_ordenes_de_compra(Conexion::obtenerConexion());
            
            if(count($filas)){

                foreach($filas as $fila){
                    self::escribir_orden_de_compra($fila);
                }

            }            

        }

        public static function escribir_orden_de_compra($fila){
            if(!isset($fila)){
    
                return;
            }
            ?>
        <tr>
            <td class="text-center"> <?php echo $fila ->obtener_cod_orden_de_compra() ?></td>
            <td class="text-center"> <?php echo $fila ->obtener_fecha_emision() ?></td>
            <td class="text-center"> <?php echo $fila ->obtener_fecha_entrega_estimada() ?></td>
            <td class="text-center"> <?php echo $fila ->obtener_proveedor() ?></td> 
            <td class="text-center"> <?php echo $fila ->obtener_total() ?></td>
            <td class="text-center"> <?php echo $fila ->obtener_estado() ?></td>
            <td>
                <form method="post" action="<?php echo ruta_detalle_orden_de_compra;?>">
                    <button type="submit" style="background-color:light-gray; padding:3% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_cod_cotizacion(); ?>">Ver detalle</button>
                </form>               
            </td>
        </tr><?php
        }
    }   
?>