<!-- Al registrar un remito, se debe ingresar el ID de la factura, los campos de ID ORDEN DE COMPRA
y PROVEEDOR son de salida y muestran los datos correspondientes al id de factura ingresado. La grilla 
se llena con los datos del DETALLE DE FACTURA, correspondiente al id de factura ingresado.

 -->
<!DOCTYPE html>
<?php
include_once '../config.inc.php';
include_once '../clases/escritor_remito.class.php';
include_once '../Conexion.class.php';

Conexion::abrirConexion();






?>
<html>

<head>
    <title>Registrar Remito</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/remito_registrar.css">
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
        <form name="formP1" action="">
            <table class="tabla" border="1px">
                <tr>
                    <td colspan="4" class="titulo">
                        REGISTRAR REMITO
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Fecha:</td>
                    <td class="valor">
                        <input type="date" name="Fecha" id="Fecha" readonly value="<?php echo date("Y-m-d"); ?>">
                    </td>

                    <td rowspan="4" colspan="2">
                        <!--Grilla de productos-->
                        <div class="table-responsive-lg">
                            <table id="grilla" class="table-hover table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th id="vp" colspan="6">Vista Previa</th>
                                    </tr>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Marca</th>
                                        <th>Precio Unitario</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_POST['seleccionar'])) {

                                        escritor_remito::escribir_detalles_factura($_POST['seleccionar']);
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </td>
                <tr>

                    <td class="titulos">ID Factura de compra:</td>
                    <td class="valor">
                        <form method="post">
                            <input type="text" style="width: 85%; margin-right: 1,5%" readonly name="cod_oc" id="codigo_oc" value="<?php

                                                                                                                                    if (isset($_POST['seleccionar'])) {

                                                                                                                                        echo $_POST['seleccionar'];
                                                                                                                                    } ?>">
                            <a href="<?php echo ruta_seleccionar_factura ?>">
                                <button type="button" name="buscar" id="gd" class="boton">
                                    <i class="fa fa-search"></i></button>
                            </a>
                        </form>
                    </td>
                </tr>

                <tr>
                    <td class="titulos">Proveedor:</td>
                    <td class="valor">
                        <input type="text" name="proveedor" id="prov" readonly value="<?php

                                                                                        if (isset($_POST['seleccionar'])) {

                                                                                            echo $_POST['proveedor'];
                                                                                        }

                                                                                        ?>">
                    </td>
                </tr>
                <tr>

                </tr>
                <tr>
                    <td colspan="2" class="titulos">Total:</td>
                    <td class="valor seg_col">
                        <input type="number" readonly name="precioTotal" id="precioTotal" value="<?php echo $total; ?>">
                    </td>
                    <td style="text-align:right" class="valor">
                        <button type="submit" name="enviar" id="gd" class="boton">REGISTRAR</button>
                    </td>
                </tr>

            </table>
        </form>
    </div>

    <div class="contenedor4">
        <a href="<?php echo ruta_remitos_principal ?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
    </div>

</body>

</html>