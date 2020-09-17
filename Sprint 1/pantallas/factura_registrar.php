<!-- Al registrar una factura, se ingresa el ID de OC. Los productos y sus datos, que se registran como detalle
de la factura, se cargan automaticamente de acuerdo a al ID de OC ingresado, permitiendose la opcion de 
eliminar alguno de los productos (porque puede darse el caso de que el proveedor no tenia cierto producto para 
vendernos). -->
<!DOCTYPE html>
<?php
    include_once '../config.inc.php';
    include_once '../clases/escritor_factura.class.php';
    include_once '../conexion.class.php';
    include_once '../clases/repositorio_factura.class.php';
    include_once '../clases/repositorio_ordenes_de_compra.class.php';

    Conexion::abrirConexion();
  if(isset($_POST['seleccionar'])){
    
      $total = repositorio_ordenes_de_compra:: calcular_precios($_POST['seleccionar']);
  
  }
?>
<html>

  <head>
    <title>Registrar una factura</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/factura_registrar.css">
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
        <img src="/puestofit/images/puestoFit.png" alt="Puesto Fit" > 
      </div>
    </header>
    <!--BARRA DE NAVEGACION-->
    <div id="nav"></div>
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
        <form name="formP1" action="" >
            <table class="tabla" border="1px"> 
                <tr>
                  <td colspan="3" class="titulo">
                        REGISTRAR FACTURA
                    </td>
                </tr>
                <tr>
                  <td class="titulos">ID Orden de compra:</td>
                  <td class="valor">
                  <form method="post">
                    <input type="text" style="width: 85%; margin-right: 1,5%" readonly name="cod_oc" id="codigo_oc" value="<?php
                    
                    if(isset($_POST['seleccionar'])){
  
                          echo $_POST['seleccionar'];

                    }?>">
                    <a href="<?php echo ruta_seleccionar_oc ?>">
                      <button type="button" name="buscar" id="gd" class="boton" >
                      <i class="fa fa-search"></i></button>
                    </a>
                    </form>
                  </td>
                  <td colspan="2" rowspan="5">
                      <!--Grilla de productos-->
                      <div class="table-responsive-lg">
                        <table id="grilla" class="table-hover table table-bordered">
                          <thead class="thead-dark">
                            <tr>
                              <th id="vp" colspan="6">Vista Previa</th>
                            </tr>
                            <tr>
                              <th>Nombre</th>
                              <th>Marca</th>
                              <th>Precio U.</th>
                              <th>Cant.</th>
                              <th>Subtotal</th>
                          
                            </tr>
                          <tbody>
                            <?php
                            /*
                            LA GRILLA SE CARGA CON LOS DATOS DE LA ORDEN DE COMPRA
                            DE ACUERDO AL ID INGRESADO. */

                            //if(isset($_POST['eliminar'])){
                   
                             // repositorio_factura::eliminar_detalle_factura_compra(Conexion::obtenerConexion(),$_POST['eliminar']);
                             
                             //}  

                            if(isset($_POST['seleccionar'])){

                              escritor_factura :: escribir_detalles_oc($_POST['seleccionar']);

                            }
                            
                            if(isset($_POST['seleccionar'])){?>
                            <tr>

                              <td colspan="4" align="right">
                                <h3>Total</h3>
                              </td>
                              <td align="center">
                                <h3> <?php  if (isset($_POST['seleccionar'])){ echo $total . " $"; }//echo number_format($precio,2) ?> </h3>
                              </td>

                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Proveedor:</td>
                    <td class="valor">
                        <input type="text" name="proveedor" id="prov" readonly value="<?php 
                        
                        if(isset($_POST['seleccionar'])){
  
                            echo $_POST['proveedor'];

                        }
                        
                        ?>">
                    </td>   
                </tr>
                <tr>    
                </tr>
                </tr>
                <tr>

                </tr>
                <tr>
                  <td class="valor" colspan="2">
                    <!--  <div class="botones">
                      <input type="button" value="Agregar a Vista Previa" id="avp">
                    </div>  -->
                  </td>
                </tr> 
                <tr>
                    <td colspan="4" style="text-align:right" class="valor">
                        <button type="submit" name="enviar" id="gd" class="boton">REGISTRAR</button>
                    </td>
                </tr>
 
            </table>
        </form>
    </div>

    <div class="contenedor4">
        <a href="<?php echo ruta_compras_principal?>"><button type="submit" name="volver" id="volver">VOLVER</button></a> 
    </div> 