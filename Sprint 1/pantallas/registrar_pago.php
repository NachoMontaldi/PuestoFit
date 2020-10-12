
<!DOCTYPE html>
<?php
include_once '../config.inc.php';
include_once '../clases/escritor_pago.class.php';
include_once '../clases/escritor_factura.class.php';
include_once '../conexion.class.php';
include_once '../clases/repositorio_factura.class.php';
include_once '../clases/repositorio_pago.class.php';
include_once '../clases/repositorio_ordenes_de_compra.class.php';
include_once '../clases/facturas_compra.class.php';
include_once '../clases/redireccion.class.php'; 
include_once '../pantallas/barra_nav.php';
include_once '../Conexion.class.php';


 Conexion::abrirConexion();
 


if (isset($_POST['reg_pago'])) {

   repositorio_pago::insertar_pago(Conexion::obtenerConexion());

}


$id = repositorio_pago::obtener_ultimo_id(Conexion::obtenerConexion());


if (isset($_POST['enviar'])) {

   // insertar los detalles
   repositorio_pago::cargar_detalles($_POST['cod_factura_compra2'], $id);
    

  //actualizar num_factura, metodo de pago , proveedor, total , cod_factura
    repositorio_pago::pago_cargado(Conexion::obtenerConexion(), $id, $_POST['nro_factura'], $_POST['metodo_pago'],
                                  $_POST['observaciones'],$_POST['proveedor'], $_POST['total2'], $_POST['cod_factura_compra2']);  

   //actualiza el estado de pago a 1
   $pago_validado = repositorio_pago::estado_pago(Conexion::obtenerConexion(), $id);
   
   // borrar los estados igual a 0
   repositorio_pago::eliminar_falsos(Conexion::obtenerConexion());

   //Actualizar estado de factura a 2
    repositorio_factura::actualizar_estado_listo_factura(Conexion::obtenerConexion(),$_POST['cod_factura_compra2']) ;
    
    //Insertar egreso
    repositorio_pago::insertar_egreso_factura(Conexion::obtenerConexion(),$_POST['total2']);

    //redirige despues de insertar
    Redireccion::redirigir(ruta_pagos_principal);

  }

?>
<html>

<head>
  <title>Registrar un pago</title>
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
          REGISTRAR PAGO
        </td>
      </tr>
      <tr>
      <td class="titulos">Fecha</td>
      <td class="valor">
        <input type="date" readonly name="fecha" id="fecha" value="<?php  echo date("Y-m-d");?>">
      </td>
        <td rowspan="7">
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

                       escritor_pago::escribir_detalles_factura($_POST['seleccionar']);
                    }
                  ?>
                  <tr>
                    <td colspan="4" align="right">
                      <h4>Total</h4>
                      </td>
                        <td align="center">
                            <h4> <?php  if (isset($_POST['seleccionar'])){ echo $_POST['total'] ;} ?> </h4>
                            
                        </td>

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
            <input type="text" style="width: 84%; margin-right: 1,5%" readonly name="nro_factura" id="nro_factura" 
            value="<?php
                            if (isset($_POST['seleccionar'])) {

                                echo $_POST['num_factura'];
                            } ?>">

            <a href="<?php echo ruta_seleccionar_factura_pago?>">
              <button type="button" name="busqueda" id="buscar" class="boton_buscar">
                <i class="fa fa-search"></i></button>
            </a>
          
        </td>
        
      <tr>
        <td class="titulos">Proveedor:</td>
        <td class="valor">
          <input type="text" name="proveedor" id="prov" readonly value="<?php
                        if (isset($_POST['seleccionar'])) {

                            echo $_POST['proveedor'];
                        } 
                        ?>">
        </td>
      </tr>
      <tr>
        <td class="titulos">Tipo de Factura</td>
          <td class="valor">
              <input type="text" readonly name="tipo_factura" id="tipo_factura" value="<?php
                        if (isset($_POST['seleccionar'])) {

                            echo $_POST['tipo_factura'];
                        } 
                        ?>
              
              ">
          </td>
      </tr>
      <tr>
        <td class="titulos">Sucursal:</td>
        <td class="valor">
          <input type="text" name="sucursal" id="sucursal" readonly value="<?php
                        if (isset($_POST['seleccionar'])) {

                            echo $_POST['sucursal'];
                        } 
                        ?>
          ">
        </td>
      </tr>

      <td class="titulos">Metodo de pago:</td>
        <td class="valor">
            <!-- desplegable -->
            <select name="metodo_pago" id="metodo_pago">
              <option selected value=""> Elije un Metodo de pago</option>            
              <option value="Transferencia Bancaria">Transferencia Bancaria</option>  
              <option value="Pago con tarjeta">Pago con tarjeta</option>  
              <option value="Cheque">Cheque</option>  

            </select>
        </td>
        <tr>
          <td class="titulos" valign="top">Observaciones:</td>
          <td class="valor">
            <textarea name="observaciones" id="observaciones"></textarea>
          </td>
      </tr>
      <tr>
        <td colspan="3" style="text-align:right" class="valor">
          <button type="submit" name="enviar" id="gd" class="boton">REGISTRAR</button>
          <?php if(isset($_POST['seleccionar'])){ ?>

            <input  type="hidden" name="cod_factura_compra2"  id="cod_factura_compra2" value="<?php echo $_POST['seleccionar'] ;?>">
            <input  type="hidden" name="total2"  id="total2" value="<?php if (isset($_POST['seleccionar'])){ echo $_POST['total'] ;} ?>">

            <?php } ?>
        </td>
      </tr>

      </form>



    </table>

  </div>


  <div class="contenedor4">
    <a href="<?php echo ruta_pagos_principal ?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
  </div>