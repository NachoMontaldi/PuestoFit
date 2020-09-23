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
                            
                            } elseif($fila -> obtener_estado()==3){

                                echo $fila -> obtener_fecha_presupuesto();

                            }?> 
                            <td> <?php
                                $sucursal= repositorio_cotizacion::obtener_sucursal(Conexion::obtenerConexion(),$fila ->obtener_sucursal());
                                echo $sucursal;
                                ?>
                            </td>

                            </td>
                            <td class="text-center"> <?php echo $fila ->obtener_proveedor() ?></td>
                            <td><?php 
                            if($fila -> obtener_estado()== 1 ){
                                
                                print "-";  ?>
                            
                            <?php } elseif($fila -> obtener_estado()==3){

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
        
        
        ///BUSCADOR EN LA SELECCION

        public static function escribir_filas_filtradas_sel_cotizacion($criterio){
                                    
            $filas = repositorio_cotizacion::obtener_cotizaciones_filtrados_sel(Conexion::obtenerConexion(),$criterio);
            
            if(count($filas)){

                foreach($filas as $fila){
                
                    self::escribir_cot_busqueda_sel_cotizacion($fila);
                
                }

                }            else{
                //$_SESSION['pedido']=0;
            }
        }
        public static function escribir_cot_busqueda_sel_cotizacion($fila){
            if(!isset($fila)){

                return;
            }
            ?>
        <tr>
                <td class="text-center"> <?php echo $fila ->obtener_cod_cotizacion() ?></td>
                <td class="text-center"> <?php echo $fila ->obtener_fecha_emision() ?></td>
                <td class="text-center"> <?php echo $fila ->obtener_fecha_presupuesto() ?></td>
                <td class="text-center"> <?php echo $fila ->obtener_sucursal()?></td>
                <td class="text-center"> <?php echo $fila ->obtener_proveedor() ?></td>
                <td class="text-center"> <?php echo $fila ->obtener_total() ?></td>
                
                <td>
                    <form method="post" action="<?php echo ruta_registrar_orden_de_compra; ?>">
                        <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="seleccionar" name="seleccionar" value="<?php echo $fila->obtener_cod_cotizacion(); ?>" >Seleccionar</button>
                        <input type="hidden" name="sucursal2"  id="sucursal" value="<?php echo $fila -> obtener_sucursal() ;?>">
                        <input  type="hidden" name="proveedor"  id="proveedor" value="<?php echo $fila -> obtener_proveedor() ;?>">
                    </form> 
                </td>
        </tr>
    <?php
        }
    } 
?>


