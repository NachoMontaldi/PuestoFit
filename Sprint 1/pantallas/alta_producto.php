<?php

include_once '../conexion.class.php';
include_once '../config.inc.php';
include_once '../clases/inventario.class.php';
include_once '../clases/repositorio_proveedores.class.php';
include_once '../clases/repositorio_inventario.class.php';
include_once '../clases/redireccion.class.php';
include_once '../pantallas/barra_nav.php';

if (isset($_POST['enviar'])) {

    Conexion::abrirConexion();

    $id_proveedor = repositorio_proveedores::obtener_id_proveedor(Conexion::obtenerConexion(), $_POST['proveedor']);

    $inventario = new Inventario('', $_POST['nombre'], $_POST['cantidad'], $_POST['cantidadMin'], $_POST['marca'], $_POST['categoria'], $_POST['precioC'], $_POST['precioV'], $_POST['contieneT'], $_POST['contieneA'], $_POST['contieneL'], $_POST['descripcion'], '', $id_proveedor, 1);

    $inventario_insertado = repositorio_inventario::insertar_inventario(Conexion::obtenerConexion(), $inventario);

    if ($inventario_insertado) {

        Redireccion::redirigir(ruta_inventario_principal);
    }
}

Conexion::cerrarConexion();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Registrar un producto</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/alta_producto.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link href='https://fonts.googleapis.com/css?family=Actor' rel='stylesheet'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>


    <!---------------------------------------------------------------------------------------------------->
    <div id="formulario" class="form">
        <form name="formP1" action="" method="post">
            <table class="tabla" border="1px">
                <tr>
                    <td colspan="4" class="titulo">
                        REGISTRAR UN NUEVO PRODUCTO
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Nombre producto:</td>
                    <td class="valor" colspan="3">
                        <input type="text" name="nombre" id="nombre">
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Categoria:</td>
                    <td class="valor">
                        <select name="categoria" id="categoria">
                            <option selected value="0"> Elije una categoria</option>
                            <option value="cereales">Cereales</option>
                            <option value="yogures">Yogures</option>
                            <option value="suplementos">Suplementos</option>
                            <option value="barritas">Barritas</option>
                        </select>
                    </td>
                    <td class="titulos">Cantidad:</td>
                    <td class="valor">
                        <input type="number" name="cantidad" id="cantidad">
                    </td>

                </tr>
                <tr>
                    <td class="titulos">Marca:</td>
                    <td class="valor">
                        <input type="text" name="marca" id="marca">
                    </td>
                    <td class="titulos">Cantidad Mínima:</td>
                    <td class="valor">
                        <input type="number" name="cantidadMin" id="cantidadMin">
                    </td>

                </tr>
                <tr>
                    <td class="titulos">Precio de costo:</td>
                    <td class="valor">
                        <input type="number" name="precioC" id="precioC">
                    </td>

                    <td class="titulos">Precio de venta:</td>
                    <td class="valor">
                        <input type="number" name="precioV" id="precioV">
                    </td>

                </tr>
                <tr>
                    <td class="titulos" valign="top">Observaciones:</td>
                    <td class="valor">
                        <select name="contieneT" id="contieneT">
                            <option selected value="0"> ¿Contiene TACC?</option>
                            <option value="si">Si</option>
                            <option value="no">No</option>
                        </select>
                        <br>
                        <br>
                        <select name="contieneA" id="contieneA">
                            <option selected value="0"> ¿Contiene Azúcar?</option>
                            <option value="si">Si</option>
                            <option value="no">No</option>
                        </select>
                        <br>
                        <br>
                        <select name="contieneL" id="contieneL">
                            <option selected value="0"> ¿Contiene Lactosa?</option>
                            <option value="si">Si</option>
                            <option value="no">No</option>
                        </select>
                    </td>
                    <td class="titulos" valign="top">Descripción:</td>

                    <td class="valor">
                        <textarea name="descripcion" id="Descripcion"></textarea>
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
        <a href="<?php echo ruta_inventario_principal ?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
    </div>

</body>

</html>