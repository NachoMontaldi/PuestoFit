<?php

include_once '../clases/inventario.class.php';
include_once '../conexion.class.php';
include_once '../clases/repositorio_inventario.class.php';
include_once '../config.inc.php';
include_once '../clases/repositorio_proveedores.class.php';
include_once '../clases/proveedores.class.php';
include_once '../clases/repositorio_cotizacion.class.php';


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
                    <button type="submit" style="background-color:light-gray; padding:8% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_cod_prod(); ?>" >Detalle</button>
                </form>
            </td>
            <td>
                <form method="post" action="<?php echo ruta_modificar_producto ?>">
                    <button type="submit" style="background-color:light-gray; padding:9% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="editar" name="editar" value="<?php echo $fila->obtener_cod_prod(); ?>" widht= 5%>Editar</button>
                </form>
            </td>
            <td>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <button type="submit" style="background-color:rgba(177, 60, 30, 0.9);padding:8% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="eliminar" name="eliminar" value="<?php echo $fila->obtener_cod_prod(); ?>" widht= 3%>Eliminar</button>
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
         }
        }

    public static function escribir_filas_filtradas_proveedores($criterio){
        
            $filas = repositorio_proveedores::obtener_proveedores_filtrado(Conexion::obtenerConexion(),$criterio);
            
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
                <form method="post" action="<?php echo ruta_modificar_proveedor ?>">
                    <button type="submit"  style="background-color:light-gray; padding:6% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="editar" name="editar" value="<?php echo $fila->obtener_cod_prov(); ?>" widht= 5%>Editar</button>
                </form>
            </td>
            <td>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <button type="submit"  style="background-color:rgba(177, 60, 30, 0.9);padding:4% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="eliminar" name="eliminar" value="<?php echo $fila->obtener_cod_prov(); ?>" widht= 5%>Eliminar</button>
                </form>
            </td>
    </tr>
<?php
        }

        public static function escribir_detalles_pedido($id){
        
            $filas = repositorio_pedido_reposicion::obtener_detalles(Conexion::obtenerConexion(),$id);
            
            if(count($filas)){
    
                foreach($filas as $fila){
                    self::escribir_detalle_pedido($fila);
                }
    
                }            

            }

            public static function escribir_detalle_pedido($fila){
                if(!isset($fila)){
        
                    return;
                }
                ?>
            <tr>
                    <td class="text-center" widht= 20%> <?php echo $fila ->obtener_nombre() ?>  </td>
                    <td class="text-center" widht= 10%> <?php echo $fila ->obtener_cantidad() ?>  </td>
                    <td class="text-center" widht= 20%> <?php echo $fila ->obtener_observaciones() ?>  </td>
                    <td>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <button type="submit" style="background-color:light-gray; padding:9% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="eliminar" name="eliminar" value="<?php echo $fila->obtener_cod_det_pedido(); ?>" widht= 5%>Eliminar</button>
                        </form>
                    </td>
            </tr>
        <?php
                }
        
        public static function escribir_lista_proveedores(){


                $proveedores = repositorio_proveedores::obtener_proveedores(Conexion::obtenerConexion());
                    
                if(count($proveedores)){
            
                    foreach($proveedores as $proveedor){
                        
                        self::escribir_proveedor($proveedor);
                        
                        }
                    }
                else{
                    print 'to';
                }
                }
                
        public static function escribir_proveedor($proveedor){
                if(!isset($proveedor)){

                        return;
                    }

            ?>
                <option value="<?php echo $proveedor-> obtener_nombre() ?>"> <?php echo $proveedor-> obtener_nombre() ?> </option>
            <?php        
                }

        public static function escribir_detalles_cotizacion($id){
        
                $filas = repositorio_cotizacion::obtener_detalles(Conexion::obtenerConexion(),$id);
                    
                if(count($filas)){
            
                    foreach($filas as $fila){
                        self::escribir_detalle_cotizacion($fila);
                     }
            
                    }            
        
                }
        
        public static function escribir_detalle_cotizacion($fila){
                        if(!isset($fila)){
                
                            return;
                        }
                        ?>
                    <tr>
                            <td class="text-center" widht= 20%> <?php echo $fila ->obtener_nombre() ?>  </td>
                            <td class="text-center" widht= 20%> <?php echo $fila ->obtener_marca() ?> </td>
                            <td class="text-center" widht= 10%> <?php echo $fila ->obtener_cantidad() ?>  </td>
                            
                            <td>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                    <button type="submit" class="btn btn-default btn-dark" style="background-color:light-gray; padding:9% ; font-size: 14px; border-radius:2px;"  id="eliminar" name="eliminar" value="<?php echo $fila->obtener_cod_det_cotizacion(); ?>" width= 5%>Eliminar</button>
                                </form>
                            </td>
                    </tr>
                <?php
                        }
        public static function escribir_cotizaciones(){
        
                            $filas = repositorio_cotizacion::obtener_cotizaciones_enviadas(Conexion::obtenerConexion());
                            
                            if(count($filas)){
                    
                                foreach($filas as $fila){
                                    self::escribir_cotizacion($fila);
                                }
                    
                                }            
                
                            }
                
        public static function escribir_cotizacion($fila){
                                if(!isset($fila)){
                        
                                    return;
                                }
                                ?>
                            <tr>
                                    <td class="text-center" widht= 20%> <?php echo $fila ->obtener_cod_cotizacion() ?>  </td>
                                    <td class="text-center" widht= 10%> <?php echo $fila ->obtener_fecha_emision() ?>  </td>
                                    <td> <?php
                                    if($fila -> obtener_estado()== 1 ){
                                           
                                           print "-";
                                       
                                           } elseif($fila -> obtener_estado()==2){
   
                                              echo $fila -> obtener_fecha_presupuesto();
                                          }?>
                                    </td>
                                    <td class="text-center" widht= 10%> <?php echo $fila ->obtener_proveedor() ?>  </td>
                                    <td><?php 
                                        if($fila -> obtener_estado()== 1 ){?>
                                           
                                        <form method="post" action="<?php echo ruta_cotizaciones_cargar ?>">
                                            <button type="submit" style="background-color:light-gray; padding:5% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="cargar" name="cargar" value="<?php echo $fila->obtener_cod_cotizacion(); ?>" widht= 5%>Cargar</button>
                                        </form>
                                    
                                       <?php } elseif($fila -> obtener_estado()==2){

                                           echo $fila -> obtener_total()." $";
                                       }
                                    ?> </td>
                                    <td>
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                            <button type="submit" style="background-color:light-gray; padding:3% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="ver_detalle" name="ver_detalle" value="<?php echo $fila->obtener_cod_cotizacion(); ?>" widht= 5%>Ver detalle</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                            <button type="submit" style="background-color:rgba(177, 60, 30, 0.9); padding:5% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="eliminar" name="eliminar" value="<?php echo $fila-> obtener_cod_cotizacion(); ?>" widht= 5%>Eliminar</button>
                                        </form>
                                    </td>

                            </tr>
                        <?php
                                }

        public static function escribir_cargas_cotizacion($id){
        
                                    $filas = repositorio_cotizacion::obtener_detalles(Conexion::obtenerConexion(),$id);
                                    if(count($filas)){
                                        foreach($filas as $fila){
                                            self::escribir_carga_cotizacion($fila);
                                         }
                                
                                        }            
                            
                                    }
                            
        public static function escribir_carga_cotizacion($fila){
                                            if(!isset($fila)){

                                                return;
                                            }

                                            ?>
                                        <tr>
                                                <td class="text-center" widht= 20%> <?php echo $fila ->obtener_nombre() ?>  </td>
                                                <td class="text-center" widht= 20%> <?php echo $fila ->obtener_marca() ?> </td>
                                                <td class="text-center" widht= 10%> <?php echo $fila ->obtener_cantidad() ?>  </td>
                                                <td class="valor">
                                                    <input type="text" name="precio_unitario" id="precio_unitario"> 
                                                </td>     
                                        </tr>
                                    <?php
                                            }
        
        
}    
?>