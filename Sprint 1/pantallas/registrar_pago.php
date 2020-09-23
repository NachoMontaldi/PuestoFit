<!-- Al registrar una factura, se ingresa el ID de OC. Los productos y sus datos, que se registran como detalle
de la factura, se cargan automaticamente de acuerdo a al ID de OC ingresado, permitiendose la opcion de 
eliminar alguno de los productos (porque puede darse el caso de que el proveedor no tenia cierto producto para 
vendernos). -->
<!DOCTYPE html>
<?php
include_once '../config.inc.php';
include_once '../clases/escritor_pago.class.php';
/* include_once '../clases/escritor_factura.class.php';
include_once '../conexion.class.php';
include_once '../clases/repositorio_factura.class.php';
include_once '../clases/repositorio_ordenes_de_compra.class.php';
include_once '../clases/facturas_compra.class.php';
include_once '../clases/redireccion.class.php'; */
include_once '../pantallas/barra_nav.php';
include_once '../Conexion.class.php';

 Conexion::abrirConexion();

?>
<html>

<head>
  <title>Registrar un pago</title>
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

  <!---------------------------------------------------------------------------------------------------->
  <div id="formulario" class="form">
    <table class="tabla" border="1px">
      <tr>
        <td colspan="3" class="titulo">
          REGISTRAR PAGO
        </td>
      </tr>
      <tr>
      <td class="titulos">Fecha</td>
      <td class="valor">
        <input type="date" readonly name="fecha" id="fecha" value="">
      </td>
        <td rowspan="6">
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
                    if (isset($_POST['seleccionar'])) {

                        escritor_remito::escribir_detalles_factura($_POST['seleccionar']);
                    }
                  ?>
                  <tr>
                    <td colspan="4" align="right">
                      <h3>Total</h3>
                    </td>
                    <td align="center">
                      <h3></h3>
                    </td>
                  </tr>
              </tbody>
            </table>
          </div>
        </td>
      </tr>
      <td class="titulos">Nro. Factura:</td>
        <td class="valor">
          <form method="post">
            <input type="text" style="width: 85%; margin-right: 1,5%" readonly name="nro_factura" id="nro_factura" 
            value="">

            <a href="<?php echo ruta_seleccionar_factura_pago?>">
              <button type="button" name="buscar" id="buscar" class="boton_buscar">
                <i class="fa fa-search"></i></button>
            </a>
          </form>
        </td>
        
      <tr>
        <td class="titulos">Proveedor:</td>
        <td class="valor">
          <input type="text" name="proveedor" id="prov" readonly value="">
        </td>
      </tr>
      <tr>
        <td class="titulos">Tipo de Factura</td>
          <td class="valor">
              <input type="text" readonly name="tipo_factura" id="tipo_factura" value="">
          </td>
      </tr>
      <tr>
        <td class="titulos">Sucursal:</td>
        <td class="valor">
          <input type="text" name="sucursal" id="sucursal" readonly value="">
        </td>
      </tr>

      <td class="titulos">Metodo de pago:</td>
        <td class="valor">
            <!-- desplegable -->
            <select name="metodo_pago" id="metodo_pago">
                <option selected value=""> Elije un Metodo de pago</option>
                <?php

                  //escritor_metodo_pago::escribir_metodo_pago();
                
                ?>

            </select>
        </td>
      <tr>
        <td colspan="3" style="text-align:right" class="valor">
          <button type="submit" name="enviar" id="gd" class="boton">REGISTRAR</button>
        </td>
      </tr>



    </table>

  </div>


  <div class="contenedor4">
    <a href="<?php echo ruta_compras_principal ?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
  </div>