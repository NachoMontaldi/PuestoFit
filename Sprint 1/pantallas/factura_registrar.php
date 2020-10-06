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
include_once '../clases/facturas_compra.class.php';
include_once '../clases/redireccion.class.php';
include_once '../pantallas/barra_nav.php';

Conexion::abrirConexion();


if (isset($_POST['reg_factura'])) {

  repositorio_factura::insertar_factura(Conexion::obtenerConexion());
}
if (isset($_POST['seleccionar'])) {

  $total = repositorio_ordenes_de_compra::calcular_precios($_POST['seleccionar']);
}

$id = repositorio_factura::obtener_ultimo_id(Conexion::obtenerConexion());


if (isset($_POST['enviar'])) {

  // insertar los detalles
  repositorio_factura::cargar_detalles($_POST['cod_oc2'], $id);

  //actualiza el estado a 1
  $factura_validado = repositorio_factura::estado_factura(Conexion::obtenerConexion(), $id);

  // borrar los estados igual a 1
  repositorio_factura::eliminar_falsos(Conexion::obtenerConexion());

  // actualizar cod_oc, proveedor, numero de factura, tipo de factura, sucursal, fecha_estimada de entrega, total de factura
  repositorio_factura::factura_cargada(Conexion::obtenerConexion(), $id, $_POST['proveedor2'], $_POST['num_factura'], 
                                         $_POST['tipo_factura'], $_POST['datepicker'], $_POST['total2'], $_POST['cod_oc2']);

  //Actualizar estado de oc a 2
  repositorio_ordenes_de_compra::actualizar_estado_listo_oc(Conexion::obtenerConexion(),$_POST['cod_oc2']) ;

  //redirige despues de insertar
  Redireccion::redirigir(ruta_compras_principal);
}
?>
<html>

<head>
  <title>Registrar una factura</title>
  <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
  <link rel="stylesheet" type="text/css" href="/puestofit/css/factura_registrar.css">
  <link href='https://fonts.googleapis.com/css?family='Actor'' rel='stylesheet'>
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
          REGISTRAR FACTURA
        </td>
      </tr>
      <tr>
        <td class="titulos">ID Orden de compra:</td>
        <td class="valor">
          <form method="post">
            <input type="text" style="width: 84%; margin-right: 1,5%" readonly name="cod_oc" id="codigo_oc" value="<?php

              if (isset($_POST['seleccionar'])) {

                echo $_POST['seleccionar'];
              } ?>">
            <a href="<?php echo ruta_seleccionar_oc ?>">
              <button type="button" name="busqueda" id="buscar" class="boton_buscar">
                <i class="fa fa-search"></i></button>
            </a>
          </form>

        </td>
        <td rowspan="5">
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

                  escritor_factura::escribir_detalles_oc($_POST['seleccionar']);
                }

                if (isset($_POST['seleccionar'])) { ?>
                  <tr>

                    <td colspan="4" align="right">
                      <h4>Total</h4>
                    </td>
                    <td align="center">
                      <h4> <?php if (isset($_POST['seleccionar'])) {
                              echo $total . " $";
                            } ?> </h4>
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
          <td class="valor"  >
            <input readonly  type="text" name="proveedor" id="proveedor" value="<?php
              if (isset($_POST['seleccionar'])) {

                echo $_POST['proveedor'];

              } ?> ">
        </td>
      </tr>

      <tr>
      <form method="post" action="<?php //echo $_SERVER['PHP_SELF'] ?>">
        <td class="titulos">Número de factura:</td>
          <td class="valor">
            <input type="text" name="num_factura" id="num_factura">
        </td>
      </tr>

      <tr>  
        <td class="titulos">Tipo de factura:</td>
        <td class="valor">
          <!-- desplegable -->
          <select name="tipo_factura" id="tipo_factura">
              <option selected value="0"> Elije el tipo de factura</option>
              <option value="A">A</option>  
              <option value="B">B</option>  
              <option value="C">C</option>  
          </select>
        </td>  
      </tr>

     
      <td class="titulos">Fecha Estimada de Entrega:</td>
      <td class="valor">
          <input autocomplete="off" type="date" min="<?php echo date("Y-m-d"); ?>" id="datepicker" name="datepicker">

          <tr>

            <td colspan="4" style="text-align:right" class="valor">
              <?php
              if (isset($_POST['seleccionar'])) { ?>
                <input type="hidden" name="cod_oc2" id="-" value="<?php echo $_POST['seleccionar']; ?>">
                <input type="hidden" name="proveedor2" id="-" value="<?php echo $_POST['proveedor']; ?>">
                <input type="hidden" name="total2" id="-" value="<?php echo $_POST['total']; ?>">

              <?php } ?>
              <button type="submit" name="enviar" id="gd" class="boton">REGISTRAR</button>
            </td>
        </form>
        </tr>

    </table>

  </div>


  <div class="contenedor4">
    <a href="<?php echo ruta_compras_principal ?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
  </div>