<?php

include_once '../conexion.class.php';
include_once '../clases/repositorio_factura.class.php';
include_once '../config.inc.php';
include_once '../clases/facturas_compra.class.php';
include_once '../clases/ordenes_de_compra.class.php';
include_once '../clases/repositorio_remito.class.php';
include_once '../clases/repositorio_pago.class.php';

class escritor_pago{


    ///METODOS PARA SELECCIONAR FACTURA EN REGISTRAR PAGO
    public static function escribir_facturas_sel($criterio){
                                    
        $filas = repositorio_pago::obtener_facturas_filtradas(Conexion::obtenerConexion(),$criterio);
        
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
                    <form method="post" action="<?php echo ruta_registrar_pago; ?>">
    
                        <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="seleccionar" name="seleccionar" value="<?php echo $fila->obtener_cod_factura_compra(); ?>" >Seleccionar</button>
                        <input  type="hidden" name="proveedor"  id="proveedor" value="<?php echo $fila -> obtener_proveedor() ;?>">
                        <input  type="hidden" name="total"  id="total" value="<?php echo $fila -> obtener_total() ;?>">
                        <input  type="hidden" name="num_factura"  id="num_factura" value="<?php echo $fila -> obtener_numero_factura() ;?>">
                        <input  type="hidden" name="tipo_factura"  id="tipo_factura" value="<?php echo $fila -> obtener_tipo() ;?>">
                        <input  type="hidden" name="sucursal"  id="sucursal" value="<?php echo $fila -> obtener_sucursal() ;?>">
    
                    </form>
                </td>
        </tr>
        <?php
        }
        public static function escribir_facturas(){
        
            $filas = repositorio_pago::obtener_facturas_compra_pago(Conexion::obtenerConexion());
            
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
                        <form method="post" action="<?php echo ruta_registrar_pago; ?>">
    
                            <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="seleccionar" value="<?php echo $fila->obtener_cod_factura_compra(); ?>" >Seleccionar</button>
                            <input  type="hidden" name="proveedor"  id="proveedor" value="<?php echo $fila -> obtener_proveedor() ;?>">
                            <input  type="hidden" name="num_factura"  id="num_factura" value="<?php echo $fila -> obtener_numero_factura() ;?>">
                            <input  type="hidden" name="total"  id="total" value="<?php echo $fila -> obtener_total() ;?>">
                            <input  type="hidden" name="tipo_factura"  id="tipo_factura" value="<?php echo $fila -> obtener_tipo() ;?>">
                            <input  type="hidden" name="sucursal"  id="sucursal" value="<?php
                
                             $sucursal= repositorio_pago::obtener_sucursal(Conexion::obtenerConexion(),$fila ->obtener_sucursal());
                            echo $sucursal; 
                            ?>">
                        
    
                        </form>
                    </td>
            </tr>
        <?php
            }

