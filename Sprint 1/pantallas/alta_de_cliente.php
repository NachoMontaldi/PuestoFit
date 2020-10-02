<?php

include_once '../conexion.class.php';
include_once '../config.inc.php';

include_once '../pantallas/barra_nav.php';

/* if (isset($_POST['enviar'])) {

    Conexion::abrirConexion();

    //$id_proveedor = repositorio_proveedores::obtener_id_proveedor(Conexion::obtenerConexion(), $_POST['proveedor']);

    $inventario = new Inventario('', $_POST['nombre'],null, $_POST['cantidadMin'], $_POST['categoria'],$_POST['marca'], $_POST['precioC'], $_POST['precioV'], $_POST['contieneT'], $_POST['contieneA'], $_POST['contieneL'], $_POST['descripcion'], '');

    //Salvo la cantidad
    $inventario_insertado = repositorio_inventario::insertar_inventario(Conexion::obtenerConexion(), $inventario);
    $cod_prod = repositorio_inventario::obtener_ultimo_insertado(Conexion::obtenerConexion());

    //Insertar nuevo producto a tabla stock por deposito a todas las sucursales
    $stock_insertado = repositorio_inventario::insertar_prod_stock_deposito(Conexion::obtenerConexion(),$cod_prod);

    if ($inventario_insertado && $stock_insertado) {

        Redireccion::redirigir(ruta_inventario_principal);
    }
} */

Conexion::cerrarConexion();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Registrar un cliente</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/agregar_producto_pedido.css">
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
</head>

<body>


    <!---------------------------------------------------------------------------------------------------->
    <div id="formulario" class="form">
        <form name="formP1" action="" method="post">
            <table class="tabla" border="1px">
                <tr>
                    <td colspan="4" class="titulo">
                        REGISTRAR UN NUEVO CLIENTE
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Nombre y Apellido:</td>
                    <td class="valor" colspan="3">
                        <input type="text" name="nombre" id="nombre">
                    </td>
                </tr>
                <tr>
                    <td class="titulos">DNI:</td>
                    <td class="valor">
                        <input type="text" name="dni" id="dni">
                    </td>
                    <td class="titulos">Fecha de nacimiento:</td>
                    <td class="valor">
                        <input type="date" name="fecha_nac" id="fecha_nac">
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Dirección: </td>
                    <td class="valor">
                        <input type="text" name="direccion" id="direccion">
                    </td>

                    <td class="titulos">Teléfono:</td>
                    <td class="valor">
                        <input type="telefono" name="telefono" id="telefono">
                    </td>

                </tr>
                <tr>
                    <td class="titulos" valign="top">Email:</td>
                    <td class="valor" colspan="3">
                        <input type="email" name="email" id="email" >
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
        <a href="<?php echo ruta_clientes_principal?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
    </div>

</body>

</html>