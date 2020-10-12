
        <?php
    
    include_once '../conexion.class.php';
    include_once '../config.inc.php';
    include_once '../clases/repositorio_ventas.class.php';
    include_once '../clases/detalle_venta.class.php';
    include_once '../clases/ventas.class.php';

    class escritor_ventas {
        
        

        /* public static function escribir_filas_filtradas_ventas($criterio){
                                    
            $filas = repositorio_venta::obtener_venta_filtradas(Conexion::obtenerConexion(),$criterio);
            
            if(count($filas)){

                foreach($filas as $fila){
                
                    self::escribir_venta_busqueda($fila);
                
                }

                }            
        }
        public static function escribir_venta_busqueda($fila){
            if(!isset($fila)){

                return;
            }
            ?>
        <tr>
                <td class="text-center"> <?php echo $fila ->obtener_venta() ?></td>
                <td class="text-center"> <?php 
                    $sucursal= repositorio_venta::obtener_venta(Conexion::obtenerConexion(),$fila -> obtener_sucursal());
                    echo $sucursal; ?> 
                </td>
                <td class="text-center"> <?php echo $fila -> obtener_cliente() ?>  </td>
                <td class="text-center"> <?php echo $fila ->//obtener_fecha() ?>  </td>                
                <td>
                <td>
                    <form method="post" action="<?php echo ruta_detalle_venta; ?>">
                        <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_cod_factura_compra(); ?>" >Detalle</button>
                        <input  type="hidden" name="num_factura"  id="num_factura" value="<?php echo $fila ->obtener_numero_factura() ;?>">
                        <input  type="hidden" name="tipo"  id="tipo" value="<?php echo $fila -> obtener_tipo_factura() ;?>">
                        <input  type="hidden" name="total"  id="total" value="<?php echo $fila -> obtener_total() ;?>">
                    </form> 
                </td>
              
        </tr>
    <?php
    }

    public static function escribir_ventas(){
        
        $filas = repositorio_venta:://obtener_ventas_compra(Conexion::obtenerConexion());
        
        if(count($filas)){
    
            foreach($filas as $fila){
                self::escribir_venta($fila);
            }
    
        }            
    
    }
    
    public static function escribir_venta($fila){
            if(!isset($fila)){
    
                return;
            }
            ?>
        <tr>
            <td class="text-center"> <?php echo $fila ->obtener_venta() ?></td>
            <td class="text-center"> <?php 
                $sucursal= repositorio_venta:://obtener_venta(Conexion::obtenerConexion(),$fila ->//obtener_sucursal());
                echo $sucursal; ?> 
            </td>
            <td class="text-center"> <?php echo $fila ->//obtener_cliente() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_fecha() ?>  </td>                
            <td>
                <form method="post" action="<?php echo ruta_detalle_venta; ?>">
    
                    <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_cod_factura_compra(); ?>" >Detalle</button>
                    <input  type="hidden" name="num_factura"  id="num_factura" value="<?php echo $fila ->obtener_numero_factura() ;?>">
                    <input  type="hidden" name="tipo"  id="tipo" value="<?php echo $fila -> obtener_tipo_factura() ;?>">
                    <input  type="hidden" name="total"  id="total" value="<?php echo $fila -> obtener_total() ;?>">
                </form>
            </td>
        </tr>
    <?php
        }

 */

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
        
        $filas = repositorio_inventario::obtener_productos_filtrados_vta(Conexion::obtenerConexion(),$criterio);
        
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
            <td class="text-center"> <?php echo $fila ->obtener_precio_venta()." $" ?>  </td>
            <td>
                <form method="post" action="<?php echo ruta_registrar_detalle_venta ?>">

                    <button type="submit" style="background-color:light-gray; padding:8% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="seleccionar" name="seleccionar" value="<?php echo $fila->obtener_cod_prod(); ?>" >Seleccionar</button>
                    <input type="hidden" name="marca"  id="marca" value="<?php echo $fila -> obtener_marca() ;?>">
                    <input type="hidden" name="nombre"  id="nombre" value="<?php echo $fila -> obtener_nombre() ;?>">
                    <input type="hidden" name="precio"  id="precio" value="<?php echo $fila -> obtener_precio_venta() ;?>">

                </form>
            </td>

    </tr>
    <?php
    }
    
    ////escritor detalle de venta
    public static function escribir_detalles_venta($id) {

        $filas = repositorio_ventas::obtener_detalles_venta(Conexion::obtenerConexion(),$id);

        if(count($filas)){

            foreach($filas as $fila){

                self::escribir_detalle_venta($fila);
                
            }

        } 

    }

    public static function escribir_detalle_venta($fila){
        
        if(!isset($fila)){

                return;
        }

            ?>
                        
        <tr>
            <td class="text-center"> <?php echo $fila ->obtener_cod_det_venta() ?>  </td>
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
                        print "$0";
                }
            ?>   
            </td>    
        </tr>
<?php
}




}