<!DOCTYPE html>
<?php
include_once '../config.inc.php';
include_once '../conexion.class.php';
include_once '../pantallas/barra_nav.php';
include_once '../clases/repositorio_ventas.class.php';
include_once '../clases/repositorio_factura.class.php';

Conexion::abrirConexion();


?>
<!-- GRAFICO PARA MOSTRAR NUMERO DE VENTAS EN LOS ULTIMOS 5 MESES -->
<?php
require_once("../phpChart_Lite/phpChart_Lite/conf.php");
?>
<!DOCTYPE HTML>
<html>

<head>
    <style type="text/css">
        .jqplot-target {
            margin-left: 20px;
            margin-top: 20px;
            width: 400px;
            height: 300px;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/cotizaciones_cargar.css">
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


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Informes</title>
</head>

<body>

    <div id="formulario" class="form">


        <table class="tabla" border="1px">

            <tr>
                <td class="titulo">
                    VENTAS
                </td>
                <td class="titulo">
                    COMPRAS
                </td>

            </tr>
            <tr>
                <td>
                    <?php
/*                     $ventas = repositorio_ventas::obtener_grafica_ventas(Conexion::obtenerConexion());
                    $ventas->draw(300, 500); */
                    ?>
                    <div class="contenedor3">
                        <form method="post" action="<?php echo ruta_remito_registrar ?>">
                            <button type="submit" name="boton" id="ap" class="boton"><i class="fa-print" aria-hidden="true"></i>Generar PDF</button>
                        </form>
                    </div>
                </td>
                <td>
                    <?php
                    $compras = repositorio_factura::obtener_grafica_compras(Conexion::obtenerConexion());
                    $compras->draw(300, 500);
                    ?>
                    <div class="contenedor3">
                        <form method="post" action="<?php echo ruta_remito_registrar ?>">
                            <button type="submit" name="boton" id="ap" class="boton"><i class="fa-print" aria-hidden="true"></i>Generar PDF</button>
                        </form>
                    </div>
                </td>
            </tr>





        </table>
    </div>


</body>

</html>