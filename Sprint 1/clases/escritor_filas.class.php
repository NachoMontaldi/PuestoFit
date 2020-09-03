<?php

include_once '../clases/inventario.class.php';
include_once '../conexion.class.php';
include_once '../clases/repositorio_inventario.class.php';

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
            <td class="text-center" widht= 30%> <?php echo $fila ->obtener_nombre() ?>  </td>
            <td class="text-center" widht= 10%> <?php echo $fila ->obtener_existencia() ?>  </td>
            <td class="text-center" widht= 20%> <?php echo $fila ->obtener_categoria() ?>  </td>
            <td class="text-center" widht= 15%> <?php echo $fila ->obtener_precio_compra()." $" ?>  </td>
            <td class="text-center" widht= 15%> <?php echo $fila ->obtener_precio_venta(). " $" ?>  </td>
            
    </tr>
<?php
    }
}    
?>