<?php

include_once '../conexion.class.php';
include_once '../clases/repositorio_factura.class.php';
include_once '../config.inc.php';
include_once '../clases/facturas_compra.class.php';
include_once '../clases/ordenes_de_compra.class.php';
include_once '../clases/repositorio_remito.class.php';

class escritor_remito{




/////////////////////////////////////FACTURAS/////////////////////////////////////////////////////////////
public static function escribir_detalles_factura($id){

    $filas = repositorio_remito::obtener_detalles_factura(Conexion::obtenerConexion(),$id);

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
            <td class="text-center"> <?php echo $fila ->obtener_nombre() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_marca() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_precio_unitario() . " $"?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_cantidad() ?>  </td>
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

//////////////////////////////////////////////////////////////REMITOS/////////////////////////////////////////////////////////
/* METODO ESCRIBIR REMITOS PARA REGISTRAR NUEVO AL SELECCIONAR FACTURA */
public static function escribir_facturas(){
        
        $filas = repositorio_remito::obtener_facturas_compra_remito(Conexion::obtenerConexion());
        
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
                <td>
                <?php
                
                    $sucursal= repositorio_factura::obtener_sucursal(Conexion::obtenerConexion(),$fila ->obtener_sucursal());
                    echo $sucursal; 
                ?> 
                </td>

                <td class="text-center"> <?php echo $fila ->obtener_proveedor() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_fecha() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_total() . " $" ?>  </td>
                
                <td>
                    <form method="post" action="<?php echo ruta_remito_registrar; ?>">

                        <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="seleccionar" value="<?php echo $fila->obtener_cod_factura_compra(); ?>" >Seleccionar</button>
                        <input  type="hidden" name="proveedor"  id="proveedor" value="<?php echo $fila -> obtener_proveedor() ;?>">
                        <input  type="hidden" name="sucursal"  id="sucursal" value="<?php $sucursal= repositorio_factura::obtener_sucursal(Conexion::obtenerConexion(),$fila ->obtener_sucursal());
            echo $sucursal ;?>">
                        <input  type="hidden" name="num_factura"  id="num_factura" value="<?php echo $fila -> obtener_numero_factura() ;?>">
                        <input  type="hidden" name="total"  id="total" value="<?php echo $fila -> obtener_total() ;?>">

                    </form>
                </td>
        </tr>
    <?php
        }

/* METODO ESCRIBIR REMITO PRINCIPAL */

public static function escribir_remitos_principal(){
        
    $filas = repositorio_remito::obtener_remitos(Conexion::obtenerConexion());
    
    if(count($filas)){

        foreach($filas as $fila){
            self::escribir_remito_principal($fila);
        }

        }            

    }

public static function escribir_remito_principal($fila){
        if(!isset($fila)){

            return;
        }
        ?>
    <tr>
        <td class="text-center"> <?php echo $fila ->obtener_num_remito() ?></td>
        <td class="text-center"> <?php $num = repositorio_remito::obtener_num_factura(Conexion::obtenerConexion(), $fila ->obtener_cod_factura());
        echo $num; ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_fecha() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_proveedor() ?></td>
        <td class="text-center"> <?php $sucursal= repositorio_remito::obtener_sucursal(Conexion::obtenerConexion(),$fila ->obtener_sucursal());
        echo $sucursal; ?></td>
        <!--<td class="text-center"> <?php 
            /*if($fila ->obtener_estado() == 1){
                print "Pendiente";
            }elseif($fila ->obtener_estado() == 2){
                print "Listo";} */?>
        </td>-->
        <td>
            <form method="post" action="<?php echo ruta_detalle_remito; ?>">

                <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila -> obtener_cod_remito(); ?>">Detalle</button>
                <input  type="hidden" name="num_remito"  id="num_remito" value="<?php echo $fila -> obtener_num_remito() ;?>">
                <input  type="hidden" name="proveedor"  id="proveedor" value="<?php echo $fila -> obtener_proveedor() ;?>">
                <input  type="hidden" name="sucursal"  id="sucursal" value="<?php $sucursal= repositorio_factura::obtener_sucursal(Conexion::obtenerConexion(),$fila ->obtener_sucursal());
            echo $sucursal;?>">
                <input  type="hidden" name="total"  id="total" value="<?php echo $fila -> obtener_total() ;?>">
            </form>
        </td>
    </tr><?php
    }
///////////BUSCADOR

public static function escribir_filas_filtradas_remitos($criterio){
                                    
    $filas = repositorio_remito::obtener_remito_filtradas(Conexion::obtenerConexion(),$criterio);
    
    if(count($filas)){

        foreach($filas as $fila){
        
            self::escribir_remito_busqueda($fila);
        
        }

        }            
}
public static function escribir_remito_busqueda($fila){
    if(!isset($fila)){

        return;
    }
    ?>
<tr></tr>
        <td class="text-center"> <?php echo $fila ->obtener_num_remito() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_cod_factura() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_fecha() ?>  </td> 
        <td class="text-center"> <?php echo $fila ->obtener_proveedor() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_sucursal() ?>  </td>
        <!--<td class="text-center"> <?php// echo $fila ->obtener_estado() ?>  </td>-->
        <td>
            <form method="post" action="<?php echo ruta_detalle_remito; ?>">
            <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila -> obtener_cod_remito() ; ?>" >Detalle</button>
        <input  type="hidden" name="proveedor"  id="proveedor" value="<?php echo $fila -> obtener_proveedor() ;?>">
        <input  type="hidden" name="sucursal"  id="sucursal" value="<?php echo $fila -> obtener_sucursal() ;?>">
        <input  type="hidden" name="total"  id="total" value="<?php echo $fila -> obtener_total() ;?>">
        <input  type="hidden" name="num_remito"  id="num_remito" value="<?php echo $fila -> obtener_num_remito() ;?>">
        
            </form> 
        </td>
      
</tr>
<?php
}
/*escribir detalleS de remitos*/
public static function escribir_detalles_remito($id) {

    $filas = repositorio_remito::obtener_detalles_remito(Conexion::obtenerConexion(),$id);

    if(count($filas)){

        
        foreach($filas as $fila){

            self::escribir_detalle_remito($fila);
            

        }

    } 

}

public static function escribir_detalle_remito($fila){
        
    if(!isset($fila)){

            return;
    }

        ?>
                    
    <tr>
        <td class="text-center"> <?php echo $fila ->obtener_cod_det_remito() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_nombre() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_marca() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_cantidad() ?>  </td> 
        <td class="text-center"> <?php echo $fila ->obtener_precio_unitario() ?></td>
        <td class="text-center">

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

public static function escribir_facturas_sel($criterio){
                                    
    $filas = repositorio_factura::obtener_facturas_filtradas(Conexion::obtenerConexion(),$criterio);
    
    if(count($filas)){

        foreach($filas as $fila){
        
            self::escribir_factura_sel($fila);
        
        }

        }else{
    }
}
public static function escribir_factura_sel($fila){
    if(!isset($fila)){

        return;
    }
        ?>
    <tr>
        <td class="text-center"> <?php echo $fila ->obtener_numero_factura() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_tipo() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_sucursal() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_proveedor() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_fecha() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_total() . " $" ?>  </td>
            
            <td>
                <form method="post" action="<?php echo ruta_remito_registrar; ?>">

                    <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="seleccionar" name="seleccionar" value="<?php echo $fila->obtener_cod_factura_compra(); ?>" >Seleccionar</button>
                    <input  type="hidden" name="proveedor"  id="proveedor" value="<?php echo $fila -> obtener_proveedor() ;?>">
                    <input  type="hidden" name="total"  id="total" value="<?php echo $fila -> obtener_total() ;?>">
                    <input  type="hidden" name="sucursal"  id="sucursal" value="<?php echo $fila -> obtener_sucursal() ;?>">
                    <input  type="hidden" name="num_factura"  id="num_factura" value="<?php echo $fila -> obtener_numero_factura() ;?>">

                </form>
            </td>
    </tr>
    <?php
    }

}