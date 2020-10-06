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

    if (isset($_POST['registrar_mov_stock'])) {
        
        repositorio_movimientos_stock::insertar_movimiento_stock(Conexion::obtenerConexion());
    }
    
    $id = repositorio_movimientos_stock::obtener_ultimo_id(Conexion::obtenerConexion());
    

    if (isset($_POST['enviar'])) {

        //Actualiza los campos tipo, motivo y observaciones
        repositorio_movimientos_stock::insertar_movimiento_stock_validado(Conexion::obtenerConexion(), $_POST['tipo_ajuste'], 
                                                                        $_POST['motivo_ajuste'],$_POST['observaciones'], $id);

        Redireccion::redirigir(ruta_registrar_detalle_movimiento);
    }

?>
<html>

<head>
    <title>Registrar Ajuste de Stock</title>
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
             <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                <tr>
                    <td colspan="4" class="titulo">
                        REGISTRAR AJUSTE DE STOCK
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Fecha:</td>
                    <td class="valor">
                        <input type="date" name="Fecha" id="Fecha" readonly value="<?php echo date("Y-m-d"); ?>">
                    </td>
                    <td class="titulos" valign="top" rowspan="4">Observaciones:</td>
                    <td class="valor" rowspan="4">
                        <textarea name="observaciones" id="observaciones"></textarea>
                    </td>
                </tr>
                <tr>

                    <td class="titulos">Sucursal:</td>
                    <td class="valor">
                        <input type="text" name="sucursal" id="sucursal" readonly value="Santa Ana">
                    </td>

                </tr>
                <tr>
                    <td class="titulos">Tipo de ajuste:</td>
                    <td class="valor">
                        <select name="tipo_ajuste" id="tipo_ajuste" >
                            <option selected value="0"> Elije una opción</option>
                            <option value="Entrada">Entrada</option>
                            <option value="Salida">Salida</option>
                        </select>
                    </td>
                </tr> 
                <tr>
                    <td class="titulos">Motivo de ajuste:</td>
                    <td class="valor">
                        <select name="motivo_ajuste" id="motivo_ajuste">
                            <option selected value="0"> Elije una opción</option>
                            <option value="Productos expirados">Productos expirados</option>
                            <option value="Faltantes en recuento inventario">Faltantes en recuento inventario</option>
                            <option value="Sobrantes en recuento inventario">Sobrantes en recuento inventario</option>
                            <option value="Productos descartados por fallas">Productos descartados por fallas</option>
                            <option value="Siniestro">Siniestro</option>
                            <option value="Otro motivo">Otro motivo (aclarar en observaciones)</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right" class="valor">
                        <button type="submit" name="enviar" id="gd" class="boton">CONTINUAR</button>
                    </td>
                </tr>
            </form>
        </table>
    </div>
    <div class="contenedor4">
        <a href="<?php echo ruta_movimientos_stock_principal ?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
    </div>
</body>

</html>