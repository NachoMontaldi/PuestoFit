<?php

    
    include_once '../conexion.class.php';
    include_once '../config.inc.php';
    include_once '../clases/repositorio_cotizacion.class.php';
    include_once '../clases/cotizaciones.class.php';


    class escritor_filas_cotizaciones_seleccion {

            public static function obtener_cotizaciones_cargadas(){
            
                $filas = repositorio_cotizacion::obtener_cotizaciones_enviadas(Conexion::obtenerConexion());
                
                if(count($filas)){

                    foreach($filas as $fila){
                        self::escribir_cotizacion_cargada($fila);
                    }

                }            

            }

            public static function escribir_cotizacion_cargada($fila){
                if(!isset($fila)){
        
                    return;
                }?>
                <?php

                    if($fila -> obtener_estado()== 1 ){
                        
                        return;

                    }
                    else{ ?>
                        <tr>
                            <td class="text-center"> <?php echo $fila ->obtener_cod_cotizacion() ?>  </td>
                            <td class="text-center"> <?php echo $fila ->obtener_fecha_emision() ?>  </td>
                            <td> <?php

                            if($fila -> obtener_estado()== 1 ){
                                
                                print "COTIZACIONES CON ESTADO 1 NO DEBERIAN APARECER";
                            
                            } elseif($fila -> obtener_estado()==2){

                                echo $fila -> obtener_fecha_presupuesto();

                            }?> 

                            </td>
                            <td class="text-center"> <?php echo $fila ->obtener_proveedor() ?></td>
                            <td><?php 
                            if($fila -> obtener_estado()== 1 ){
                                
                                print "-";  ?>
                            
                            <?php } elseif($fila -> obtener_estado()==2){

                                echo $fila -> obtener_total()." $";
                            }?>
                            </td>

                            <td>
                                <form method="post" action="<?php echo ruta_registrar_orden_de_compra;?>">
                                    <button type="submit" style="background-color:light-gray; padding:3% ; font-size: 14px; 
                                    border-radius:2px;" class="btn btn-default btn-dark" id="seleccionar" name="seleccionar" 
                                    value="<?php echo $fila->obtener_cod_cotizacion();?>">Seleccionar</button>
                                    <input  type="hidden" name="proveedor"  id="proveedor" value="<?php echo $fila -> obtener_proveedor() ;?>">
                                </form>
                            </td>
                        </tr> 
            <?php  
            }     
        }     
    } 
?>


