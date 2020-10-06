<!DOCTYPE html>
<?php
include_once '../config.inc.php';
include_once '../conexion.class.php';
include_once '../pantallas/barra_nav.php';
include_once '../clases/redireccion.class.php';

include_once '../clases/detalle_movimientos_stock.class.php';
include_once '../clases/repositorio_movimientos_stock.class.php';
include_once '../clases/movimientos_stock.class.php';
include_once '../clases/escritor_movimientos_stock.class.php';

Conexion::abrirConexion();

$id = repositorio_movimientos_stock::obtener_ultimo_id(Conexion::obtenerConexion());

$tipo_ajuste = repositorio_movimientos_stock::obtener_tipo_ajuste(Conexion::obtenerConexion(),$id);

if (isset($_POST['vista'])) {

    $detalle_movimiento_stock = new detalle_movimientos_stock('', $_POST['cod_prod'], $_POST['cantidad'], $id,null,null);
    
    repositorio_movimientos_stock::insertar_detalle_movimiento_stock(Conexion::obtenerConexion(), $detalle_movimiento_stock);
}

if (isset($_POST['enviar'])) {

    //Actualiza el estado del movimiento a 1
    $movimiento_validado = repositorio_movimientos_stock::validar_movimiento_stock(Conexion::obtenerConexion(), $id);      

    //Actualiza la cantidad en stock_deposito de los productos cargados
    repositorio_movimientos_stock::actualizar_stock_deposito_mov($id,$tipo_ajuste);

    //Elimina los movimientos que tengan estado 0
    $borrar = repositorio_movimientos_stock::eliminar_falsos(Conexion::obtenerConexion());

    Redireccion::redirigir(ruta_movimientos_stock_principal);
}

?>
<html>

<head>
    <title>Registrar Detalle Ajuste</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/registrar_pedido_reposicion.css">
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
                    REGISTRAR PRODUCTOS DE AJUSTE
                </td>
            </tr>
            <tr>
                <td class="titulos">Nombre producto:</td>
                <td class="valor">
                    <input type="text" style="width: 85%; margin-right: 1,5%" readonly name="nombre" id="nombre" value='<?php
                        if (isset($_POST['seleccionar'])) {

                            echo $_POST['nombre'];

                        } ?>'>
                    <a href="<?php echo ruta_agregar_producto_movimiento ?>"><button type="button" name="busqueda" id="buscar" class="boton_buscar">
                            <i class="fa fa-search"></i></button></a>
                </td>
                <td colspan="2" rowspan="4">
                    <!--Grilla de productos-->
                    <div class="table-responsive-lg">
                        <table id="grilla" class="table-hover table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th id="vp" colspan="4">Vista Previa</th>
                                </tr>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Marca</th>
                                    <th>Cantidad</th>
                                    <th>ELIMINAR</th>
                                </tr>
                            <tbody>
                                    <?php

                                    if (isset($_POST['eliminar'])) {

                                    repositorio_movimientos_stock::eliminar_detalle(Conexion::obtenerConexion(), $_POST['eliminar']);
                                    }

                                    escritor_movimientos_stock::escribir_detalles_movimientos_stock($id);

                                        
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            <form method="post" action="<?php echo ruta_registrar_detalle_movimiento?>">

                <tr>
                    <td class="titulos">Marca:</td>
                    <td class="valor">
                    <input type="text" readonly name="marca" id="marca" value='<?php
                        if (isset($_POST['seleccionar'])) {

                            echo $_POST['marca'] ;

                        } ?> '>
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Cantidad:</td>
                    <td class="valor">
                        <input type="number" name="cantidad" id="cantidad" min="1">
                    </td>
                </tr>
                <tr>
                    <td class="valor" colspan="2">
                        <div class="botones">
                            <input type="submit" name="vista" value="Agregar a Vista Previa" id="avp">
                        </div>
                    </td>
                </tr>
                <input type="hidden" name="cod_prod" id="cod_prod" value='<?php
                        if (isset($_POST['seleccionar'])) {

                            echo $_POST['seleccionar'];

                        } ?>'>
                <input type="hidden" name="nombre2" id="nombre2" value='<?php
                        if (isset($_POST['seleccionar'])) {

                            echo $_POST['nombre'];

                        } ?>'>
                
                <input type="hidden" name="tipo_ajuste2" id="tipo_ajuste2" value='<?php
                        if (isset($_POST['continuar'])) {

                            echo $_POST['tipo_ajuste'];

                        } ?>'>
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
        <a href="<?php echo ruta_registrar_movimiento_stock ?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
    </div>
</body>

</html>