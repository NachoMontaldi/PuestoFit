<?php  
    include_once '../clases/repositorio_excel.class.php';
    include_once '../clases/repositorio_ventas.class.php';
    include_once '../conexion.class.php';
    
    Conexion::abrirConexion();
    $filas = repositorio_ventas::obtener_ingresos_excel(Conexion::obtenerConexion());   
    repositorio_excel::exportar_excel_ingresos($filas);
?>