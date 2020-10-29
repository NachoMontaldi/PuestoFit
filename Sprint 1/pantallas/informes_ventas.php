<!DOCTYPE html>
<?php
include_once '../config.inc.php';
include_once '../conexion.class.php';
include_once '../pantallas/barra_nav.php';
include_once '../clases/repositorio_ventas.class.php';
include_once '../clases/repositorio_factura.class.php';
require_once("../phpChart_Lite/phpChart_Lite/conf.php");

Conexion::abrirConexion();

?>
<!-- GRAFICO PARA MOSTRAR NUMERO DE VENTAS EN LOS ULTIMOS 5 MESES -->
<html>

<head>
    <title>Informes</title>


    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/registrar_pedido_reposicion.css">
    <link href='https://fonts.googleapis.com/css?family=' Actor'' rel='stylesheet'>
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
    <style type="text/css">
        .jqplot-target {
            margin-left: 8%; 
            margin-top: 20px;
            width: 400px;
            height: 300px;
        }
        .form {
            margin-top: 7%;    
        }
    </style>

</head>

    <body>

        <div id="formulario" class="form">
            <table class="tabla" border="1px">
                <tr>
                    <td class="titulo">
                    Nº VENTAS
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        repositorio_ventas::obtener_grafica_ventas(Conexion::obtenerConexion());
                        ?>
                    </td>
                </tr>
                <tr>
                    <div class="contenedor3">
                        <form method="post" action="<?php echo ruta_pdf_venta ?>">
                            <button type="submit" name="enviar" id="gd" class="boton"><i class="" aria-hidden="true"></i>Generar PDF</button>
                        </form>
                    </div>
                </tr>
            </table>
        </div>
    </body>
</html>