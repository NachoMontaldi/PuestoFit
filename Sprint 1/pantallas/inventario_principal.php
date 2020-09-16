<!DOCTYPE html>
<?php
//Otras clases y/o archivos a utilizar
    
    include_once '../conexion.class.php';
    include_once '../config.inc.php';
    include_once '../clases/escritor_filas.class.php';
    include_once '../clases/repositorio_inventario.class.php';
    include_once '../clases/repositorio_pedido_reposicion.class.php';


    Conexion::abrirConexion(); //cuando este el index pasar esta linea ahi!!!
  

    if(isset($_POST['guardar_cambios'])){
        
      
      
      $cambio = repositorio_inventario :: actualizar_inventario(Conexion :: obtenerConexion(),$_POST['id'],$_POST['nombre'],$_POST['cantidad'],$_POST['cantidadMin'],$_POST['marca'],$_POST['categoria'],$_POST['precioC'],$_POST['precioV'],$_POST['contieneT'],$_POST['contieneA'],$_POST['contieneL'],$_POST['descripcion']);
      print 'se guardo el cambio realizado con exito!';
     
      
      //Conexion :: cerrarConexion();
    }
                        
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
        <li><a href="#">Ventas</a></li>
        <li><a href="<?php echo ruta_proveedor_principal?>">Proveedores</a></li>
        <li><a href="<?php echo ruta_compras_principal?>">Compras</a></li>
        <li><a href="<?php echo ruta_inventario_principal?>" class="current">Stock</a></li>
      </ul>
    </div>
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
            <th>Cod. Prod</th>
            <th>Nombre</th>
            <th>Existencia(unidades/kilos)</th>
            <th>Categoría</th>
            <th>Precio compra(unitario/100grs.)</th>
            <th>Precio venta(unitario/100grs.) </th> 
            <th>VER DETALLE</th>
            <th>EDITAR</th>
            <th>ELIMINAR</th>
          </tr>
        </thead>
        <tbody>
            <?php

            //Metodo para borrar un elemento de la tabla

            if(isset($_POST['eliminar'])){
                   
             repositorio_inventario::eliminar_inventario(Conexion::obtenerConexion(),$_POST['eliminar']);
            
            }   
            
            //Metodo para ver el detalle de un elemento de la tabla
            
            if(isset($_POST['ver_detalle'])){

                $_SESSION['id_fila']=$_POST['ver_detalle'];

            } 
              //Metodo para cargar la tabla desde la base
              if(isset($_POST['busqueda'])){//si entra en el if quiere decir que la pagina se cargo por la busqueda
                
                $criterio= $_POST['criterio'];
                escritor_filas::escribir_filas_filtradas($criterio);
                
            }else{//si entra por else quiere decir que la pagina cargo desde la barra de navegacion
              
              escritor_filas::escribir_filas();
            
            }

            ?>
        </tbody>
      </table>
    </div>
    <!--</form>-->
    <!-- BOTONES AÑADIR/REGISTRAR -->

    <div class="contenedor3">
      
    <a href="<?php echo ruta_alta_producto?>"><button type="submit" name="alta_producto" id="ap" class="boton"><i class="fa fa-plus" aria-hidden="true"></i>  AÑADIR PRODUCTO</button></a>
    <form method="post" action="<?php echo ruta_registrar_pedido_reposicion ?>">
      <a href="<?php echo ruta_registrar_pedido_reposicion?>"><button type="submit" name="registrar_pedido" id="rped" class="boton"><i class="fa fa-plus" aria-hidden="true"></i>  REGISTRAR UN PEDIDO</button></a>                      
    </form>
    </div>

    
  </body>

</html>