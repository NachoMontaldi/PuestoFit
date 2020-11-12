<?php 
    include_once '../clases/repositorio_excel.class.php';
    include_once '../clases/repositorio_pago.class.php';
    include_once '../conexion.class.php';
    
    Conexion::abrirConexion();
    $filas = repositorio_pago::obtener_egresos_excel(Conexion::obtenerConexion());  

    
    
    repositorio_excel::exportar_excel_egresos($filas);
?>