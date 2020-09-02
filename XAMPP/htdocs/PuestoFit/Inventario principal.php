<!DOCTYPE html>
<html>

  <head>
    <title>Inventario Principal</title>
    <link rel="stylesheet" type="text/css" href="C:/GitHub/PuestoFit/Sprint 1/InventarioPrincipal.css">
    <link rel="stylesheet" type="text/css" href="C:/GitHub/PuestoFit/Sprint 1/header.css">
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
        <img src="puestoFit.png" alt="Puesto Fit">
      </div>
    </header>
    <!--BARRA DE NAVEGACION-->
    <div id="nav">
      <ul>
        <li><a href="#">Inicio</a></li>
        <li><a href="#">Clientes</a></li>
        <li><a href="#">Proveedores</a></li>
        <li><a href="#">Inventario</a></li>
        <li><a href="#">Facturas</a></li>
      </ul>
    </div>
    <!---BARRA DE BUSQUEDA-->
    <div class="contenedor1">
      <p id="busqueda">
        <input type="text" id="searchBox" placeholder="BUSCAR" />
        <button type="button" id="searchBotton"><i class="fa fa-search"></i></button>
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
            <th>#</th>
            <th>Cod. Prod</th>
            <th>Nombre</th>
            <th>Existencia(unidades/kilos)</th>
            <th>Categoria</th>
            <th>Precio compra(unitario/100grs.)</th>
            <th>Precio venta(unitario/100grs.)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>77940131</td>
            <td>Barra de Cereal Cerealmix</td>
            <td>50</td>
            <td>Barras</td>
            <td>$15</td>
            <td>$25</td>
          </tr>
          <tr>
            <td>2</td>
            <td>77940132</td>
            <td>Almendras x 100 grs.</td>
            <td>25</td>
            <td>Frutos Secos</td>
            <td>$20</td>
            <td>$30</td>
          </tr>
          <tr>
            <td>3</td>
            <td>77940133</td>
            <td>Arándanos</td>
            <td>35</td>
            <td>Frutos Secos</td>
            <td>$22</td>
            <td>$30</td>
          </tr>
          <tr>
            <td>4</td>
            <td>77940132</td>
            <td>Almendras x 100 grs.</td>
            <td>25</td>
            <td>Frutos Secos</td>
            <td>$20</td>
            <td>$30</td>
          </tr>
          <tr>
            <td>5</td>
            <td>77940132</td>
            <td>Almendras x 100 grs.</td>
            <td>25</td>
            <td>Frutos Secos</td>
            <td>$20</td>
            <td>$30</td>
          </tr>
          <tr>
            <td>6</td>
            <td>77940132</td>
            <td>Almendras x 100 grs.</td>
            <td>25</td>
            <td>Frutos Secos</td>
            <td>$20</td>
            <td>$30</td>
          </tr>
          <tr>
            <td>7</td>
            <td>77940132</td>
            <td>Almendras x 100 grs.</td>
            <td>25</td>
            <td>Frutos Secos</td>
            <td>$20</td>
            <td>$30</td>
          </tr>
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