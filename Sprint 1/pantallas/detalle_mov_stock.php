<!DOCTYPE html>
  <?php include_once '../config.inc.php';
  include_once '../conexion.class.php'; 
  include_once '../clases/repositorio_movimientos_stock.class.php';
  include_once '../clases/escritor_movimientos_stock.class.php';
  include_once '../clases/redireccion.class.php';
  include_once '../pantallas/barra_nav.php';


  Conexion::abrirConexion();
  if (isset($_POST['ver_detalle'])) {

    $factura_id = $_POST['ver_detalle'];
  }

  ?>
  <html>

  <head>
    <title>Detalle Movimiento de Stock</title>
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
          <td colspan="4" class="titulo">DETALLE MOVIMIENTO DE STOCK</td>
        </tr>

        <tr>

          <td class="titulos">Cod. Movimiento:</td>
          <td class="valor">
            <input type="text" readonly name="cod_movimiento" id="cod_movimiento" value="<?php echo $_POST['ver_detalle']; ?>">
          </td>

          <td class="titulos">Tipo de movimiento:</td>
          <td class="valor">
            <input type="text" readonly name="tipo" id="tipo" value="<?php echo $_POST['tipo'];?>">
          </td>

        </tr> 
        <tr>

          <td class="titulos" >Motivo de movimiento:</td>
          <td class="valor" colspan="3" >
            <input type="text" readonly name="motivo" id="motivo" value="<?php echo $_POST['motivo'];?>">
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
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php 
                    if (isset($_POST['ver_detalle'])) {
                    escritor_movimientos_stock::escribir_detalles_movimiento($_POST['ver_detalle']);
                    } ?>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="1" class="titulos">Observaciones:</td>
          <td colspan="3" class="valor"> 
          <textarea name="observacion" readonly id="observacion" style="height: 100px; width: 100%;"> <?php echo $_POST['observacion']; ?> </textarea> 
          </td>
        </tr>
      </table>
    </div>

    <div class="contenedor4">
      <a href="<?php echo ruta_movimientos_stock_principal?>"><button type="submit" name="volver" id="volver">VOLVER</button></a>
    </div>
  </body>

  </html>