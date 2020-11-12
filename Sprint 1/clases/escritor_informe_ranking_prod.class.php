<?php
    
    include_once '../conexion.class.php';
    include_once '../clases/repositorio_ranking_prod.class.php';
    include_once '../clases/ranking_prod.class.php';
    require_once("../phpChart_Lite/phpChart_Lite/conf.php");


    class escritor_informe_ranking_prod {
        public static function escribir_ranking_principal(){
                
                $filas = repositorio_ranking_prod::obtener_productos_rankeados(Conexion::obtenerConexion());

                if(count($filas)){
            
                    foreach($filas as $fila){
                        self::escribir_ranking($fila);
                    }
            
                }            
            
            }
            public static function escribir_ranking($fila){
                
                if(!isset($fila)){
                    
                    return;
                }
                ?>

                <tr>
                    <td class="text-center"> <?php echo $fila ->obtener_posicion() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_totalunidades() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_total() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_cod_prod() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_nombre() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_marca() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_categoria() ?>  </td>
                    <td class="text-center"> <?php echo "$".$fila ->obtener_precio_compra() ?>  </td>
                    <td class="text-center"> <?php echo "$".$fila ->obtener_precio_venta() ?>  </td>
                </tr>
<?php

        }
    }
?>