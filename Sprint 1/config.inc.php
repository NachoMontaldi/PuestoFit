<?php

//Info de base de datos
define('nombreServidor','localhost');
define('nombreUsuario','root');
define('password','');
define('nombreBD','puestofit');

//Rutas de la web
/* include_once 'config.inc.php';*/  /*-sirve para poder usar las direcciones desde otros archivos del proyecto*/
define('servidor','http://localhost/puestofit');
define('ruta_inventario_principal',servidor.'/pantallas/inventario_principal.php');
define('ruta_alta_producto',servidor.'/pantallas/alta_producto.php');
define('ruta_detalle_producto',servidor.'/pantallas/detalle_producto.php');
define('ruta_modificar_producto',servidor.'/pantallas/modificar_producto');
define('ruta_modificar_proveedor',servidor.'/pantallas/modificar_proveedor');
define('ruta_registrar_pedido_reposicion',servidor.'/pantallas/registrar_pedido_reposicion');
define('ruta_alta_de_proveedor',servidor.'/pantallas/alta_de_proveedor');
