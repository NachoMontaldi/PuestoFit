<?php 
    include_once '../clases/repositorio_excel.class.php';
    include_once '../clases/repositorio_ranking_prod.class.php';
    include_once '../conexion.class.php';
    
    Conexion::abrirConexion();
    $conexion=Conexion::obtenerConexion();     
    if (isset($conexion)){
        try{
            $sql= 'select * from grilla_informes_ranking';
            
            $sentencia = $conexion ->prepare($sql);
            
            $sentencia -> execute();
            
            $resultado = $sentencia -> fetchAll();

            $titulos = ['Posicion','Total Vendidos (Unidades)','Total Vendidos ($)',
            'Cod. Prod','Nombre','Marca','Categoria',
            'Precio Compra','Precio Venta'];

            $resultadoaux = [];

            $resultadoaux[0] = $titulos;
        
            if(count($resultado)){ 
                $arrlength = count($resultado);
                for($i = 0; $i < $arrlength; $i=$i+1) {
                    $fila = $resultado[$i];
                    $arrlengthinterno = count($fila);
                    $filaaux = [];
                    for($j = 0; $j < $arrlengthinterno/2; $j=$j+1) {
                        $filaaux[$j] = $fila[$j];
                    }
                    $resultadoaux[$i+1] = $filaaux;
                }
            }
        }
        catch(PDOException $ex){
                print 'ERROR OT' . $ex -> getMessage();
        }
    }else{ echo 'No hay conexion';}
    repositorio_excel::exportar_excel_2($resultadoaux);
?>