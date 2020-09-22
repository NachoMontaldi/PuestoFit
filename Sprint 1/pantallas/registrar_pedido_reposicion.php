<!DOCTYPE html>
<?php
include_once '../config.inc.php';
include_once '../conexion.class.php';
include_once '../clases/detalle_pedido.class.php';
include_once '../clases/repositorio_pedido_reposicion.class.php';
include_once '../clases/pedido_reposicion.class.php';
include_once '../clases/redireccion.class.php';
include_once '../clases/escritor_filas.class.php';
include_once '../pantallas/barra_nav.php';

Conexion::abrirConexion();



if (isset($_POST['registrar_pedido'])) {

    $pedido = new pedido_reposicion('', '', 1, 0);

    $detalle_insertado = repositorio_pedido_reposicion::insertar_pedido(Conexion::obtenerConexion(), $pedido);
}
$id = repositorio_pedido_reposicion::obtener_ultimo_id(Conexion::obtenerConexion());
if (isset($_POST['vista'])) {

    $detalle_pedido = new detalle_pedido('', $id, $_POST['nombre'], $_POST['marca'], $_POST['cantidad'], $_POST['observaciones']);

    $detalle_insertado = repositorio_pedido_reposicion::insertar_detalle_pedido(Conexion::obtenerConexion(), $detalle_pedido);
}


if (isset($_POST['enviar'])) {

    $pedido_validado = repositorio_pedido_reposicion::validar_pedido(Conexion::obtenerConexion(), $id);



    $borrar = repositorio_pedido_reposicion::eliminar_falsos(Conexion::obtenerConexion());

    Redireccion::redirigir(ruta_pedidos_reposicion_principal);
}



?>
<html>

<head>
    <title>Registrar Pedido de Reposición</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/registrar_pedido_reposicion.css">
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
        <table class="tabla" border="1px">
            <tr>
                <td colspan="3" class="titulo">
                    REGISTRAR PEDIDO DE REPOSICION
                </td>
            </tr>
            <tr>
                <td class="titulos">Fecha:</td>
                <td class="valor">
                    <input type="date" name="Fecha" id="Fecha" readonly value="<?php echo date("Y-m-d"); ?>">
                </td>
                <td colspan="2" rowspan="7">
                    <!--Grilla de productos-->
                    <div class="table-responsive-lg">
                        <table id="grilla" class="table-hover table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th id="vp" colspan="5">Vista Previa</th>
                                </tr>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Marca</th>
                                    <th>Cantidad</th>
                                    <th>Observaciones</th>
                                </tr>
                            <tbody>
                                <form method="post" action="<?php echo ruta_registrar_pedido_reposicion ?>">
                                    <?php

                                    //Metodo para borrar un elemento de la tabla

                                    if (isset($_POST['eliminar'])) {

                                        repositorio_pedido_reposicion::eliminar_detalle(Conexion::obtenerConexion(), $_POST['eliminar']);
                                    }




                                    escritor_filas::escribir_detalles_pedido($id);

                                    ?>
                                </form>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            <form method="post" action="<?php echo ruta_registrar_pedido_reposicion ?>">
                <tr>
                    <td class="titulos">Nombre producto:</td>
                    <td class="valor">
                        <input type="text" style="width: 75%; margin-right: 1,5%" readonly name="nombre" id="nombre" value='<?php
                                                                                                                            if (isset($_POST['agregar'])) {

                                                                                                                                echo $_POST['agregar'];
                                                                                                                            } ?>'>
                        <a href="<?php echo ruta_agregar_producto_pedido ?>"><button type="button" name="buscar" id="gd" class="boton">
                                <i class="fa fa-search"></i></button></a>
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Marca:</td>
                    <td class="valor">
                        <input type="text" readonly name="marca" id="marca" value='<?php
                                                                                    if (isset($_POST['agregar'])) {

                                                                                        echo $_POST['marca'];
                                                                                    } ?>'>
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Cantidad:</td>
                    <td class="valor">
                        <input type="number" name="cantidad" id="cantidad" min="1">
                    </td>
                </tr>
                <tr>
                    <td class="titulos" valign="top">Observaciones:</td>
                    <td class="valor">
                        <textarea name="observaciones" id="observaciones"></textarea>
                    </td>
                </tr>
                <tr></tr>
                <td class="valor" colspan="2">
                    <div class="botones">
                        <input type="submit" name="vista" value="Agregar a Vista Previa" id="avp">
                    </div>
                </td>
                </tr>
            </form>
            <form method="post">
                <tr>
                    <td colspan="4" style="text-align:right" class="valor">
                        <button type="submit" name="enviar" id="gd" class="boton">REGISTRAR</button>
                    </td>
                </tr>
            </form>
        </table>
    </div>

    <div class="contenedor4">
        <a href="<?php echo ruta_pedidos_reposicion_principal ?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
    </div>
</body>

</html>