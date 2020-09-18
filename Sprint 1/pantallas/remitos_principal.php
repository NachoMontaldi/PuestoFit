<!DOCTYPE html>
<?php
//Otras clases y/o archivos a utilizar
    
    include_once '../conexion.class.php';
    include_once '../config.inc.php';
    include_once '../clases/escritor_remito.class.php';
    include_once '../pantallas/barra_nav.php';
    



    Conexion::abrirConexion();  
                        
?>

<html>
  <head>
    <title>Remitos</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/inventario_principal.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
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

    <!---BARRA DE BUSQUEDA-->
        <!--Se mete dentro de un form para poder usar el metodo post-->
    <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
      <div class="form-group"> 
        <p id="busqueda">
          <input type="text" class="form-control" id="searchBox" name="criterio" placeholder="BUSCAR">
          <!--El button se hace de type = "submit" para que pueda trasladar datos-->
          <button type="submit" class="form-control" name="busqueda" id="searchBotton"><i class="fa fa-search"></i></button>
        </p>
      </div>
    </form>
    
    <!--TABLA NACHO-->
    <div class="table-responsive-lg">
      <table id="grilla" class="table-hover table table-bordered">
        <thead class="thead-dark">
          <tr></tr>

            <th>Cod. Remito</th>
            <th>Cod. Factura</th>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th>Total</th>
            <th>DETALLE</th>
          </tr>
        </thead>
        <tbody>
            <?php

                escritor_remito :: escribir_remitos_principal(Conexion::obtenerConexion());

            ?>
        </tbody>
      </table>
    </div>
    <!--</form>-->
    <!-- BOTONES AÑADIR/REGISTRAR -->

    <div class="contenedor3">
    <a href="<?php echo ruta_remito_registrar?>"><button type="submit" name="reg_remito" id="rr" class="boton"><i class="fa fa-plus" aria-hidden="true"></i>   REGISTRAR REMITO</button></a>
    </div>
  </body>

</html>