            //////////METODOS ESCRIBIR DETALLE FACTURA EN REGISTAR PAGO
            public static function escribir_detalles_factura($id){

                $filas = repositorio_pago::obtener_detalles_factura(Conexion::obtenerConexion(),$id);

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

        //////////////////////////METODOS PAGOS_PRINCIPAL/////////////////////////         
                    
        public static function escribir_pagos(){
        
                $filas = repositorio_pago::obtener_pagos(Conexion::obtenerConexion());
                
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
                        <td class="text-center"> <?php echo $fila ->obtener_cod_pago() ?>  </td>
                        <td class="text-center"> <?php echo $fila ->obtener_num_factura() ?>  </td>
                        <td class="text-center"> <?php echo $fila ->obtener_metodo_pago() ?>  </td>
                        <td class="text-center"> <?php echo $fila ->obtener_observaciones() ?>  </td>
                        <td>
                        <?php
                        
                            $sucursal= repositorio_factura::obtener_sucursal(Conexion::obtenerConexion(),$fila ->obtener_sucursal());
                            echo $sucursal; 
                        ?> 
                        </td>
                        
                        <td class="text-center"> <?php echo $fila ->obtener_fecha() ?>  </td>
                        <td class="text-center"> <?php echo $fila ->obtener_proveedor() ?>  </td>
                        <td class="text-center"> <?php echo "$".$fila ->obtener_total() ?>  </td>
                        
                        <td>
                            <form method="post" action="<?php echo ruta_detalle_pagos; ?>">
            
                                <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_cod_pago(); ?>" >Detalle</button>
                                <input  type="hidden" name="proveedor"  id="proveedor" value="<?php echo $fila -> obtener_proveedor() ;?>">
                                <input  type="hidden" name="metodo_pago"  id="metodo_pago" value="<?php echo $fila -> obtener_metodo_pago() ;?>">
                                <input  type="hidden" name="observaciones"  id="observaciones" value="<?php echo $fila -> obtener_observaciones() ;?>">
                                <input  type="hidden" name="num_factura"  id="num_factura" value="<?php echo $fila -> obtener_num_factura() ;?>">
                                <input  type="hidden" name="total"  id="total" value="<?php echo $fila -> obtener_total() ;?>">
            
                            </form>
                        </td>
                </tr>
            <?php
                }

           public static function escribir_pagos_filtrados($criterio){
                                
                $filas = repositorio_pago::obtener_pagos_filtrados(Conexion::obtenerConexion(),$criterio);
                
                if(count($filas)){
            
                    foreach($filas as $fila){
                    
                        self::escribir_pago_filtrado($fila);
                    
                    }
            
                    }            
            }
            public static function escribir_pago_filtrado($fila){
                if(!isset($fila)){
            
                    return;
                }
                ?>
            <tr>
                    <td class="text-center"> <?php echo $fila ->obtener_cod_pago() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_num_factura() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_metodo_pago() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_observaciones() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_sucursal() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_fecha() ?>  </td>
                    <td class="text-center"> <?php echo $fila ->obtener_proveedor() ?>  </td>
                    <td class="text-center"> <?php echo "$".$fila ->obtener_total() ?>  </td>
                    
                    <td>
                        <form method="post" action="<?php echo ruta_detalle_pagos; ?>">
        
                            <button type="submit" style="background-color:light-gray; padding:2% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_cod_pago(); ?>" >Detalle</button>
                            <input  type="hidden" name="proveedor"  id="proveedor" value="<?php echo $fila -> obtener_proveedor() ;?>">
                            <input  type="hidden" name="total"  id="total" value="<?php echo $fila -> obtener_total() ;?>">
                            <input  type="hidden" name="metodo_pago"  id="metodo_pago" value="<?php echo $fila -> obtener_metodo_pago() ;?>">
                            <input  type="hidden" name="observaciones"  id="observaciones" value="<?php echo $fila -> obtener_observaciones() ;?>">
                            <input  type="hidden" name="num_factura"  id="num_factura" value="<?php echo $fila -> obtener_num_factura() ;?>">
                        </form>
                    </td>
                    
            </tr>
            <?php
            }

//////////////////////////METODOS DETALLE_PAGOS_PRINCIPAL/////////////////////////

            public static function escribir_detalles_pago($id) {

                $filas = repositorio_pago::obtener_detalles_pago(Conexion::obtenerConexion(),$id);
            
                if(count($filas)){
            
                    
                    foreach($filas as $fila){
            
                        self::escribir_detalle_pago($fila);
                        
                    }
                }
            }
            
            public static function escribir_detalle_pago($fila){
                    
                if(!isset($fila)){
            
                        return;
                }
                    ?>
                                
                <tr>
                    <td class="text-center"> <?php echo $fila ->obtener_cod_det_pago() ?>  </td>
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
        <td class="text-center"> <?php echo "$".$fila ->obtener_total() ?>  </td>     
        

</tr>
<?php
}
}
