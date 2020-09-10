<!DOCTYPE html>
<?php include_once '../config.inc.php'; ?>
<html>

    <head>
    <title>Detalle Orden de Compra</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css"
        href="/puestofit/css/det_orden_de_compra.css">
    <link href='https://fonts.googleapis.com/css?family=Actor'
        rel='stylesheet'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Tabla con bootstrap-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script
        src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
            <li><a href="<?php echo ruta_compras_principal?>" class="current">Compras</a></li>
            <li><a href="<?php echo ruta_inventario_principal?>">Stock</a></li>
            </ul>
        </div>

        <!--ID y Proveedor-->
        <div class="inputs" style="margin-top: 2%;">
            <form name="formP1" action="" method="post" >
                <table id="tabla"> 
                    <tr>
                        <td class="titulos">ID Orden de Compra:</td>
                        <td class="valor">
                            <input type="text" readonly name="nombre" id="nombre" value="">
                        </td>
                        <td class="titulos">Proveedor:</td>
                        <td class="valor">
                        <input type="text" readonly name="proveedor" id="proveedor" value="">
                        </td>   
                    </tr>
                </table>
            </form>
        </div>
        <!--TABLA NACHO-->
        <div class="table-responsive-lg">
            <table class="table-hover table table-bordered grilla">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Fecha Emisión</th>
                        <th>Fecha Entrega (Estimada)</th>
                        <th>Proveedor</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <!--Lógica de la tabla -->
                    <td>ID</td>
                    <td>Fecha Emisión</td>
                    <td>Fecha Entrega (Estimada)</td>
                    <td>Proveedor</td>
                    <td>Total</td>
                    <td>Estado</td>
                    <td><!--Cambienlo por los botones azules que hicieron en inventario principal-->
                    <a href="<?php echo ruta_detalle_orden_de_compra?>">
                        <button type="submit" name="registrar_pedido" id="rped" class="boton">ver detalle</button>
                        </a>
                    </td>
                </tr>
                <tr>    
                    <td>ID</td>            
                    <td>Fecha Emisión</td>
                    <td>Fecha Entrega (Estimada)</td>
                    <td>Proveedor</td>
                    <td>Total</td>
                    <td>Estado</td>
                    <td><!--aqui hay que meter los botoncitos de ver detalle yo pongo uno para probar no mas--></td>
                </tr>
                <tr>
                    <td>ID</td>
                    <td>Fecha Emisión</td>
                    <td>Fecha Entrega (Estimada)</td>
                    <td>Proveedor</td>
                    <td>Total</td>
                    <td>Estado</td>
                    <td><!--aqui hay que meter los botoncitos de ver detalle yo pongo uno para probar no mas--></td>
                </tr>
                <tr>
                    <td>ID</td>
                    <td>Fecha Emisión</td>
                    <td>Fecha Entrega (Estimada)</td>
                    <td>Proveedor</td>
                    <td>Total</td>
                    <td>Estado</td>
                    <td><!--aqui hay que meter los botoncitos de ver detalle yo pongo uno para probar no mas--></td>
                </tr>
                <tr>
                    <td>ID</td>
                    <td>Fecha Emisión</td>
                    <td>Fecha Entrega (Estimada)</td>
                    <td>Proveedor</td>
                    <td>Total</td>
                    <td>Estado</td>
                    <td><!--aqui hay que meter los botoncitos de ver detalle yo pongo uno para probar no mas--></td>
                </tr>
                <tr>
                    <td>ID</td>
                    <td>Fecha Emisión</td>
                    <td>Fecha Entrega (Estimada)</td>
                    <td>Proveedor</td>
                    <td>Total</td>
                    <td>Estado</td>
                    <td><!--aqui hay que meter los botoncitos de ver detalle yo pongo uno para probar no mas--></td>
                </tr>
                <tr>
                    <td>ID</td>
                    <td>Fecha Emisión</td>
                    <td>Fecha Entrega (Estimada)</td>
                    <td>Proveedor</td>
                    <td>Total</td>
                    <td>Estado</td>
                    <td><!--aqui hay que meter los botoncitos de ver detalle yo pongo uno para probar no mas--></td>
                </tr>
                <tr>
                    <td>ID</td>
                    <td>Fecha Emisión</td>
                    <td>Fecha Entrega (Estimada)</td>
                    <td>Proveedor</td>
                    <td>Total</td>
                    <td>Estado</td>
                    <td><!--aqui hay que meter los botoncitos de ver detalle yo pongo uno para probar no mas--></td>
                </tr>
                <tr>
                    <td>ID</td>
                    <td>Fecha Emisión</td>
                    <td>Fecha Entrega (Estimada)</td>
                    <td>Proveedor</td>
                    <td>Total</td>
                    <td>Estado</td>
                    <td><!--aqui hay que meter los botoncitos de ver detalle yo pongo uno para probar no mas--></td>
                </tr>
                </tbody>
            </table>
        </div>

        <!--Botón Volver-->
        <div class="contenedor4">
            <a href="<?php echo ruta_ordenes_de_compra_principal?>"><button type="submit" name="volver" id="volver">VOLVER</button></a> 
        </div>

    </body>
</html>
