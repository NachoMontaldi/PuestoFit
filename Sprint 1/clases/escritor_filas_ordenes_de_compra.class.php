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
            <td></td>
        </tr><?php
        }
    }

?>