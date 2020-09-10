<!DOCTYPE html>
<?php
    include_once '../config.inc.php';
?>
<html>

  <head>
    <title>Compras</title>

  <!--  CSS -->
    <link rel="stylesheet" type="text/css" href="/puestofit/css/compras_principal.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
  <!---->

    <link href='https://fonts.googleapis.com/css?family=Actor' rel='stylesheet'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


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
  <body>
    <!-- BODY -->
    <!---BARRA DE BUSQUEDA-->
        <!--Se mete dentro de un form para poder usar el metodo post-->
    <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
      <div class="form-group"> 
        <p id="busqueda">
          <input type="text" class="form-control" id="searchBox" name="criterio" placeholder="BUSCAR"/>
          <!--El button se hace de type = "submit" para que pueda trasladar datos-->
          <button type="submit" class="form-control" name="busqueda" id="searchBotton"><i class="fa fa-search"></i></button>
        </p>
      </div>
    </form>
    <!---BOTONES VER DETALLE/MODIFICAR-->
    <div class="contenedor2"> 
      <a href="<?php echo ruta_ordenes_de_compra_principal?>"><button type="submit" name="ordenes_compra" id="oc" class="boton">ORDENES DE COMPRA</button></a>                
      <a href="<?php echo ruta_cotizaciones_principal?>"><button type="submit" name="cotizaciones" id="ct" class="boton">COTIZACIONES</button></a>           
    </div>  

    <!---->
    <!-- GRILLA -->
    <div class="table-responsive-lg">
      <table id="grilla" class="table-hover table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th>Nº Factura</th>
            <th>ID Orden de compra</th>
            <th>Proveedor</th>
            <th>Fecha de emisión</th>
            <th>Total</th> 
          </tr>
        </thead>
        <tbody>
      <!-- AGRRGAR ACA FUNCIONES PHP Xd -->
        </tbody>
      </table>
    </div>
    <!---->
    <div class="contenedor3">
      <a href="<?php echo ruta_factura_registrar?>"><button type="submit" name="reg_factura" id="rf" class="boton"><i class="fa fa-plus" aria-hidden="true"></i>   REGISTRAR FACTURA</button></a>           
      <a href="<?php echo ruta_remito_registrar?>"><button type="submit" name="reg_remito" id="rr" class="boton"><i class="fa fa-plus" aria-hidden="true"></i>   REGISTRAR REMITO</button></a>           
    </div>




   


   


    

  </body>

</html>