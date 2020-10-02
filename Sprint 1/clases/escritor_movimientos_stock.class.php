<?php

include_once '../conexion.class.php';
include_once '../config.inc.php';
include_once '../clases/repositorio_inventario.class.php';
include_once '../clases/repositorio_movimientos_stock.class.php';


class escritor_movimientos_stock{

    public static function escribir_filas_filtradas_movimientos($criterio){
    
        $filas = repositorio_movimientos_stock::obtener_movimientos_filtrados(Conexion::obtenerConexion(),$criterio);
        
        if(count($filas)){
    
            foreach($filas as $fila){ 
            
                self::escribir_movimiento_busqueda($fila);
            
            }
    
        }            
    }
    public static function escribir_movimiento_busqueda($fila){
    if(!isset($fila)){
    
        return;
    }
    ?>
    <tr>
        <td class="text-center"> <?php echo $fila ->obtener_cod_mov() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_fecha() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_tipo() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_sucursal() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_motivo() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_observaciones() ?>  </td>
        <td>
            <form method="post" action="<?php echo ruta_detalle_mov_stock; ?>">
            <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_cod_mov(); ?>" >Detalle</button>
            <input  type="hidden" name="cod_mov"  id="cod_mov" value="<?php echo $fila ->obtener_cod_mov() ;?>">
            <input  type="hidden" name="motivo"  id="motivo" value="<?php echo $fila ->obtener_motivo() ;?>">
            <input  type="hidden" name="observacion"  id="observacion" value="<?php echo $fila ->obtener_observaciones ();?>">
            </form> 
        </td>
    </tr>
    <?php
    }

    public static function escribir_productos_sel(){
        
        $filas = repositorio_inventario::obtener_inventario_mov(Conexion::obtenerConexion());
        
        if(count($filas)){

            foreach($filas as $fila){
            
                self::escribir_producto_sel($fila);
            
            }
 
            }            else{
            //$_SESSION['pedido']=0;
        }
    }

    public static function escribir_productos_filtrados_sel($criterio){
        
        $filas = repositorio_inventario::obtener_productos_filtrados_sel(Conexion::obtenerConexion(),$criterio);
        
        if(count($filas)){

            foreach($filas as $fila){
            
                self::escribir_producto_sel($fila);
            
            }

            }            else{
            //$_SESSION['pedido']=0;
        }
    }

    public static function escribir_producto_sel($fila){
        if(!isset($fila)){

            return;
        }
        ?>
    <tr>

            <td class="text-center"> <?php echo $fila ->obtener_cod_prod() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_nombre() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_marca() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_categoria() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_precio_compra()." $" ?>  </td>
            <td>
                <form method="post" action="<?php echo ruta_registrar_movimiento_stock ?>">

                    <button type="submit" style="background-color:light-gray; padding:8% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="seleccionar" name="seleccionar" value="<?php echo $fila->obtener_cod_prod(); ?>" >Seleccionar</button>
                    <input type="hidden" name="marca"  id="marca" value="<?php echo $fila -> obtener_marca() ;?>">
                    <input type="hidden" name="nombre"  id="nombre" value="<?php echo $fila -> obtener_nombre() ;?>">

                </form>
            </td>

    </tr>
<?php
    }


    public static function escribir_movimientos_principal(){
        
        $filas = repositorio_movimientos_stock::obtener_movimientos(Conexion::obtenerConexion());
         
        if(count($filas)){
    
            foreach($filas as $fila){
                self::escribir_movimiento_principal($fila);
            }
    
        }            
    
    }
    public static function escribir_movimiento_principal($fila){
        
        if(!isset($fila)){
            
            return;
        }
        ?>
    <tr>
        <td class="text-center"> <?php echo $fila ->obtener_cod_mov() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_fecha() ?>  </td>
        <td class="text-center"> <?php echo $fila ->obtener_tipo() ?>  </td>
        <td class="text-center"> <?php 
            $sucursal= repositorio_movimientos_stock::obtener_sucursal(Conexion::obtenerConexion(),$fila ->obtener_sucursal());
            echo $sucursal; ?> 
        </td>
        
        <td class="text-center"> <?php echo $fila ->obtener_motivo() ?></td>
        <td class="text-center"> <?php echo $fila ->obtener_observaciones() ?></td>    
        <td>
            <form method="post" action="<?php echo ruta_detalle_mov_stock; ?>">

                <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_cod_mov(); ?>" >Detalle</button>
                <input  type="hidden" name="motivo"  id="motivo" value="<?php echo $fila ->obtener_motivo() ;?>">
                <input  type="hidden" name="observacion"  id="observacion" value="<?php echo $fila ->obtener_observaciones();?>">
            </form>
        </td>
    </tr>
<?php

    }

    public static function escribir_detalles_movimientos_stock($id){

        $filas = repositorio_movimientos_stock::obtener_detalles_movimientos_stock(Conexion::obtenerConexion(),$id);

        if(count($filas)){
            
            foreach($filas as $fila){

                self::escribir_detalle_movimiento_stock($fila);
            }

            }    

        }

    public static function escribir_detalle_movimiento_stock($fila){
            if(!isset($fila)){

                return;
            }

            ?>
        <tr>
                <td class="text-center"> <?php echo $fila ->obtener_cod_det_remito() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_cod_det_factura_venta() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_cantidad() ?>  </td>
                
                <td>
                    <form method="post" action="<?php echo ruta_registrar_movimiento_stock ?>">
                        <button type="submit" style="background-color:light-gray; padding:9% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="eliminar" name="eliminar" value="<?php echo $fila->obtener_cod_det_mov(); ?>" widht= 5%>Eliminar</button>
                    </form>
                </td>
        </tr>
    <?php
    }

    public static function escribir_detalles_movimiento($id){

        $filas = repositorio_movimientos_stock::obtener_detalles_movimientos_stock(Conexion::obtenerConexion(),$id);

        if(count($filas)){
            
            foreach($filas as $fila){

                self::escribir_detalle_movimiento($fila);
            }

        }    

    }

    public static function escribir_detalle_movimiento($fila){
        if(!isset($fila)){

            return;
        }

        ?>
        <tr>
                <td class="text-center"> <?php echo $fila ->obtener_cod_det_mov() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_cod_det_remito() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_cod_det_factura_venta() ?>  </td>
                <td class="text-center"> <?php echo $fila ->obtener_cantidad() ?>  </td>
        </tr>
    <?php
    } 
}