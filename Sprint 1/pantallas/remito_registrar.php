<!-- Al registrar un remito, se debe ingresar el ID de la factura, los campos de ID ORDEN DE COMPRA
y PROVEEDOR son de salida y muestran los datos correspondientes al id de factura ingresado. La grilla 
se llena con los datos del DETALLE DE FACTURA, correspondiente al id de factura ingresado.

 -->
<!DOCTYPE html>
<?php
include_once '../config.inc.php';
include_once '../clases/escritor_remito.class.php';
include_once '../Conexion.class.php';
include_once '../clases/redireccion.class.php';
include_once '../pantallas/barra_nav.php';
include_once '../clases/repositorio_movimientos_stock.class.php';
include_once '../clases/repositorio_remito.class.php';
include_once '../clases/repositorio_pago.class.php';

Conexion::abrirConexion();


if (isset($_POST['registrar_remito'])) {

   repositorio_remito::insertar_remito(Conexion::obtenerConexion());

}
    
  
  $id = repositorio_remito::obtener_ultimo_id(Conexion::obtenerConexion());
  
  
   
    if (isset($_POST['enviar'])) {
    
    // insertar los detalles
    repositorio_remito::cargar_detalles($_POST['cod_factura_compra2'], $id);
    
    //actualiza el estado de remito a 1
    $remito_validado = repositorio_remito::estado_remito(Conexion::obtenerConexion(), $id);
    
    // borrar los estados igual a 0
    repositorio_remito::eliminar_falsos(Conexion::obtenerConexion());

    // actualizar numero remito,proveedor, total , cod_factura_compra de remitos
        repositorio_remito::remito_cargado(Conexion::obtenerConexion(), $id, $_POST['num_remito'], $_POST['proveedor'], $_POST['total2'], 
                                        $_POST['cod_factura_compra2']);  
    
    //Actualiza las tablas movimientos_stock, detalle_movimientos de stock y stock_deposito
    repositorio_movimientos_stock::cargar_mov_stock_compras($id);

    //Actualizar estado de factura a 4
    repositorio_factura::actualizar_estado_entregado_factura(Conexion::obtenerConexion(),$_POST['cod_factura_compra2']) ;

    //Elimina los movimientos_stock que tengan estado 0
    $borrar = repositorio_movimientos_stock::eliminar_falsos(Conexion::obtenerConexion());
    
    //redirige a remitos_principal despues de insertar
    Redireccion::redirigir(ruta_remitos_principal);
  }  
  ?>

<html>

<head>
    <title>Registrar Remito</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/remito_registrar.css">
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
        <form name="formP1" action="">
            <table class="tabla" border="1px">
                <tr>
                    <td colspan="4" class="titulo">
                        REGISTRAR REMITO
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Fecha:</td>
                    <td class="valor">
                        <input type="date" name="Fecha" id="Fecha" readonly value="<?php echo date("Y-m-d"); ?>">
                    </td>

                    <td rowspan="5">
                        <!--Grilla de productos-->
                        <div class="table-responsive-lg">
                            <table id="grilla" class="table-hover table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th id="vp" colspan="6">Vista Previa</th>
                                    </tr>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Marca</th>
                                        <th>Precio Unitario</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_POST['seleccionar'])) {

                                        escritor_remito::escribir_detalles_factura($_POST['seleccionar']);
                                    }
                                    ?>
                                    <tr>

                                        <td colspan="4" align="right">
                                            <h4>TOTAL:</h4>
                                        </td>
                                        <td align="center">
                                            <h4> <?php  if (isset($_POST['seleccionar'])){ echo $_POST['total'] ;}//echo number_format($precio,2) ?> </h4>

                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                <tr>

                    <td class="titulos">N° Factura:</td>
                    <td class="valor">
                        <form method="post">
                            <input type="text" style="width: 84%; margin-right: 1,5%" readonly name="codigo_factura" id="codigo_factura" 
                            value="<?php
                            if (isset($_POST['seleccionar'])) {

                                echo $_POST['num_factura'];
                            }  ?>">
                            <a href="<?php echo ruta_seleccionar_factura ?>">
                                <button type="button" name="busqueda" id="buscar" class="boton_buscar">
                                    <i class="fa fa-search"></i></button>
                            </a>
                        </form>
                    </td>
                </tr>
                <form method="post" >
                <tr>
                    <td class="titulos">N° Remito:</td>
                    <td class="valor">
                    <input type="text" name="num_remito" id="num_remito">
                    </td>
                </tr>
                <tr>
                    <td class="titulos" readonly>Sucursal:</td>
                    <td class="valor">
                    <input type="text" name="sucursal" id="sucursal" readonly value="<?php
                        if (isset($_POST['seleccionar'])) {

                            echo $_POST['sucursal'];
                        } 
                        ?>">
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Proveedor:</td>
                    <td class="valor">
                        <input type="text" name="proveedor" id="prov" readonly 
                        value="<?php
                        if (isset($_POST['seleccionar'])) {

                            echo $_POST['proveedor'];
                        } 
                        ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="3" style="text-align:right" class="valor">
                        <button type="submit" name="enviar" id="gd" class="boton">REGISTRAR</button>
                        <?php if(isset($_POST['seleccionar'])){ ?>

                            <input  type="hidden" name="cod_factura_compra2"  id="cod_factura_compra2" value="<?php echo $_POST['seleccionar'] ;?>">
                            <input  type="hidden" name="total2"  id="total2" value="<?php if (isset($_POST['seleccionar'])){ echo $_POST['total'] ;} ?>">
                        
                        <?php } ?>
                    </td>
                </tr>

            </table>
        </form>
    </div>

    <div class="contenedor4">
        <a href="<?php echo ruta_remitos_principal ?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
    </div>

</body>

</html>