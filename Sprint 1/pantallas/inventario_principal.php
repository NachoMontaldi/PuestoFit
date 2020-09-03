<?php
//Otras clases y/o archivos a utilizar
    include_once '../conexion.class.php';
    include_once '../config.inc.php';
    include_once '../clases/escritor_filas.class.php';
    Conexion::abrirConexion(); //cuando este el index pasar esta linea ahi!!! 
?>
<html>
  <head>
    <title>Inventario Principal</title>
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
        <li><a href="#">Proveedores</a></li>
        <li><a href="/puestofit/pantallas/inventario_principal.php" class="current">Inventario</a></li> <!--Ver css para ver que hace class current-->
        <li><a href="#">Facturas</a></li>
      </ul>
    </div>
    <!---BARRA DE BUSQUEDA-->
    <div method="post" action="<?php echo $_SERVER['PHP_SELF'] ?> class="contenedor1">
      <p method="post" id="busqueda">
        <input type="text" id="searchBox" name="criterio" placeholder="BUSCAR" />
        <button type="button" name="busqueda" id="searchBotton"><i class="fa fa-search" action= "<?php echo $_SERVER['PHP_SELF'] ?>"></i></button>
      </p>
    </div>
    <!---BOTONES-->
    <div class="contenedor2">
      <p id="botones">
        <button type="button" id="aceptar"><i class="fa fa-book"></i> VER DETALLE </i></button>
        <button type="button" id="modificar"><i class="fa fa-edit"></i> MODIFICAR</i></button>
        <button type="button" id="borrar"><i class="fa fa-trash"></i> BORRAR </i></button>
      </p>
    </div>


    <!--TABLA NACHO-->
    <div class="table-responsive-lg">
      <table id="grilla" class="table-hover table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th>Cod. Prod</th>
            <th>Nombre</th>
            <th>Existencia(unidades/kilos)</th>
            <th>Categoría</th>
            <th>Precio compra(unitario/100grs.)</th>
            <th>Precio venta(unitario/100grs.) </th> 
          </tr>
          <?php
            //Metodo para cargar la tabla desde la base
            if(isset($_POST['busqueda'])){
              print "entro por la busqueda";
              $criterio= $_POST['criterio'];
              escritor_filas::escribir_filas_filtradas($criterio);
              
          }else{
            print "entro por defecto";
            escritor_filas::escribir_filas();
          
          }
          ?>
        </tbody>
      </table>
    </div>

    <div class="contenedor3">
        <button type="button" id="detalle"> AÑADIR PRODUCTO </i></button>
        <button type="button" id="pedido"> REGISTRAR UN PEDIDO </i></button>
    </div>
    <div class="contenedor4">
      <button type="button" id="volver"> VOLVER </i></button>
    </div>
    
  </body>

</html>