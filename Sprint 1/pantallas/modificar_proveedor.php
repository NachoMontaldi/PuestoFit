<!DOCTYPE html>
<?php
include_once '../conexion.class.php';
include_once '../config.inc.php';
include_once '../clases/proveedores.class.php';
include_once '../clases/repositorio_proveedores.class.php';
include_once '../clases/redireccion.class.php';
include_once '../pantallas/barra_nav.php';

Conexion::abrirConexion();
if (isset($_POST['editar'])) {

    print 'entre por editar';

    $proveedor = repositorio_proveedores::obtener_proveedor(Conexion::obtenerConexion(), $_POST['editar']);
    $_SESSION['id'] = '';
    $_SESSION['id'] = $_POST['editar'];

    echo $_SESSION['id'];
}

?>
<html>

<head>
    <title>Modificar un proveedor</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/alta_mod_proveedor.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>


    <!--------------------------------------------------------------------------------------------------------------->

    <body>
        <div id="formulario" class="form">
            <form name="formP1" action="<?php echo ruta_proveedor_principal ?>" method="post">
                <table class="tabla" border="1px">
                    <tr>
                        <td colspan="4" class="titulo">
                            MODIFICAR PROVEEDOR
                        </td>
                    </tr>
                    <tr>
                        <td class="titulos">Nombre:</td>
                        <td class="valor">
                            <input type="text" name="nombre" id="nombre" value="<?php echo $proveedor->obtener_nombre() ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="titulos">Cuil:</td>
                        <td class="valor">
                            <input type="text" name="cuil" id="cuil" value="<?php echo $proveedor->obtener_CUIL() ?>">
                        </td>

                    </tr>
                    <tr>
                        <td class="titulos">Dirección:</td>
                        <td class="valor">
                            <input type="text" name="direccion" id="direccion" value="<?php echo $proveedor->obtener_direccion() ?>">
                        </td>


                    </tr>
                    <tr>
                        <td class="titulos">Teléfono:</td>
                        <td class="valor">
                            <input type="tel" name="telefono" id="telefono" value="<?php echo $proveedor->obtener_telefono() ?>">
                        </td>

                    </tr>
                    <tr>
                        <td class="titulos" valign="top">Email:</td>
                        <td class="valor">
                            <input type="email" name="email" id="email" value="<?php echo $proveedor->obtener_email() ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:right" class="valor">
                            <button type="submit" name="guardar_cambios" id="gd" class="boton">GUARDAR</button>
                            <button type="refresh" name="limpiar" id="ld" class="boton">LIMPIAR DATOS</button>
                        </td>
                        <?php //input invisible para poder llevar el id a proveedores_principal
                        ?>
                        <input type="hidden" name="id" id="id" value="<?php echo $proveedor->obtener_cod_prov(); ?>"></input>
                    </tr>
                </table>
            </form>
        </div>

        <div class="contenedor4">
            <a href="<?php echo ruta_proveedor_principal ?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
        </div>

    </body>

</html>