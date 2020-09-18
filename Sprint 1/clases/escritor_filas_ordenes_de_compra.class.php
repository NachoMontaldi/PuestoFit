<?php

    include_once '../conexion.class.php';
    include_once '../config.inc.php';
    include_once '../clases/repositorio_ordenes_de_compra.class.php';
    include_once '../clases/repositorio_cotizacion.class.php';
    include_once '../clases/ordenes_de_compra.class.php';


    class escritor_filas_ordenes_de_compra {
        
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
            <td class="text-center"> <?php echo $fila ->obtener_proveedor() ?></td> 
            <td class="text-center"> <?php echo $fila ->obtener_total() ?></td>

            <td>
                <form method="post" action="<?php echo ruta_detalle_orden_de_compra;?>">
                    <button type="submit" style="background-color:light-gray; padding:3% ; font-size: 14px;
                    border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" 
                    value="<?php echo $fila->obtener_cod_orden_de_compra();?>">Detalle</button>
                    <input type="hidden" name="proveedor_od" id="proveedor_od" value="<?php echo $fila -> obtener_proveedor();?>">
                </form>                
            </td>
        </tr><?php
        }

        /*escribir detalleS de ordenes de compra*/
        public static function escribir_detalles_orden_de_compra($id) {

            $filas = repositorio_ordenes_de_compra::obtener_detalles_oc(Conexion::obtenerConexion(),$id);

            if(count($filas)){

                foreach($filas as $fila){

                    self::escribir_detalle_orden_de_compra($fila);
                    

                }
    
            } 

        }

        public static function escribir_detalle_orden_de_compra($fila){
                
            if(!isset($fila)){

                    return;
            }

                ?>
                            
            <tr>
                <td class="text-center"> <?php echo $fila ->obtener_cod_det_orden_de_compra() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_nombre() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_marca() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_cantidad() ?>  </td> 
                <td class="text-center"> <?php echo $fila ->obtener_precio_unitario() ?></td>
                <td>
                <?php
                    if(isset($_POST['ver_detalle'])){
                                                    
                    $subtotal= $fila -> obtener_cantidad() * $fila -> obtener_precio_unitario();
                        echo "$".$subtotal;
                        

                    }else{
                            print "0 $";
                    }
                ?>   
                </td>    
            </tr>
        <?php
        }

        

        /*escribir el detalle de cotizacion para cargar en nueva orden de compra*/ 
        public static function escribir_detalles_cotizacion_oc($id){

            $filas = repositorio_cotizacion::obtener_detalles(Conexion::obtenerConexion(),$id);

            if(count($filas)){
                
                foreach($filas as $fila){

                    self::escribir_detalle_cotizacion_oc($fila);
                }
    
            }    

        }

        public static function escribir_detalle_cotizacion_oc($fila){
                
            if(!isset($fila)){

                    return;
            }

                ?>
            <tr>
                    <td class="text-center"> <?php echo $fila ->obtener_nombre() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_marca() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_cantidad() ?>  </td> 
                    <td class="text-center"> <?php echo $fila ->obtener_precio_unitario() ?></td>
                    <td>
                    <?php
                        if(isset($_POST['seleccionar'])){
                                                        
                            $subtotal= $fila -> obtener_cantidad() * $fila -> obtener_precio_unitario();
                             echo $subtotal." $";

                        }else{
                                print "0 $";
                        }
                    ?>   
                    </td>    
            </tr>
        <?php
        }

        public static function obtener_proveedor($id_oc){
            
        }
    }   
?>