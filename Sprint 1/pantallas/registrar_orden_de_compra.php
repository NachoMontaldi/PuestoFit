<!DOCTYPE html>
<?php include_once '../config.inc.php'; ?>
<html>

    <head></head>
    <title>Registrar Orden de Compra</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css"
        href="/puestofit/css/registrar_orden_de_compra.css">
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


    <!---------------------------------------------------------------------------------------------------->
    <div id="formulario" class="form">
        <form name="formP1" action="" method="post" >
            <table class="tabla" border="1px"> 
                <tr>
                    <td colspan="4" class="titulo">
                        REGISTRAR ORDEN DE COMPRA
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Pedido Reposición:</td>
                    <td class="valor seg_col">
                        <input type="text" style="width:85%;" readonly name="cod_cotizacion" id="cod_cotizacion">
                        <a href="<?php echo ruta_seleccionar_cotizacion?>">
                            <button type="button" name="buscar" id="buscar" class="boton">
                            <i class="fa fa-search"></i></button>
                        </a>
                    </td>
                    <td class="titulos">Proveedor:</td>
                    <td class="valor">
                        <input type="text" readonly name="proveedor" id="proveedor">
                    </td>
                </tr>
                <tr></tr>
                <td colspan="4">
                      <!--Grilla de productos-->
                      <div class="table-responsive-lg">
                        <table id="grilla" class="table-hover table table-bordered">
                          <thead class="thead-dark">
                            <tr>
                              <th id="vp" colspan="9">Vista Previa</th>
                            </tr>
                            <tr>
                              <th>Cod Producto</th>
                              <th>Nombre</th>
                              <th>Marca</th>
                              <th>Existencia</th>
                              <th>Categoría</th>
                              <th>Precio Compra</th>
                              <th>Cantidad Pedido</th>
                              <th>Subtotal</th>
                              <th><!--Aqui agregan los botones de borrar--></th>
                            </tr>
                            <?php
                            /*
                            
                              escritor_detalle::escribir_detalles();

                            */
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </td>
                </tr>
                <tr>
                    <td class="titulos" >Total:</td>
                    <td class="valor seg_col">
                        <input type="number" readonly name="precioTotal" id="precioTotal">
                    </td>
                    <td style="text-align:right" class="valor" colspan="2">
                        <button type="submit" name="enviar" id="gd" class="boton">REGISTRAR</button>
                        <button type="refresh" name="limpiar" id="ld" class="boton">LIMPIAR DATOS</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    
    <div class="contenedor4">
    <a href="<?php echo ruta_ordenes_de_compra_principal?>"><button type="submit" name="volver" id="volver">VOLVER</button></a> 
    </div>  

</body>