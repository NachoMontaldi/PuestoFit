<?php



include_once '../conexion.class.php';
include_once '../clases/repositorio_factura.class.php';
include_once '../config.inc.php';
include_once '../clases/facturas_compra.class.php';
include_once '../clases/ordenes_de_compra.class.php';


class escritor_factura{

public static function escribir_ocs(){
        
        $filas = repositorio_factura::obtener_oc(Conexion::obtenerConexion());
        
        if(count($filas)){

            foreach($filas as $fila){
                self::escribir_oc($fila);
            }

            }            

        }

public static function escribir_oc($fila){
            if(!isset($fila)){
    
                return;
            }
            ?>
        <tr>
                <td class="text-center"> <?php echo $fila ->obtener_cod_orden_de_compra() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_fecha_emision() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_proveedor() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_total() . " $" ?>  </td>
                <td>
                    <form method="post" action="<?php echo ruta_factura_registrar; ?>">

                        <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="seleccionar" value="<?php echo $fila->obtener_cod_orden_de_compra(); ?>" >Seleccionar</button>
                        <input  type="hidden" name="proveedor"  id="proveedor" value="<?php echo $fila -> obtener_proveedor() ;?>">

                    </form>
                </td>
        </tr>
    <?php
        }

public static function escribir_detalles_oc($id){

            $filas = repositorio_factura::obtener_detalles_oc(Conexion::obtenerConexion(),$id);

            if(count($filas)){
                
                foreach($filas as $fila){

                    self::escribir_detalle_oc($fila);
                }
    
                }    

            }

public static function escribir_detalle_oc($fila){
                if(!isset($fila)){

                    return;
                }

                ?>
            <tr>
                    <td class="text-center" widht= 20%> <?php echo $fila ->obtener_nombre() ?>  </td>
                    <td class="text-center" widht= 20%> <?php echo $fila ->obtener_marca() ?>  </td>
                    <td class="text-center" widht= 20%> <?php echo $fila ->obtener_precio_unitario() . " $"?>  </td>
                    <td class="text-center" widht= 20%> <?php echo $fila ->obtener_cantidad() ?>  </td>
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
                    <!--<td>
                        <form method="post" action="<?php// echo $_SERVER['PHP_SELF'] ?>">
                            <button type="submit" style="background-color:rgba(177, 60, 30, 0.9); padding:5% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="eliminar" name="eliminar" value="<?php echo $fila-> obtener_cod_det_orden_de_compra(); ?>" widht= 5%>Eliminar</button>
                        </form>
                    </td> -->
                    
            </tr>
        <?php
                }

}