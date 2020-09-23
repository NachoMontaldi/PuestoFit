<?php



include_once '../conexion.class.php';
include_once '../clases/repositorio_factura.class.php';
include_once '../config.inc.php';
include_once '../clases/facturas_compra.class.php';
include_once '../clases/ordenes_de_compra.class.php';
include_once '../clases/repositorio_pedido_reposicion.class.php';

class escritor_factura{

//escritores facturas//////////////////////////////////////////////////////////////////////////////////
public static function escribir_facturas(){
        
    $filas = repositorio_factura::obtener_facturas_compra(Conexion::obtenerConexion());
    
    if(count($filas)){

        foreach($filas as $fila){
            self::escribir_factura($fila);
        }

    }            

}

public static function escribir_factura($fila){
        if(!isset($fila)){

            return;
        }
        ?>
    <tr>
        <td class="text-center"> <?php echo $fila ->obtener_numero_factura() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_tipo() ?>  </td>
        <td class="text-center"> <?php 
            $sucursal= repositorio_factura::obtener_sucursal(Conexion::obtenerConexion(),$fila ->obtener_sucursal());
            echo $sucursal; ?> 
        </td>
        <td class="text-center"> <?php if($fila ->obtener_estado() == 1){
                                
                                print "Pendiente";

                            }elseif($fila ->obtener_estado() == 2){
                            print "Listo";
                        }  ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_cod_orden_de_compra() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_proveedor() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_fecha() ?>  </td>                
        <td class="text-center"> <?php echo $fila ->obtener_fecha_entrega_estimada() ?>  </td>
        <td>
            <form method="post" action="<?php echo ruta_detalle_factura_compra; ?>">

                <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_numero_factura(); ?>" >Detalle</button>
                <input  type="hidden" name="proveedor"  id="proveedor" value="<?php echo $fila -> obtener_proveedor() ;?>">
                <input  type="hidden" name="total"  id="total" value="<?php echo $fila -> obtener_total() ;?>">
                <input  type="hidden" name="tipo"  id="tipo" value="<?php echo $fila -> obtener_tipo() ;?>">
                <input  type="hidden" name="cod_factura"  id="cod_factura" value="<?php echo $fila -> obtener_cod_factura_compra() ;?>">
            </form>
        </td>
    </tr>
<?php
    }
////escritor detalle de factura
public static function escribir_detalles_factura($id) {

    $filas = repositorio_factura::obtener_detalles_factura(Conexion::obtenerConexion(),$id);

    if(count($filas)){

        foreach($filas as $fila){

            self::escribir_detalle_factura($fila);
            

        }

    } 

}

public static function escribir_detalle_factura($fila){
        
    if(!isset($fila)){

            return;
    }

        ?>
                    
    <tr>
        <td class="text-center"> <?php echo $fila ->obtener_cod_det_factura_compra() ?>  </td>
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
                    print "$0";
            }
        ?>   
        </td>    
    </tr>
<?php
}



//escritores ordenes de compra////////////////////////////////////////////////////////////////////////
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
                <td class="text-center"> <?php echo $fila ->obtener_cod_orden_de_compra() ?></td>
                <td class="text-center"> <?php echo $fila ->obtener_fecha_emision() ?></td>
                <td class="text-center"> <?php echo $fila ->obtener_proveedor() ?></td>
                <td class="text-center"> <?php echo $fila ->obtener_total() . " $" ?></td>
                <td> <?php

                    $sucursal= repositorio_pedido_reposicion::obtener_sucursal(Conexion::obtenerConexion(),$fila ->obtener_sucursal());
                    echo $sucursal;

                ?>
                </td> 

                <td>
                    <form method="post" action="<?php echo ruta_factura_registrar; ?>">

                        <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="seleccionar" value="<?php echo $fila->obtener_cod_orden_de_compra(); ?>" >Seleccionar</button>
                        <input  type="hidden" name="proveedor"  id="proveedor" value="<?php echo $fila -> obtener_proveedor() ;?>">
                        <input  type="hidden" name="sucursal"  id="sucursal" value="<?php echo $sucursal ;?>">
                        <input  type="hidden" name="total"  id="total" value="<?php echo $fila -> obtener_total() ;?>">

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
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ///BUSCADOR

public static function escribir_filas_filtradas_facturas($criterio){
                                    
            $filas = repositorio_factura::obtener_factura_filtradas(Conexion::obtenerConexion(),$criterio);
            
            if(count($filas)){

                foreach($filas as $fila){
                
                    self::escribir_factura_busqueda($fila);
                
                }

                }            
        }
        public static function escribir_factura_busqueda($fila){
            if(!isset($fila)){

                return;
            }
            ?>
        <tr></tr>
                <td class="text-center"> <?php echo $fila ->obtener_numero_factura() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_tipo() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_sucursal() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_estado() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_cod_orden_de_compra() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_proveedor() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_fecha() ?>  </td>                
                <td class="text-center"> <?php echo $fila ->obtener_fecha_entrega_estimada() ?>  </td>
                <td>
                    <form method="post" action="<?php echo ruta_detalle_factura_compra; ?>">
                    <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_numero_factura(); ?>" >Detalle</button>
                <input  type="hidden" name="proveedor"  id="proveedor" value="<?php echo $fila -> obtener_proveedor() ;?>">
                <input  type="hidden" name="total"  id="total" value="<?php echo $fila -> obtener_total() ;?>">
                <input  type="hidden" name="tipo"  id="tipo" value="<?php echo $fila -> obtener_tipo() ;?>">
                    </form> 
                </td>
              
        </tr>
    <?php
    }

    public static function escribir_filas_filtradas_sel_oc($criterio){
                                    
        $filas = repositorio_ordenes_de_compra::obtener_oc_filtrados_sel(Conexion::obtenerConexion(),$criterio);
        
        if(count($filas)){

            foreach($filas as $fila){
            
                self::escribir_oc_filtrada_sel_oc($fila);
            
            }

            }            else{
            //$_SESSION['pedido']=0;
        }
    }
    public static function escribir_oc_filtrada_sel_oc($fila){
        if(!isset($fila)){

            return;
        }
        ?>
    <tr>
            <td class="text-center"> <?php echo $fila ->obtener_cod_orden_de_compra() ?></td>
            <td class="text-center"> <?php echo $fila ->obtener_fecha_emision() ?></td>
            <td class="text-center"> <?php echo $fila ->obtener_proveedor()?></td>
            <td class="text-center"> <?php echo $fila ->obtener_total()?></td>
            <td class="text-center"> <?php echo $fila ->obtener_sucursal()?></td>
            <td>
                <form method="post" action="<?php echo ruta_factura_registrar; ?>">
                    <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="seleccionar" name="seleccionar" value="<?php echo $fila->obtener_cod_orden_de_compra(); ?>" >Seleccionar</button>
                    <input  type="hidden" name="proveedor"  id="proveedor" value="<?php echo $fila -> obtener_proveedor() ;?>">
                    <input  type="hidden" name="sucursal"  id="sucursal" value="<?php echo $fila -> obtener_sucursal() ;?>">    
                </form> 
            </td>
    </tr>
<?php
    }
}