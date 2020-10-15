<?php

include_once '../conexion.class.php';
include_once '../config.inc.php';
include_once '../pantallas/barra_nav.php';
include_once '../clases/ventas.class.php';
include_once '../clases/repositorio_ventas.class.php';
include_once '../clases/repositorio_movimientos_stock.class.php';
include_once '../clases/escritor_ventas.class.php';
include_once '../clases/redireccion.class.php';

Conexion::abrirConexion();

$id = repositorio_ventas::obtener_ultimo_id(Conexion::obtenerConexion());
$total = repositorio_ventas::calcular_precios($id);

if (isset($_POST['enviar'])) {

    
    repositorio_ventas::venta_cargada(Conexion::obtenerConexion(), $id,  $_POST['num_factura'], 
        $_POST['tipo_factura'], $_POST['cod_cliente'], $_POST['metodo_pago'], $_POST['observaciones'], $_POST['importe']);

 //actualiza el estado de venta a 1
    $venta_validada = repositorio_ventas::estado_venta(Conexion::obtenerConexion(), $id);

   // borrar los estados igual a 0
    repositorio_ventas::eliminar_falsos(Conexion::obtenerConexion());

    //Actualiza las tablas movimientos_stock, detalle_movimientos de stock y stock_deposito
    repositorio_movimientos_stock::cargar_mov_stock_ventas($id);

    //Elimina los movimientos_stock que tengan estado 0
    $borrar = repositorio_movimientos_stock::eliminar_falsos(Conexion::obtenerConexion());

    Redireccion::redirigir(ruta_ventas_principal);

    
    }   


?>
<!DOCTYPE html>
<html>

<head>
    <title>Registrar Venta</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/alta_mod_proveedor.css">
    <link href='https://fonts.googleapis.com/css?family='Actor'' rel='stylesheet'>
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
</head>

<body>


    <!---------------------------------------------------------------------------------------------------->
    <div id="formulario" class="form">
        <form name="formP1" action="" method="post">
            <table class="tabla" border="1px">
                <tr>
                    <td colspan="4" class="titulo">
                        COMPLETAR DATOS DE VENTA
                    </td>
                </tr>
                <tr>
                <td class="titulos">Fecha:</td>
                <td class="valor">
                    <input type="date" name="Fecha" id="Fecha" readonly value="<?php echo date("Y-m-d"); ?>">
                </td>
                    <td class="titulos">Sucursal:</td>
                    <td class="valor" colspan="3">
                        <input type="text" readonly name="sucursal" id="sucursal" value='Santa Ana'>
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Cod. Cliente:</td>
                    <td class="valor" colspan="3">
                        <input type="" style="width: 90%; margin-right: 0%" readonly name="cod_cliente" id="cod_cliente" value='<?php
                                    if (isset($_POST['seleccionar'])) {

                                    echo $_POST['seleccionar'];
                                }  ?>'>
                        <a href="<?php echo ruta_agregar_cliente_venta ?>"><button type="button" style="padding: 7px 7px;" name="busqueda" id="buscar" class="boton_buscar">
                                <i class="fa fa-search"></i></button></a>
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Nombre Cliente:</td>
                    <td class="valor" colspan="3">
                        <input type="text" readonly name="nombre" id="nombre" value='<?php if (isset($_POST['seleccionar'])) {
                                                                                                    echo $_POST['nombre'];
                                                                                                    } ?>'>
                    </td>
                </tr>

                <tr>
                    
                    <td class="titulos">Metodo de pago:</td>
                    <td class="valor" colspan="3">
                        <!-- desplegable -->
                        <select name="metodo_pago" id="metodo_pago">
                        <option selected value=""> Elije un Metodo de pago</option> 
                        <option value="Efectivo">Efectivo</option>            
                        <option value="Transferencia Bancaria">Transferencia Bancaria</option>  
                        <option value="Pago con tarjeta">Pago con tarjeta</option>  
                        <option value="Cheque">Cheque</option>  

                        </select>
                    </td>

                </tr>

                <tr>
                    <td class="titulos">Nº Factura:</td>
                    <td class="valor">
                        <input type="" name="num_factura" id="num_factura">
                    </td>
                    <td class="titulos">Tipo de factura:</td>
                    <td class="valor">
                    <!-- desplegable -->
                    <select name="tipo_factura" id="tipo_factura">
                        <option selected value="0"> Elije el tipo de factura</option>
                        <option value="A">A</option>  
                        <option value="B">B</option>  
                        <option value="C">C</option>  
                    </select>
                    </td>  

                </tr>


                <tr>
                    <td class="titulos" valign="top">Importe:</td>
                    <td class="valor" colspan="">
                        <input type="" readonly name="importe" id="importe" value='<?php echo $total ; ?> '>
                    </td>
                    
                    <td class="titulos" valign="top">Observaciones:</td>
                    <td class="valor">
                        <textarea name="observaciones" id="observaciones"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right" class="valor">
                        <button type="submit" name="enviar" id="gd" class="boton">REGISTRAR</button>
                        <button type="refresh" name="limpiar" id="ld" class="boton">LIMPIAR DATOS</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>




    <div class="contenedor4">
        <a href="<?php echo ruta_registrar_detalle_venta?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
    </div>

</body>

</html>