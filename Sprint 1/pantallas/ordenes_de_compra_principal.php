<!DOCTYPE html>
<?php 
  include_once '../config.inc.php';
  include_once '../conexion.class.php'; 
  include_once '../clases/escritor_filas_ordenes_de_compra.class.php';
  include_once '../clases/repositorio_ordenes_de_compra.class.php';

  Conexion::abrirConexion();
?>

<html>

    <head>
    <title>Ordenes de Compras</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css"
        href="/puestofit/css/ordenes_de_compra_principal.css">
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
    <!---BARRA DE BUSQUEDA-->
    <!--Se mete dentro de un form para poder usar el metodo post-->
    <div>
      <form role="form" method="post" action="<?php echo
          $_SERVER['PHP_SELF']?>">
          <div class="form-group">
              <p id="busqueda">
                  <input type="text" class="form-control" id="searchBox"
                      name="criterio" placeholder="BUSCAR">
                  <!--El button se hace de type = "submit" para que pueda trasladar datos-->
                  <button type="submit" class="form-control" name="busqueda"
                      id="searchBotton"><i class="fa fa-search"></i></button>
              </p>
          </div>
      </form>
    </div>
    <!--TABLA NACHO-->
    <div class="table-responsive-lg"  style="padding-top: 15px;">
        <table id="grilla" class="table-hover table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Cod. OC</th>
                    <th>Fecha Emisión</th>
                    <th>Proveedor</th>
                    <th>Total</th>
                    <th>VER DETALLE</th>
                    
                </tr>
            </thead>
            <tbody>
              <!-- <tr>
                  <td>ID</td>
                  <td>Fecha Emisión</td>
                  <td>Fecha Entrega (Estimada)</td>
                  <td>Proveedor</td>
                  <td>Total</td>
                  <td>Estado</td>
                  <td>
                    <a href="<?php //echo ruta_detalle_orden_de_compra?>
              
                    <button type="submit" name="registrar_pedido" id="rped" class="boton">ver detalle</button>
                            </a>
                  </td>
              </tr> -->
              <?php
                escritor_filas_ordenes_de_compra::escribir_ordenes_de_compra(Conexion::obtenerConexion());
              ?>
            </tbody>
        </table>
    </div>

    <!-- BOTONES AÑADIR/REGISTRAR -->

    <div class="contenedor3">
        <form method="post" action="<?php echo ruta_registrar_orden_de_compra ?>">   
            <button type="submit" name="registrar_oc" id="ap" class="boton"><i class="fa fa-plus" aria-hidden="true"></i> REGISTRAR ORDEN COMPRA</button>
        </form>
    </div>
    <div class="contenedor4">
        <a href="<?php echo ruta_compras_principal?>"><button type="submit" name="volver" id="volver">VOLVER</button></a> 
    </div> 


</html>