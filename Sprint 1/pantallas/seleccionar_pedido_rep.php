<!DOCTYPE html>
<?php 
    include_once '../config.inc.php'; 
    include_once '../clases/escritor_filas.class.php';
    include_once '../conexion.class.php';
    include_once '../clases/repositorio_pedido_reposicion.class.php';

    Conexion::abrirConexion();

    
    
?>
<html>

    <head></head>
    <title>Seleccionar pedido de reposicion</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css"
        href="/puestofit/css/seleccionar_pedido_rep.css">
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
            <li><a href="<?php echo ruta_inventario_principal?>" >Stock</a></li>
            </ul>
        </div>

        <!---------------------------------------------------------------------------------------------------->
        <div id="formulario" class="form">
                <table class="tabla" border="1px"  style="height: 400px"> 
                    <tr>
                        <td colspan="4" class="titulo" >
                            SELECCIONAR PEDIDO DE REPOSICION

                    <tr>
                    <td colspan="4">
                        <!--Grilla de productos-->
                        <div class="table-responsive-lg">
                            <table id="grilla" class="table-hover table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Cod Pedido</th>
                                    <th>Fecha</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php
                                
                                    escritor_filas :: escribir_pedidos();

                                
                                ?>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        </td>
                </table>
        </div>
        
        
                            
        
        <div class="contenedor4">
        <a href="<?php echo ruta_cotizaciones_cargar?>"><button name="volver" id="volver">VOLVER</button></a> 
        </div>  
    </body>
</html>