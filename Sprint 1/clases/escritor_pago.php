<?php

include_once '../conexion.class.php';
include_once '../clases/repositorio_factura.class.php';
include_once '../clases/repositorio_pago.class.php';
include_once '../config.inc.php';
include_once '../clases/facturas_compra.class.php';
include_once '../clases/ordenes_de_compra.class.php';
include_once '../clases/repositorio_remito.class.php';

class escritor_pago{
/* METODO ESCRIBIR REMITOS PARA REGISTRAR NUEVO AL SELECCIONAR FACTURA */
public static function escribir_pagos(){
        
    $filas = repositorio_factura::obtener_facturas_compra(Conexion::obtenerConexion());
    
    if(count($filas)){

        foreach($filas as $fila){
            self::escribir_pago($fila);
        }

        }            

    }

public static function escribir_pago($fila){
        if(!isset($fila)){

            return;
        }
        ?>
    <tr>
            <td class="text-center"> <?php echo $fila ->obtener_cod_factura_compra() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_fecha() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_proveedor() ?>  </td>
            <td class="text-center"> <?php echo "$".$fila ->obtener_total() ?>  </td>
            
            <td>
                <form method="post" action="<?php echo ruta_registrar_pago; ?>">

                    <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="seleccionar" value="<?php echo $fila->obtener_cod_factura_compra(); ?>" >Seleccionar</button>
                    <input  type="hidden" name="proveedor"  id="proveedor" value="<?php echo $fila -> obtener_proveedor() ;?>">
                    <input  type="hidden" name="total"  id="total" value="<?php echo $fila -> obtener_total() ;?>">

                </form>
            </td>
    </tr>
<?php
    }
/////////////////////ESCRITOR PARA INFORME EGRESOS
public static function escribir_filas_informe_egresos(){
                                    
    $filas = repositorio_pago :: obtener_grilla_informe (Conexion::obtenerConexion());
    
    if(count($filas)){

        foreach($filas as $fila){
        
            self::escribir_informe_egresos($fila);
        
        }

        }            
}
public static function escribir_informe_egresos ($fila){
    if(!isset($fila)){

        return;
    }
    ?>
<tr></tr>
        <td class="text-center"> <?php echo $fila ->obtener_mes() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_cantidad() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_total() ?>  </td>     
        

</tr>
<?php
}

}
