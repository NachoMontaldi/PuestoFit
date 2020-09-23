<!DOCTYPE html>
<?php

include_once '../config.inc.php';
include_once '../conexion.class.php';
include_once '../clases/detalle_cotizacion.class.php';
include_once '../clases/escritor_filas_ordenes_de_compra.class.php';
include_once '../clases/repositorio_ordenes_de_compra.class.php';
include_once '../clases/repositorio_cotizacion.class.php';
include_once '../clases/redireccion.class.php';
include_once '../pantallas/barra_nav.php';

Conexion::abrirConexion();

if (isset($_POST['seleccionar'])) {

    $total = repositorio_cotizacion::calcular_precios($_POST['seleccionar']);
}

if (isset($_POST["registrar_oc"])) {
    $orden_de_compra = new ordenes_de_compra('', '', '', '', '', 0, '','');
    $orden_de_compra_insertada = repositorio_ordenes_de_compra::insertar_ordenes_de_compra(Conexion::obtenerConexion(), $orden_de_compra);
}

//permite obtener el id de la orden de compra que se crea vacia
$id = repositorio_ordenes_de_compra::obtener_ultimo_id(Conexion::obtenerConexion());


if (isset($_POST['enviar'])) {
    
    //actualiza el estado a 1
    $orden_de_compra_validada = repositorio_ordenes_de_compra::estado_orden_de_compra(Conexion::obtenerConexion(), $id);
    
    //actualiza el proveedor al que se seleccionó
    $pedido_proveedor = repositorio_ordenes_de_compra::proveedor_orden_de_compra(Conexion::obtenerConexion(), $id, $_POST['proveedor']);
    
    //actualiza el codigo pedido en ordenes de compras
    $codigo = repositorio_ordenes_de_compra::cotizacion_orden_de_compra(Conexion::obtenerConexion(), $id, $_POST['cod_cotizacion']);
    
    //actualiza el total en ordenes de compras
    repositorio_ordenes_de_compra::total_orden_de_compra(Conexion::obtenerConexion(), $id, $_POST['precioTotal']);
    
    // insertar los detalles
    repositorio_ordenes_de_compra::cargar_detalles($_POST['cod_cotizacion'], $id);
    
    // borrar los estados igual a 0
    repositorio_ordenes_de_compra::eliminar_falsos(Conexion::obtenerConexion());

    // actualiza estado de cotizacion a 2
    repositorio_cotizacion::actualizar_estado_listo(Conexion::obtenerConexion(),$_POST['cod_cotizacion']);

    //redirige despues de insertar
    Redireccion::redirigir(ruta_ordenes_de_compra_principal); 
}

?>

<html>

<head>
    <title>Registrar Orden de Compra</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/registrar_orden_de_compra.css">
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
        <form name="formP1" action="" method="post">
            <table class="tabla" border="1px">
                <tr>
                    <td colspan="4" class="titulo">
                        REGISTRAR ORDEN DE COMPRA
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Cotización:</td>
                    <td class="valor seg_col">
                        <input type="text" style="width:85%;" readonly name="cod_cotizacion" id="cod_cotizacion" value=<?php

                        if (isset($_POST['seleccionar'])) {

                            echo $_POST['seleccionar'];
                        } ?>>

                        <a href="<?php echo ruta_seleccionar_cotizacion ?>">
                            <button type="button" name="buscar" id="buscar" class="boton">
                                <i class="fa fa-search"></i></button>
                        </a>
                    </td>
                    <td class="titulos">Proveedor:</td>
                    <td class="valor">
                        <input type="text" readonly name="proveedor" id="proveedor" value="<?php

                        if (isset($_POST['proveedor'])) {

                            echo $_POST['proveedor'];

                        } ?>">

                    </td>
                </tr>

                <td colspan="4">
                    <!--Grilla de productos-->
                    <div class="table-responsive-lg">
                        <table id="grilla" class="table-hover table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th id="vp" colspan="9">Vista Previa</th>
                                </tr>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Marca</th>
                                    <th>Cantidad Pedida</th>
                                    <th>Precio Compra</th>
                                    <th>Subtotal</th>
                                </tr>
                                <?php
                                if (isset($_POST['seleccionar'])) {

                                    escritor_filas_ordenes_de_compra::escribir_detalles_cotizacion_oc($_POST['seleccionar']);
                                } ?>
                                </tbody>
                        </table>
                    </div>
                </td>
                </tr>
                <tr>
                    <td class="titulos">Total:</td>
                    <td class="valor seg_col">
                        <input type="number" readonly name="precioTotal" id="precioTotal" value="<?php echo $total; ?>">
                    </td>
                    <td style="text-align:right" class="valor" colspan="2">
                        <button type="submit" name="enviar" id="gd" class="boton">REGISTRAR</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div class="contenedor4">
        <a href="<?php echo ruta_ordenes_de_compra_principal ?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
    </div>

</body>