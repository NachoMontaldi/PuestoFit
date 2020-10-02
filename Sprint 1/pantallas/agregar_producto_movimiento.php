<!DOCTYPE html>
<?php
include_once '../config.inc.php';
include_once '../conexion.class.php';
include_once '../pantallas/barra_nav.php';
include_once '../clases/escritor_movimientos_stock.class.php';

Conexion::abrirConexion();

?>
<html>

<head></head>
<title>Seleccionar producto para el ajuste de stock</title>
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
<!---->

</head>

<body>

    <!---------------------------------------------------------------------------------------------------->
    <div id="formulario" class="form">
        <form name="formP1" action="" method="post">
            <table class="tabla" border="1px">
                <tr>
                    <td colspan="4" class="titulo">
                        SELECCIONAR PRODUCTO
                <tr>
                    <td colspan="4" class="valor">
                        <!---BARRA DE BUSQUEDA-->
                        <!--Se mete dentro de un form para poder usar el metodo post-->
                        <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <div class="form-group">
                                <p id="busqueda">
                                    <input type="text" class="form-control" id="searchBox" name="criterio" placeholder="BUSCAR">
                                    <!--El button se hace de type = "submit" para que pueda trasladar datos-->
                                    <button type="submit" name="busqueda" id="buscar" class="boton_buscar"><i class="fa fa-search"></i></button>
                                </p>
                            </div>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <!--Grilla de productos-->
                        <div class="table-responsive-lg">
                            <table id="grilla" class="table-hover table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Cod Producto</th>
                                        <th>Nombre</th>
                                        <th>Marca</th>
                                        <th>Categoría</th>
                                        <th>Precio Compra</th>
                                        <th></th>
                                    </tr>
                                    <?php

                                    if (isset($_POST['busqueda'])) {

                                        $criterio = $_POST['criterio'];
                                        escritor_movimientos_stock::escribir_productos_filtrados_sel($criterio);
                                    } else {

                                        escritor_movimientos_stock::escribir_productos_sel();
                                    } 
                                    ?>
                                    </tbody>
                            </table>
                        </div>
                    </td>
            </table>
        </form>
    </div>




    <div class="contenedor4">
        <a href="<?php echo ruta_registrar_movimiento_stock ?>"><button name="volver" id="volver">VOLVER</button></a>
    </div>
</body>

</html>