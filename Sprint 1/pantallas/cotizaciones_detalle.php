<!DOCTYPE html>
<?php
    include_once '../config.inc.php';
    include_once '../clases/escritor_filas.class.php';
    include_once '../conexion.class.php';
    include_once '../clases/repositorio_cotizacion.class.php';
    include_once '../clases/cotizaciones.class.php';
    include_once '../clases/detalle_cotizacion.class.php';
    include_once '../clases/redireccion.class.php';
    
    Conexion::abrirConexion();

    if(isset($_POST['ver_detalle'])){
        
        $id = $_POST['ver_detalle'];
        
       
    }

    $total = repositorio_cotizacion:: calcular_precios($id);

    

?>
<html>

<head>
    <title>Ver detalle de cotización</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/cotizaciones_cargar.css">
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
    <header>
        <div id="logo">
            <img src="/puestofit/images/puestoFit.png" alt="Puesto Fit">
        </div>
    </header>
    <!--BARRA DE NAVEGACION-->
    <div id="nav">
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Clientes</a></li>
            <li><a href="#">Ventas</a></li>
            <li><a href="<?php echo ruta_proveedor_principal?>">Proveedores</a></li>
            <li><a href="<?php echo ruta_compras_principal?>">Compras</a></li>
            <li><a href="<?php echo ruta_inventario_principal?>">Stock</a></li>
        </ul>
    </div>

    <!---------------------------------------------------------------------------------------------------->
    <div id="formulario" class="form">
       

            <table class="tabla" border="1px">
                <tr>
                    <td colspan="3" class="titulo">
                        DATOS DE COTIZACIÓN
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Cod. Cotizacion:</td>
                    <td class="valor">
                    <input type="text" readonly name="cotizacion" id="cotizacion" value=" <?php echo $_POST['ver_detalle']; ?> "></td> 
                    </td>
                </tr>  
                <tr>
                    <td class="titulos">Proveedor:</td>
                    <td class="valor">
                    <input type="text" readonly name="proveedor" id="proveedor" value=" <?php echo $_POST['proveedor']; ?> "></td> 
                    </td>  
                </tr>
                     
                <tr> 
                    <td colspan="2">
                        <!--Grilla de productos para cotizacion-->
                        <div class="table-responsive-lg">
                            <table id="grilla" class="table-hover table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Marca</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                               
                                     escritor_filas :: escribir_ver_detalles_cotizacion($id);
                           
                                    ?>
                            <tr>

                            <tr>

                                <td colspan="4" align="right">
                                    <h3>Total</h3>
                                </td>
                                <td align="center">
                                    <h3>$ <?php   echo $total; ?> </h3>
                                </td>

                                </tr>
                            </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
    </div>

    <div class="contenedor4">
        <a href="<?php echo ruta_cotizaciones_principal?>"><button type="submit" name="volver"
                id="volver">VOLVER</button></a>
    </div>