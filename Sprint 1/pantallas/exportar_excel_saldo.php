<?php 
    include_once '../clases/repositorio_excel.class.php';
    include_once '../clases/repositorio_saldos.class.php';
    include_once '../conexion.class.php';
    
    Conexion::abrirConexion();
    $filas = repositorio_saldos::obtener_array(Conexion::obtenerConexion());   
    
    repositorio_excel::exportar_excel_saldo($filas);
?>