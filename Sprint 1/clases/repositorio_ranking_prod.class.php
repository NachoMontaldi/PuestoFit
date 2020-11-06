<?php
    
    include_once '../conexion.class.php';
    include_once '../clases/escritor_informe_ranking_prod.class.php';
    include_once '../clases/ranking_prod.class.php';
    require_once("../phpChart_Lite/phpChart_Lite/conf.php");

    class repositorio_ranking_prod{

        public static function obtener_productos_rankeados($conexion){
                
            $filas = [];
            if (isset($conexion)){
                try{
                    $sql= 'select * from grilla_informes_ranking;';
                    
                    $sentencia = $conexion ->prepare($sql);
                    
                    $sentencia -> execute();
                    
                    $resultado = $sentencia -> fetchAll();
                    
                    if(count($resultado)){
                        foreach($resultado as $fila){
                            $filas[] = new ranking_prod($fila['ROW_NUMBER() Over (Order By sum(dv.cantidad) desc)'],
                                                        $fila['total_unidades'],$fila['total'],
                                                        $fila['cod_prod'],$fila['nombre'],$fila['marca'],
                                                        $fila['categoria'],$fila['precio_compra'], $fila['precio_venta']);
                        } 
                    }
                }catch(PDOException $ex){
                    print 'ERROR OT' . $ex -> getMessage();
                }
            }else{ echo 'No hay conexion :(';}

            return $filas;
        }    
    }
?>