<!DOCTYPE html>
<?php
include_once '../conexion.class.php';
include_once '../config.inc.php';
include_once '../clases/clientes.class.php';
include_once '../clases/repositorio_clientes.class.php';
include_once '../clases/redireccion.class.php';
include_once '../pantallas/barra_nav.php';

Conexion::abrirConexion();
if (isset($_POST['editar'])) {


    $cliente = repositorio_clientes::obtener_cliente_modificar(Conexion::obtenerConexion(), $_POST['editar']);
    $_SESSION['id'] = '';
    $_SESSION['id'] = $_POST['editar'];


    
}

?>
<html>

<head>
    <title>Modificar un cliente</title>
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


    <!--------------------------------------------------------------------------------------------------------------->

    <body>
        <div id="formulario" class="form">
            <form name="formP1" action="<?php echo ruta_clientes_principal ?>" method="post">
                <table class="tabla" border="1px">
                    <tr>
                        <td colspan="4" class="titulo">
                            MODIFICAR CLIENTE
                        </td>
                    </tr>
                    <tr>
                    <td class="titulos">Nombre y Apellido:</td>
                    <td class="valor" colspan="3">
                        <input type="text" name="nombre" id="nombre"  value="<?php echo $cliente->obtener_nombre() ?>">
                    </td>
                </tr>
                <tr>
                    <td class="titulos">DNI/CUIL:</td>
                    <td class="valor">
                        <input type="text" name="dni" id="dni"  value="<?php echo $cliente->obtener_dni() ?>">
                    </td>
                    <td class="titulos">Fecha de nacimiento:</td>
                    <td class="valor">
                        <input type="input" name="fecha_nac" id="fecha_nac"  value="<?php echo $cliente-> obtener_fecha_nacimiento() ?>">
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Dirección: </td>
                    <td class="valor">
                        <input type="text" name="direccion" id="direccion"  value="<?php echo $cliente->obtener_direccion() ?>">
                    </td>

                    <td class="titulos">Teléfono:</td>
                    <td class="valor">
                        <input type="telefono" name="telefono" id="telefono"  value="<?php echo $cliente->obtener_telefono() ?>">
                    </td>

                </tr>
                <tr>
                    <td class="titulos" valign="top">Email:</td>
                    <td class="valor" colspan="3">
                        <input type="email" name="email" id="email"  value="<?php echo $cliente->obtener_email() ?>">
                    </td>
                </tr>
                    <tr>
                        <td colspan="4" style="text-align:right" class="valor">
                            <button type="submit" name="guardar_cambios" id="gd" class="boton">GUARDAR</button>
                            <button type="refresh" name="limpiar" id="ld" class="boton">LIMPIAR DATOS</button>
                        </td>
                        <?php //input invisible para poder llevar el id a proveedores_principal
                        ?>
                        <input type="hidden" name="id" id="id" value="<?php echo $cliente->obtener_cod_cliente(); ?>"></input>
                    </tr>
                </table>
            </form>
        </div>

        <div class="contenedor4">
            <a href="<?php echo ruta_clientes_principal ?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
        </div>

    </body>

</html>