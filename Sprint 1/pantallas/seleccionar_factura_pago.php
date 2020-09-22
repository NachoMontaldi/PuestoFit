<!DOCTYPE html>
<?php
include_once '../config.inc.php';
//include_once '../clases/escritor_factura_pago.class.php';
include_once '../conexion.class.php';
include_once '../clases/repositorio_factura.class.php';
//include_once '../clases/escritor_pagos.class.php';
include_once '../pantallas/barra_nav.php';


Conexion::abrirConexion();
?>
<html>

<head></head>
<title>Seleccionar factura</title>
<link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
<link rel="stylesheet" type="text/css" href="/puestofit/css/seleccionar_pedido_rep.css">
<link href='https://fonts.googleapis.com/css?family=Actor' rel='stylesheet'>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--Tabla con bootstrap-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!---->

</head>

<body>


    <!---------------------------------------------------------------------------------------------------->
    <div id="formulario" class="form">
        <table class="tabla" border="1px" style="height: 400px">
            <tr>
                <td colspan="4" class="titulo">
                    SELECCIONAR FACTURA

            <tr>
                <td colspan="4">
                    <!--Grilla de productos-->
                    <div class="table-responsive-lg">
                        <table id="grilla" class="table-hover table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Cod Factura</th>
                                    <th>Fecha</th>
                                    <th>Proveedor</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                                <?php
                                //escritor para las facturas
                                //escritor_pago::escribir_remitos();
                                ?>
</html>