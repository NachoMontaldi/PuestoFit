<?php

include_once '../clases/inventario.class.php';
include_once '../conexion.class.php';
include_once '../clases/repositorio_inventario.class.php';
include_once '../config.inc.php';
include_once '../clases/repositorio_proveedores.class.php';

class escritor_filas{
    
    public static function escribir_filas(){
        
        $filas = repositorio_inventario::obtener_inventario(Conexion::obtenerConexion());
        
        if(count($filas)){

            foreach($filas as $fila){
            
                self::escribir_fila($fila);
            
            }

            }            else{
            //$_SESSION['pedido']=0;
        }
    }
    
    public static function escribir_filas_filtradas($criterio){
        
        $filas = repositorio_inventario::obtener_inventario_filtrado(Conexion::obtenerConexion(),$criterio);
        
        if(count($filas)){

            foreach($filas as $fila){
            
                self::escribir_fila($fila);
            
            }

            }            else{
            //$_SESSION['pedido']=0;
        }
    }

    public static function escribir_fila($fila){
        if(!isset($fila)){

            return;
        }
        ?>
    <tr>

            <td class="text-center" widht= 10%> <?php echo $fila ->obtener_cod_prod() ?>  </td>
            <td class="text-center" widht= 20%> <?php echo $fila ->obtener_nombre() ?>  </td>
            <td class="text-center" widht= 10%> <?php echo $fila ->obtener_existencia() ?>  </td>
            <td class="text-center" widht= 20%> <?php echo $fila ->obtener_categoria() ?>  </td>
            <td class="text-center" widht= 15%> <?php echo $fila ->obtener_precio_compra()." $" ?>  </td>
            <td class="text-center" widht= 15%> <?php echo $fila ->obtener_precio_venta(). " $" ?>  </td>
            <td>
                <form method="post" action="<?php echo ruta_detalle_producto ?>">
                    <button type="submit" class="btn btn-default btn-primary" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_cod_prod(); ?>" widht= 5%>Detalle</button>
                </form>
            </td>
            <td>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <button type="submit" class="btn btn-default btn-primary" id="eliminar" name="eliminar" value="<?php echo $fila->obtener_cod_prod(); ?>" widht= 5%>Eliminar</button>
                </form>
            </td>
            <td>
                <form method="post" action="<?php echo ruta_modificar_producto ?>">
                    <button type="submit" class="btn btn-default btn-primary" id="editar" name="editar" value="<?php echo $fila->obtener_cod_prod(); ?>" widht= 5%>Editar</button>
                </form>
            </td>

    </tr>
<?php
        }
   public static function escribir_filas_proveedores(){
        
        $filas = repositorio_proveedores::obtener_proveedores(Conexion::obtenerConexion());
        
        if(count($filas)){

            foreach($filas as $fila){
                self::escribir_fila_proveedores($fila);
            }

            }            else{
            //$_SESSION['pedido']=0;
         }
        }
    
    public static function escribir_fila_proveedores($fila){
        if(!isset($fila)){

            return;
        }
        ?>
    <tr>
            <td class="text-center" widht= 10%> <?php echo $fila ->obtener_cod_prov() ?>  </td>
            <td class="text-center" widht= 20%> <?php echo $fila ->obtener_nombre() ?>  </td>
            <td class="text-center" widht= 10%> <?php echo $fila ->obtener_CUIL() ?>  </td>
            <td class="text-center" widht= 20%> <?php echo $fila ->obtener_direccion() ?>  </td>
            <td class="text-center" widht= 15%> <?php echo $fila ->obtener_telefono() ?>  </td>
            <td class="text-center" widht= 15%> <?php echo $fila ->obtener_email() ?>  </td>
            <td>
                <form method="post" action="<?php echo ruta_detalle_producto ?>">
                    <button type="submit" class="btn btn-default btn-primary" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_cod_prod(); ?>" widht= 5%>Detalle</button>
                </form>
            </td>
            <td>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <button type="submit" class="btn btn-default btn-primary" id="eliminar" name="eliminar" value="<?php echo $fila->obtener_cod_prod(); ?>" widht= 5%>Eliminar</button>
                </form>
            </td>
            <td>
                <form method="post" action="<?php echo ruta_modificar_producto ?>">
                    <button type="submit" class="btn btn-default btn-primary" id="editar" name="editar" value="<?php echo $fila->obtener_cod_prod(); ?>" widht= 5%>Editar</button>
                </form>
            </td>

    </tr>
<?php
        }

}    
?>