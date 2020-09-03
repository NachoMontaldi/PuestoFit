<!DOCTYPE html>
<?php
    include_once '../config.inc.php';
?>
<html>

  <head>
    <title>Registrar Pedido de Reposición</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/registrar_pedido_reposicion.css">
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
    <div id="nav">
      <ul>
        <li><a href="#">Inicio</a></li>
        <li><a href="#">Clientes</a></li>
        <li><a href="<?php echo ruta_proveedor_principal?>">Proveedores</a></li>
        <li><a href="<?php echo ruta_compras_principal?>">Compras</a></li>
        <li><a href="<?php echo ruta_inventario_principal?>"" class="current">Inventario</a></li>
        <li><a href="#">Facturas</a></li>
      </ul>
    </div>

      <!---------------------------------------------------------------------------------------------------->
      <div id="formulario" class="form">
        <form name="formP1" action="" >
            <table class="tabla" border="1px"> 
                <tr>
                  <td colspan="3" class="titulo">
                        REGISTRAR PEDIDO DE REPOSICION
                    </td>
                </tr>
                <tr>
                  <td class="titulos">Fecha:</td>
                  <td class="valor">
                        <input type="date" name="Fecha" id="Fecha" readonly>
                  </td>
                  <td colspan="2" rowspan="5">
                      <!--Grilla de productos-->
                      <div class="table-responsive-lg">
                        <table id="grilla" class="table-hover table table-bordered">
                          <thead class="thead-dark">
                            <tr>
                              <th id="vp" colspan="3">Vista Previa</th>
                            </tr>
                            <tr>
                              <th>Nombre</th>
                              <th>Cantidad</th>
                              <th>Observaciones</th>
                            </tr>
                            <?php
                            /*
                            
                              escritor_detalle::escribir_detalles();

                            */
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Nombre producto:</td>
                    <td class="valor">
                        <input type="text" name="Nombre" id="Nombre">
                    </td>   
                </tr>
                <tr>
                <td class="titulos">Cantidad:</td>
                  <td class="valor">
                      <input type="number" name="cantidad" id="cantidad" min="1">
                  </td>      
                </tr>
                </tr>
                <tr>
                  <td class="titulos" valign="top">Observaciones:</td>
                  <td class="valor">
                      <textarea name="Descripcion" id="Descripcion"></textarea>
                  </td>
                </tr>
                <tr>
                  <td class="valor" colspan="2">
                    <div class="botones">
                      <input type="button" value="Agregar a Vista Previa" id="avp">
                    </div>
                  </td>
                </tr>
 
            </table>
        </form>
    </div>

    <div class="contenedor4">
        <button type="button" id="volver"> VOLVER </i></button>
        <input type="button" value="REGISTRAR" id="gd"  class="boton">
        <input type="button" value="LIMPIAR DATOS" id="ld" class="boton">
    </div> 