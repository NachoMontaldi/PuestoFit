<?php
    
    include_once '../conexion.class.php';
    include_once 'clientes.class.php';

    class repositorio_clientes{
        
        public static function insertar_cliente($conexion,$cliente){
        $cliente_insertado = false;
        
        if (isset($conexion)){
            try{
                $sql = "insert into clientes(nombre,dni,fecha_nacimiento,direccion,telefono,email) values
                 (:nombre,:dni,:fecha_nacimiento,:direccion,:telefono,:email)";
                
                $nombretemp = $cliente -> obtener_nombre();
                $dnitemp = $cliente -> obtener_dni();
                $fechatemp = $cliente -> obtener_fecha_nacimiento();
                $direcciontemp = $cliente -> obtener_direccion();
                $telefonotemp = $cliente -> obtener_telefono();
                $emailtemp = $cliente -> obtener_email();
                
                
                
                $sentencia = $conexion ->prepare($sql);

                
                $sentencia -> bindParam(':nombre', $nombretemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':dni', $dnitemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':fecha_nacimiento', $fechatemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':direccion', $direcciontemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':telefono', $telefonotemp, PDO::PARAM_STR);
                $sentencia -> bindParam(':email', $emailtemp, PDO::PARAM_STR);
                
                
            $cliente_insertado = $sentencia -> execute();
                
            } catch(PDOException $ex){
                print 'ERROR INSCo' . $ex -> getMessage();
            }
            
            return $cliente_insertado;
        }
        else{
            echo 'No hubo conexion en clientes!!';
        }
        
    }
    public static function obtener_cliente_modificar($conexion,$cod_cliente){
        
        $filas = '';
        
        if (isset($conexion)){
        
            try{
                $sql= " SELECT * from clientes where cod_cliente =" .$cod_cliente;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas = new Clientes($fila['cod_cliente'], $fila['nombre'],$fila['dni'],
                        $fila['fecha_nacimiento'],$fila['direccion'], $fila['telefono'], $fila['email']);
                    }
                }
            }
                catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $filas;
    }
    public static function actualizar_clientes($conexion, $cod_cliente, $nombre, $dni, $fecha_nacimiento, $direccion, $telefono, $email){
        $actualizacion_correcta = false;
        
        if (isset($conexion)){
            
            try{
                $sql = "UPDATE clientes set nombre = :nombre, dni = :dni, fecha_nacimiento = :fecha_nacimiento, direccion = :direccion, telefono = :telefono, email = :email
                        WHERE cod_cliente = :cod_cliente ";

                $sentencia = $conexion ->prepare($sql);

                $sentencia -> bindParam (':nombre', $nombre, PDO :: PARAM_STR);
                $sentencia -> bindParam (':dni', $dni, PDO :: PARAM_STR);
                $sentencia -> bindParam (':fecha_nacimiento', $fecha_nacimiento, PDO :: PARAM_STR);
                $sentencia -> bindParam (':direccion', $direccion, PDO :: PARAM_STR);
                $sentencia -> bindParam (':telefono', $telefono, PDO :: PARAM_STR);
                $sentencia -> bindParam (':email', $email, PDO :: PARAM_STR);
                $sentencia -> bindParam (':cod_cliente', $cod_cliente, PDO :: PARAM_STR);


                $sentencia -> execute();

            
        }catch(PDOException $ex){
                print 'ERROR ' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion padre';}

        return $actualizacion_correcta;
    }

    public static function obtener_clientes($conexion){
            
        $filas = [];
        if (isset($conexion)){
            try{
                $sql= 'select * from clientes ;';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();

                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new clientes($fila['cod_cliente'],$fila['nombre'],$fila['dni'],
                        $fila['fecha_nacimiento'], $fila['direccion'], $fila['telefono'], $fila['email']);
                    }
                } 
            }catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion en clientes_principal!:(';}

        return $filas;
    }


    public static function obtener_clientes_filtrados($conexion,$criterio){
        
        $filas = [];
        $criterio_min=strtolower($criterio);
        
        if (isset($conexion)){
        
            try{
                $sql= 'select * from clientes where (cod_cliente LIKE "%'.$criterio_min. '%" 
                       OR nombre LIKE "%' .$criterio_min. '%" OR dni LIKE "%'. $criterio_min. '%" 
                       OR fecha_nacimiento LIKE "%' .$criterio_min.'%" OR direccion LIKE "%'  .$criterio_min.'%" 
                       OR telefono LIKE "%' .$criterio_min.'%" OR email LIKE "%' .$criterio_min.'%")';
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $filas[] = new Clientes($fila['cod_cliente'],$fila['nombre'],$fila['dni'],
                                      $fila['fecha_nacimiento'], $fila['direccion'], $fila['telefono'], $fila['email']);
                    }
                }

                
            }catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        }else{ echo 'No hay conexion :(';}
        
        return $filas;
    } 


    public static function eliminar_cliente($conexion,$value){
        if (isset($conexion)){
        
            try{
                $sql= 'delete from clientes where cod_cliente=' .$value;
                
                $sentencia = $conexion ->prepare($sql);
                
                $sentencia -> execute();
                    
                print 'se ha borrado con exito!';}

            catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
            }
        } 
    }


    }