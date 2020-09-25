<?php
    
    include_once '../conexion.class.php';
    include_once 'inventario.class.php';
    include_once 'repositorio_proveedores.class.php';

    class repositorio_inventario{
        
        public static function insertar_inventario($conexion,$inventario){
        
            $inventario_insertado = false;
        
        if (isset($conexion)){
            try{
                $sql = "insert into inventario(nombre,cantidad_min,marca,categoria,precio_compra,precio_venta, contiene_T,contiene_A,contiene_L,descripcion, fecha_registro) values
                 (:nombre,:cantidad_min,:marca,:categoria,:precio_compra,:precio_venta,:contiene_T,:contiene_A,:contiene_L,:descripcion,NOW())";

                $nombretemp = $inventario -> obtener_nombre();
                $cantidadmintemp = $inventario -> obtener_cantidad_min();
                $marcatemp = $inventario -> obtener_marca();
                $categoriatemp = $inventario -> obtener_categoria();
                $preciocompratemp = $inventario -> obtener_precio_compra();
                $precioventatemp = $inventario -> obtener_precio_venta();
                $contieneTtemp = $inventario -> obtener_contiene_T();
                $contieneAtemp = $inventario -> obtener_contiene_A();
                $contieneLtemp = $inventario -> obtener_contiene_L();
                $descripciontemp = $inventario -> obtener_descripcion();
                
                $sentencia = $conexion ->prepare($sql);

                $sentencia -> bindParam(':nombre', $nombretemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':cantidad_min', $cantidadmintemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':marca', $marcatemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':categoria', $categoriatemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':precio_compra', $preciocompratemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':precio_venta', $precioventatemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':contiene_T', $contieneTtemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':contiene_A', $contieneAtemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':contiene_L', $contieneLtemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':descripcion', $descripciontemp, PDO::PARAM_STR);
                
            $inventario_insertado = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $inventario_insertado;
        }
        else{
            echo 'No hubo conexion en inventario!!!';
        }
        
    }

    public static function insertar_prod_stock_deposito($conexion,$cod_prod){
        $stock_insertado = false;
        if (isset($conexion)){
            try{
                    $sql = "insert into stock_deposito (cod_deposito,cod_prod,cantidad) values (1,:cod_prod,0);
                            insert into stock_deposito (cod_deposito,cod_prod,cantidad) values (2,:cod_prod,0);
                            insert into stock_deposito (cod_deposito,cod_prod,cantidad) values (3,:cod_prod,0)";
                    
                    $codprodtemp = $cod_prod;

                    $sentencia = $conexion ->prepare($sql);

                    $sentencia -> bindParam(':cod_prod', $codprodtemp, PDO::PARAM_STR);
                        
                    $stock_insertado = $sentencia -> execute();
                
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            return $stock_insertado;
        }
        else{
            echo 'No hubo conexion en inventario!!!';
        }
    }
    
//Devuelve todas las filas del inventario
 public static function obtener_inventario($conexion){
        
        $filas = [];
        
        if (isset($conexion)){
        
            try{
                $sql= 'select * from grilla_inventario';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){ 
                    foreach($resultado as $fila){
                        $filas[] = new Inventario($fila['cod_prod'], $fila['nombre'], $fila['cantidad'],
                                      null, $fila['marca'], $fila['categoria'],$fila['precio_compra'],
                                      $fila['precio_venta'],null,null,
                                      null,null,null,null,
                                      null);
                    }
                }

                
            }catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $filas;
    }
    public static function obtener_inventario_pedido($conexion){
        
        $filas = [];
        
        if (isset($conexion)){
        
            try{
                $sql= 'select * from inventario';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new Inventario($fila['cod_prod'], $fila['nombre'], $fila['existencia'],
                                      $fila['cantidad_min'], $fila['marca'], $fila['categoria'],$fila['precio_compra'],
                                      $fila['precio_venta'],$fila['contiene_T'],$fila['contiene_A'],
                                      $fila['contiene_L'],$fila['descripcion'],$fila['fecha_registro'],$fila['cod_prov']);
                    }
                }

                
            }catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $filas;
    }
//Devuelve todas las filas del inventario que coincidan con la busqueda($criterio)
    public static function obtener_inventario_filtrado($conexion,$criterio){
        
        $filas = [];
        $criterio_min=strtolower($criterio);
        
        if (isset($conexion)){
        
            try{
                $sql= 'select * from grilla_inventario where (cod_prod LIKE "%'.$criterio_min. '%" OR 
                       nombre LIKE "%'. $criterio_min. '%" OR cantidad LIKE "%'  .$criterio_min. '%"
                       OR marca LIKE "%' .$criterio_min.'%" OR categoria LIKE "%'  .$criterio_min.'%" 
                       OR precio_compra LIKE "%' .$criterio_min.'%" OR precio_venta LIKE "%' .$criterio_min.'%")';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new Inventario($fila['cod_prod'], $fila['nombre'], $fila['cantidad'],
                                                    null, $fila['marca'], $fila['categoria'],$fila['precio_compra'],
                                                    $fila['precio_venta'],null,null,
                                                    null,null,null,null,
                                                    null);;
                    }
                }

                
            }catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $filas;
    }

    public static function obtener_inventario_filtrado_producto($conexion,$criterio){
        
        $filas = [];
        $criterio_min=strtolower($criterio);
        
        if (isset($conexion)){
        
            try{
                $sql= 'select * from inventario where (cod_prod LIKE "%'.$criterio_min. '%" OR 
                       nombre LIKE "%'. $criterio_min. '%" OR existencia LIKE "%'  .$criterio_min. '%"
                       OR marca LIKE "%' .$criterio_min.'%" OR categoria LIKE "%'  .$criterio_min.'%" 
                       OR precio_compra LIKE "%' .$criterio_min.'%" OR precio_venta LIKE "%' .$criterio_min.'%") 
                       ';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new Inventario($fila['cod_prod'], $fila['nombre'], $fila['existencia'],
                                      $fila['cantidad_min'], $fila['marca'], $fila['categoria'],$fila['precio_compra'],
                                      $fila['precio_venta'],$fila['contiene_T'],$fila['contiene_A'],
                                      $fila['contiene_L'],$fila['descripcion'],$fila['fecha_registro']);
                    }
                }

                
            }catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $filas;
    }

    public static function actualizar_inventario($conexion, $cod_prod, $nombre, $existencia, $cantidad_min, $marca, 
                                                 $categoria, $precio_compra, $precio_venta, $contiene_T, $contiene_A, 
                                                 $contiene_L, $descripcion){
        $actualizacion_correcta = false;

        if (isset($conexion)){
            
            try{
                $sql = "UPDATE inventario set nombre = :nombre, existencia = :existencia, cantidad_min = :cantidad_min, marca = :marca, categoria = :categoria, precio_compra = :precio_compra, precio_venta = :precio_venta, contiene_T = :contiene_T, contiene_A = :contiene_A, contiene_L = :contiene_L, descripcion = :descripcion WHERE
                cod_prod = :cod_prod ";

                $sentencia = $conexion ->prepare($sql);

                $sentencia -> bindParam (':nombre', $nombre, PDO :: PARAM_STR);
                $sentencia -> bindParam (':existencia', $existencia, PDO :: PARAM_STR);
                $sentencia -> bindParam (':cantidad_min', $cantidad_min, PDO :: PARAM_STR);
                $sentencia -> bindParam (':marca', $marca, PDO :: PARAM_STR);
                $sentencia -> bindParam (':categoria', $categoria, PDO :: PARAM_STR);
                $sentencia -> bindParam (':precio_compra', $precio_compra, PDO :: PARAM_STR);
                $sentencia -> bindParam (':precio_venta', $precio_venta, PDO :: PARAM_STR);
                $sentencia -> bindParam (':contiene_T', $contiene_T, PDO :: PARAM_STR);
                $sentencia -> bindParam (':contiene_A', $contiene_A, PDO :: PARAM_STR);
                $sentencia -> bindParam (':contiene_L', $contiene_L, PDO :: PARAM_STR);
                $sentencia -> bindParam (':descripcion', $descripcion, PDO :: PARAM_STR);
                $sentencia -> bindParam (':cod_prod', $cod_prod, PDO :: PARAM_STR);


                $sentencia -> execute();

                
                /*$resultado = $sentencia -> rowCount();

                if (count($resultado)) {
                    $actualizacion_correcta = true;
                } else {
                    $actualizacion_correcta = false;
                }*/
            
        }catch(PDOException $ex){
                print 'ERROR ' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion padre';}

        return $actualizacion_correcta;
    }

    public static function eliminar_inventario($conexion,$value){
        if (isset($conexion)){
        
            try{
                $sql= 'delete from inventario where cod_prod=' . $value;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                    
                print 'se ha borrado con exito!';}
 
            catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }
    }
    public static function obtener_producto($conexion,$cod_prod){
        
        $filas = '';
        
        if (isset($conexion)){
        
            try{
                $sql= " SELECT * from inventario where cod_prod =" .$cod_prod;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas = new Inventario($fila['cod_prod'], $fila['nombre'], $fila['existencia'],
                                      $fila['cantidad_min'], $fila['marca'], $fila['categoria'],$fila['precio_compra'],
                                      $fila['precio_venta'],$fila['contiene_T'],$fila['contiene_A'],
                                      $fila['contiene_L'],$fila['descripcion'],$fila['fecha_registro']);
                    }
                }
            }
                catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $filas;
    }

    public static function obtener_ultimo_insertado($conexion){        
        if (isset($conexion)){
            $cod_prod = 0;
            try{
                $sql= 'select  MAX(cod_prod) from inventario';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchColumn() ;
                
                $cod_prod = intval($resultado);
                
            }catch(PDOException $ex){
                print 'ERROR UID' . $ex -> getMessage();
            }
        }else{ echo 'no';}
        
        return $cod_prod;
    }
}
    ?>
            
        
       