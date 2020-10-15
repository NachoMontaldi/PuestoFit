<!DOCTYPE html>
<?php
include_once '../config.inc.php';
include_once '../conexion.class.php';
include_once '../clases/redireccion.class.php';
include_once '../pantallas/barra_nav.php';
include_once '../clases/ventas.class.php';
include_once '../clases/repositorio_ventas.class.php';
include_once '../clases/escritor_ventas.class.php';

Conexion::abrirConexion();

if (isset($_POST['reg_venta'])) {

    $venta = new ventas('','','','','',1,'','','',0);

    repositorio_ventas::insertar_venta(Conexion::obtenerConexion(), $venta);
}

$id = repositorio_ventas::obtener_ultimo_id(Conexion::obtenerConexion());

if (isset($_POST['vista'])) {
    
    $detalle_venta = new detalle_venta('', $id, $_POST['nombre2'], $_POST['marca'], $_POST['cantidad'], $_POST['pu']);

    $detalle_insertado = repositorio_ventas::insertar_detalle_venta(Conexion::obtenerConexion(), $detalle_venta);

}

if (isset($_POST['eliminar']) or isset($_POST['seleccionar']) or isset($_POST['vista'])) {

    $total = repositorio_ventas::calcular_precios($id);

}

?>
<html>

<head>
    <title>Registrar Detalle Venta</title>
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
                    REGISTRAR VENTA
                </td>
            </tr>
            <tr>
                <td class="titulos">Fecha:</td>
                <td class="valor">
                    <input type="date" name="Fecha" id="Fecha" readonly value="<?php echo date("Y-m-d"); ?>">
                </td>
                <td colspan="2" rowspan="7">
                    <!--Grilla de productos-->
                    <div class="table-responsive-lg">
                        <table id="grilla" class="table-hover table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th id="vp"colspan="6">Vista Previa</th>
                                </tr>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Marca</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                    <th>EMILINAR</th>
                                </tr>
                            <tbody>

                                    <?php 

                                    //Metodo para borrar un elemento de la tabla

                                    if (isset($_POST['eliminar'])) {

                                        repositorio_ventas::eliminar_detalle(Conexion::obtenerConexion(), $_POST['eliminar']);
                                    }

                                    if (isset($_POST['eliminar']) or isset($_POST['seleccionar']) or isset($_POST['vista'])) {

                                        $total = repositorio_ventas::calcular_precios($id);
                                    
                                    }

                                    escritor_ventas::escribir_detalles_venta_reg($id);
                                    
                                    ?>
                                    
                                    <?php if((isset($_POST['vista']) or isset($_POST['eliminar']) 
                                             or isset($_POST['seleccionar'])) && ($total !== 0)){ 
                                    ?>
                                        <tr>
                                            <td colspan="5" align="right">
                                                <h4>TOTAL:</h4>
                                            </td>
                                            <td align="center">
                                                <h4>$ <?php echo $total; ?> </h4>
                                            </td>
                                        </tr>
                                    <?php } ?>     
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                    <td class="titulos">Sucursal:</td>
                    <td class="valor">
                        <input type="text" readonly name="sucursal" id="sucursal" value='Santa Ana'>
                    </td>
            </tr>
            <tr>
                <td class="titulos">Nombre producto:</td>
                <td class="valor">
                    <input type="text" style="width: 85%; margin-right: 1,5%" readonly name="nombre" id="nombre" value='<?php
                        
                         if (isset($_POST['seleccionar'])) {

                            echo $_POST['nombre'];
                        } 
                        
                        ?>'>
                    <a href="<?php echo ruta_agregar_producto_venta ?>"><button type="button" name="busqueda" id="buscar" class="boton_buscar">
                            <i class="fa fa-search"></i></button></a>
                </td>
               
            </tr>
            <form method="post" action=" <?php echo ruta_registrar_detalle_venta ?> ">
                <tr>
                    <td class="titulos">Marca:</td>
                    <td class="valor">
                        <input type="text" readonly name="marca" id="marca" value='<?php
                            if (isset($_POST['seleccionar'])) {

                                echo $_POST['marca'];
                            } 
                            
                            ?>'>
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Precio Unitario:</td>
                    <td class="valor">
                        <input readonly type="text" name="pu" id="cantidad" min="1" value='<?php
                            if (isset($_POST['seleccionar'])) {

                              echo $_POST['precio']. " $";
                                
                            }
                            
                            ?>'>
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Cantidad:</td>
                    <td class="valor">
                        <input type="number" name="cantidad" id="cantidad" min="1">
                    </td>
                </tr>
                <input type="hidden" name="nombre2" id="nombre2" value='<?php
                         if (isset($_POST['seleccionar'])) {

                            echo $_POST['nombre'];

                        }  ?>'>
                <tr>
                    <td class="valor" colspan="2">
                        <div class="botones">
                            <input type="submit" name="vista" value="Agregar a Vista Previa" id="avp">
                        </div>
                    </td>
                </tr>
            </form>
            <form method="post" action="<?php echo ruta_registrar_venta ?> ">
                <tr>
                    <td colspan="4" style="text-align:right" class="valor">
                        <button type="submit" name="continuar" id="gd" class="boton">CONTINUAR</button>
                    </td>
                </tr>
                <input type="hidden" name="total" id="total" value='<?php
                         if (isset($_POST['vista']) or isset($_POST['seleccionar']) or isset($_POST['eliminar'])) {

                            echo $total;

                        }  ?>'>
            </form>
        </table>
    </div>

    <div class="contenedor4">
        <a href="<?php echo ruta_ventas_principal ?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
    </div>
</body>

</html>