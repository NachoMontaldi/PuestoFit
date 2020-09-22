<head>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link href='https://fonts.googleapis.com/css?family=Actor' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<header>
  <div id="logo">
    <img src="/puestofit/images/puestoFit.png" alt="Puesto Fit">
  </div>
  <div id="header">
    <ul id="nav">
      <li><a href="">Inicio</a></li>
      <li>
        <a href="">Clientes</a>
        <!--        <ul>
                        <li><a href="">Submenu1</a></li>
                        <li><a href="">Submenu2</a></li>
                    </ul> -->
      </li>
      <li>
        <a href="">Ventas</a>
        <!--        <ul>
                        <li><a href="">Submenu1</a></li>
                        <li><a href="">Submenu2</a></li>
                    </ul> -->
      </li>
      <li><a href="<?php echo ruta_proveedor_principal ?>">Proveedores</a></li>
      <li>
        <a href="">Compras</a>
        <ul>
          <li><a href="<?php echo ruta_compras_principal?>">Facturas</a></li>
          <li><a href="<?php echo ruta_remitos_principal?>">Remitos</a></li>
          <li><a href="<?php echo ruta_ordenes_de_compra_principal?>">Ordenes de compra</a></li>
          <li><a href="<?php echo ruta_cotizaciones_principal?>">Cotizaciones</a></li>
          <li><a href="<?php echo ruta_pagos_principal?>">Pagos</a></li>
        </ul>
      </li>
      <li>
        <a href="">Stock</a>
        <ul>
          <li><a href="<?php echo ruta_inventario_principal?>">Productos en deposito</a></li>
          <li><a href="<?php echo ruta_pedidos_reposicion_principal?>">Pedidos de reposición</a></li>
        </ul>
      </li>
    </ul>
  </div>
</header>