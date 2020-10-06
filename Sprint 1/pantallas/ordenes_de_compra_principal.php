<!DOCTYPE html>
<?php 
  include_once '../config.inc.php';
  include_once '../conexion.class.php'; 
  include_once '../clases/escritor_filas_ordenes_de_compra.class.php';
  include_once '../clases/repositorio_ordenes_de_compra.class.php';
  include_once '../pantallas/barra_nav.php';

  Conexion::abrirConexion();
?>

<html>

    <head>
    <title>Ordenes de Compras</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css"
        href="/puestofit/css/compras_principal.css">
    <link href='https://fonts.googleapis.com/css?family='Actor''
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



    <!---BARRA DE BUSQUEDA-->
    <!--Se mete dentro de un form para poder usar el metodo post-->
    <div>
    <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
      <div class="form-group"> 
        <p id="busqueda">
          <input type="text" class="form-control" id="searchBox" name="criterio" placeholder="BUSCAR">
          <!--El button se hace de type = "submit" para que pueda trasladar datos-->
          <button type="submit" name="busqueda" id="buscar" class="boton_buscar"><i class="fa fa-search"></i></button>
        </p>
      </div>
    </form>
    </div>


    <!--TABLA NACHO-->
    <div class="table-responsive-lg"  style="padding-top: 15px;">
        <table id="grilla" class="table-hover table table-bordered">
            <thead class="thead-dark">
                <tr colspan="6">
                    <div class="titulo_grilla"><h4>ORDENES DE COMPRA</h4></div>
                </tr>
                <tr>
                    <th>Cod. OC</th>
                    <th>Fecha Emisión</th>
                    <th>Proveedor</th>
                    <th>Estado</th>
                    <th>Sucursal</th>
                    <th>VER DETALLE</th>
                </tr>
            </thead>
            <tbody>

              <?php
                 if(isset($_POST['busqueda'])){//si entra en el if quiere decir que la pagina se cargo por la busqueda
                                  
 
                    $criterio= $_POST['criterio'];
                    
                    escritor_filas_ordenes_de_compra::escribir_filas_filtradas_oc($criterio);
                    
                  }else{//si entra por else quiere decir que la pagina cargo desde la barra de navegacion

                    escritor_filas_ordenes_de_compra::escribir_ordenes_de_compra(Conexion::obtenerConexion());

                  }
                
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
    


</html>