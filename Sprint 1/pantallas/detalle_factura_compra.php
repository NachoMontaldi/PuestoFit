<!DOCTYPE html>
  <?php include_once '../config.inc.php';
  include_once '../conexion.class.php';
  include_once '../clases/repositorio_factura.class.php';
  include_once '../clases/escritor_factura.class.php';
  include_once '../clases/redireccion.class.php';
  include_once '../pantallas/barra_nav.php';


  Conexion::abrirConexion();
  if (isset($_POST['ver_detalle'])) {

    $factura_id = $_POST['ver_detalle'];
  }


  ?>
  <html>

  <head>
    <title>Detalle factura Compras</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css" />
    <link rel="stylesheet" type="text/css" href="/puestofit/css/cotizaciones_cargar.css" />
    <link href="https://fonts.googleapis.com/css?family='Actor'" rel="stylesheet" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!--Tabla con bootstrap-->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!---->
  </head>

  <body>

    <div id="formulario" class="form">
      <table class="tabla" border="1px">
        <tr>
          <td colspan="4" class="titulo">DETALLE FACTURA COMPRAS</td>
        </tr>
        <tr>
          <td class="titulos">N° Factura:</td>
          <td class="valor">
            <input type="text" readonly name="nro_factura" id="nro_factura" value="<?php echo $_POST['num_factura']; ?>">
          </td>
          <td class="titulos">Tipo:</td>
          <td class="valor">
            <input type="text" readonly name="tipo" id="tipo" value="<?php echo $_POST['tipo']; ?>">
          </td>
        </tr>
        <tr>
          <td colspan="1" class="titulos">Proveedor:</td>
          <td colspan="3" class="valor">
            <input type="text" readonly name="proveedor" id="proveedor" value="<?php echo $_POST['proveedor']; ?>">
          </td>
        </tr>
        <tr>
          <td colspan="4">
            <!--Grilla de productos para cotizacion-->
            <div class="table-responsive-lg">
              <table class="table-hover table table-bordered grilla">
                <thead class="thead-dark">
                  <tr>
                    <th class="text-center">Cod.Det.</th>
                    <th class="text-center">Nombre producto</th>
                    <th class="text-center">Marca</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Precio unitario</th>
                    <th class="text-center">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                    if (isset($_POST['ver_detalle'])) {
                      escritor_factura::escribir_detalles_factura($_POST['ver_detalle']);
                    } ?>
                  </tr>
                  <tr>
                    <td colspan="5" align="right">
                      <h4>TOTAL:</h4>
                    </td>
                    <td align="center">
                      <h4>$ <?php echo $_POST['total']; ?> </h4>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      </table>
    </div>

    <div class="contenedor4">
      <a href="<?php echo ruta_compras_principal ?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
    </div>
  </body>

  </html>