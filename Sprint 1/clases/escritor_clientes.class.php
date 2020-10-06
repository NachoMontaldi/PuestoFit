<?php

include_once '../conexion.class.php';
include_once '../config.inc.php';
include_once '../clases/clientes.class.php';
include_once '../clases/repositorio_clientes.class.php';


class escritor_clientes{

    public static function escribir_filas_clientes(){
        
        $filas = repositorio_clientes::obtener_clientes(Conexion::obtenerConexion());
        
        if(count($filas)){

            foreach($filas as $fila){
                self::escribir_fila_clientes($fila);
            }

            }            else{
         }
        }
    
    public static function escribir_fila_clientes($fila){
        if(!isset($fila)){

            return;
        }
        ?>
    <tr>
            <td class="text-center"> <?php echo $fila ->obtener_cod_cliente() ?></td>
            <td class="text-center"> <?php echo $fila ->obtener_dni() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_nombre() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_fecha_nacimiento() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_direccion() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_telefono() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_email() ?>  </td>
            <td>
                <form method="post" action="<?php echo ruta_modificar_cliente ?>">
                    <button type="submit"  style="background-color:light-gray; padding:6% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="editar" name="editar" value="<?php echo $fila->obtener_cod_cliente(); ?>" widht= 5%>Editar</button>
                </form>
            </td>
            <td>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <button type="submit"  style="background-color:rgba(177, 60, 30, 0.9);padding:4% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="eliminar" name="eliminar" value="<?php echo $fila->obtener_cod_cliente(); ?>" widht= 5%>Eliminar</button>
                </form>
            </td>
    </tr>
<?php
        }

public static function escribir_filas_filtradas_clientes($criterio){
        
            $filas = repositorio_clientes::obtener_clientes_filtrados(Conexion::obtenerConexion(),$criterio);
            
            if(count($filas)){
    
                foreach($filas as $fila){
                
                    self::escribir_fila_cliente($fila);
                
                }
    
            }else{
                //$_SESSION['pedido']=0;
            }
        }
    
    public static function escribir_fila_cliente($fila){
        if(!isset($fila)){

            return;
        }
        ?>
    <tr>
            <td class="text-center"> <?php echo $fila ->obtener_cod_cliente() ?></td>
            <td class="text-center"> <?php echo $fila ->obtener_dni() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_nombre() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_fecha_nacimiento() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_direccion() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_telefono() ?>  </td>
            <td class="text-center"> <?php echo $fila ->obtener_email() ?>  </td>
            <td>
                <form method="post" action="<?php echo ruta_modificar_cliente ?>">
                    <button type="submit"  style="background-color:light-gray; padding:6% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="editar" name="editar" value="<?php echo $fila->obtener_cod_cliente(); ?>" widht= 5%>Editar</button>
                </form>
            </td>
            <td>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <button type="submit"  style="background-color:rgba(177, 60, 30, 0.9);padding:4% ; font-size: 14px; border-radius:2px;" class="btn btn-default btn-dark" id="eliminar" name="eliminar" value="<?php echo $fila->obtener_cod_cliente(); ?>" widht= 5%>Eliminar</button>
                </form>
            </td>
    </tr>
<?php
        }


}