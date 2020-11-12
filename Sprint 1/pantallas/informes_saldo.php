<!DOCTYPE html>
<?php
    include_once '../config.inc.php';
    include_once '../pantallas/barra_nav.php';
    include_once '../conexion.class.php';
    include_once '../clases/repositorio_ventas.class.php';
    include_once '../clases/repositorio_pago.class.php';
    include_once '../clases/repositorio_saldos.class.php';
    include_once '../clases/repositorio_excel.class.php';

    Conexion::abrirConexion();


?>
<html>

  <head>
    <title>Informe Saldo Ingresos-Egresos</title>

  <!--  CSS -->
    <link rel="stylesheet" type="text/css" href="/puestofit/css/compras_principal.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
  <!---->

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


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
    <!-- BODY -->
    <br>
    <br>
    <!-- GRILLA -->
    <div class="table-responsive-lg">
      <table id="grilla" class="table-hover table table-bordered">
        <thead class="thead-dark">
          <tr colspan="6">
            <div class="titulo_grilla"><h4>SALDO INGRESOS-EGRESOS</h4></div>
          </tr>
          <tr>
            <th>Mes</th>
            <th>Junio</th>
            <th>Julio</th>
            <th>Agosto</th>
            <th>Septiembre</th>
            <th>Octubre</th>
            <th>Noviembre</th> 
          </tr> 
          <tr>
            <th>Ingresos</th>
              <td><?php echo repositorio_ventas::obtener_ingresos(Conexion::obtenerConexion(),"-06-") ?> </td>
              <td><?php echo repositorio_ventas::obtener_ingresos(Conexion::obtenerConexion(),'-07-') ?> </td>
              <td><?php echo repositorio_ventas::obtener_ingresos(Conexion::obtenerConexion(),'-08-') ?> </td>
              <td><?php echo repositorio_ventas::obtener_ingresos(Conexion::obtenerConexion(),'-09-') ?> </td>
              <td><?php echo repositorio_ventas::obtener_ingresos(Conexion::obtenerConexion(),"-10-") ?> </td>
              <td><?php echo repositorio_ventas::obtener_ingresos(Conexion::obtenerConexion(),"-11-") ?> </td>
          </tr>
          <tr>
            <th>Egresos</th>
              <td><?php echo repositorio_pago::obtener_egresos(Conexion::obtenerConexion(),"-06-") ?> </td>
              <td><?php echo repositorio_pago::obtener_egresos(Conexion::obtenerConexion(),"-07-") ?> </td>
              <td><?php echo repositorio_pago::obtener_egresos(Conexion::obtenerConexion(),"-08-") ?> </td>
              <td><?php echo repositorio_pago::obtener_egresos(Conexion::obtenerConexion(),"-09-") ?> </td>
              <td><?php echo repositorio_pago::obtener_egresos(Conexion::obtenerConexion(),"-10-") ?> </td>
              <td><?php echo repositorio_pago::obtener_egresos(Conexion::obtenerConexion(),"-11-") ?> </td>
          </tr>
          <tr>
            <th>Saldo</th>
              <td><?php echo repositorio_saldos::obtener_saldo(Conexion::obtenerConexion(),"-06-") ?> </td>
              <td><?php echo repositorio_saldos::obtener_saldo(Conexion::obtenerConexion(),"-07-") ?> </td>
              <td><?php echo repositorio_saldos::obtener_saldo(Conexion::obtenerConexion(),"-08-") ?> </td>
              <td><?php echo repositorio_saldos::obtener_saldo(Conexion::obtenerConexion(),"-09-") ?> </td>
              <td><?php echo repositorio_saldos::obtener_saldo(Conexion::obtenerConexion(),"-10-") ?> </td>
              <td><?php echo repositorio_saldos::obtener_saldo(Conexion::obtenerConexion(),"-11-") ?> </td>
          </tr>
        </thead>
      </table>
    </div>
    <div class="contenedor3">
        <a href="<?php echo ruta_exportar_excel_saldo ?>"><button type="submit" name="reg_factura" id="rf" class="boton">
        <i class="fa fa-print" aria-hidden="true">
        </i> Exportar Excel</button></a>
    </div>
<br>
<br>
<br>
    <div align = "center">
        <h3 >Saldo Ingresos - Egresos</h3>
          <?php repositorio_saldos::obtener_grafica_saldos(Conexion::obtenerConexion()) ?>
    </div>
    <div class="row">
      <div class="col-md-6" align = "right">
        <h4> Ingresos </h4>
      </div>
            
      <div class="col-md-6">
      <input readonly type="text" style="background-color:orange ; width:3%; hight:2%;">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6" align = "right">
          <h4> Egresos </h4>
      </div>      
      <div class="col-md-6">
        <input readonly type="text" style="background-color:#38A6C1 ; width:3%; hight:2%;">
      </div>
    </div>
    <br>
    <br>
    <br>
  </body>
</html>