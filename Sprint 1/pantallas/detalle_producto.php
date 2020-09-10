<!DOCTYPE html>
<?php


include_once '../conexion.class.php';
include_once '../config.inc.php';
include_once '../clases/inventario.class.php';
include_once '../clases/repositorio_inventario.class.php';
include_once '../clases/redireccion.class.php';
include_once '../clases/repositorio_proveedores.class.php';

//Conexion::abrirConexion();

if(isset($_POST['ver_detalle'])){

        Conexion::abrirConexion();

        $producto=repositorio_inventario::obtener_producto(Conexion::obtenerConexion(),$_POST['ver_detalle']);
        
        
    }
    
?>

<html>

  <head>
    <title>Detalle producto</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/det_producto.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link href='https://fonts.googleapis.com/css?family=Actor' rel='stylesheet'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <header>
      <div id="logo">
      <img src="/puestofit/images/puestoFit.png" alt="Puesto Fit">
      </div>
    </header>
    <!--BARRA DE NAVEGACION-->
    <div id="nav">
      <ul>
        <li><a href="#">Inicio</a></li>
        <li><a href="#">Clientes</a></li>
        <li><a href="#">Ventas</a></li>
        <li><a href="<?php echo ruta_proveedor_principal?>">Proveedores</a></li>
        <li><a href="<?php echo ruta_compras_principal?>">Compras</a></li>
        <li><a href="<?php echo ruta_inventario_principal?>" class="current">Stock</a></li>
      </ul>
    </div>

     <!---------------------------------------------------------------------------------------------------->
    <div id="formulario" class="form">
        <form name="formP1" action="" method="post" >
            <table class="tabla" border="1px"> 
                <tr>
                    <td colspan="4" class="titulo">
                    DETALLE DE PRODUCTO
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Nombre producto:</td>
                    <td class="valor">
                        <input type="text" readonly name="nombre" id="nombre" value="<?php echo $producto -> obtener_nombre();?>">
                    </td>
                    <td class="titulos">Proveedor:</td>
                    <td class="valor">
              <input type="text" readonly name="proveedor" id="proveedor" value="<?php echo repositorio_proveedores::obtener_nombre_proveedor(Conexion::obtenerConexion(),$producto -> obtener_cod_prov())?>">
                    </td>   
                </tr>
                <tr>
                    <td class="titulos">Categoria:</td>
                    <td class="valor">
                    <input type="text" readonly name="categoria" id="categoria" value="<?php echo $producto -> obtener_categoria();?>">
                    </td>
                    <td class="titulos">Cantidad:</td>
                    <td class="valor">
                        <input type="number" readonly name="cantidad" id="cantidad" value="<?php echo $producto -> obtener_existencia();?>">
                    </td>
                    
                </tr>
                <tr>
                    <td class="titulos">Marca:</td>
                    <td class="valor">
                        <input type="text" readonly name="marca" id="marca" value="<?php echo $producto -> obtener_marca();?>">
                    </td>
                    <td class="titulos">Cantidad Mínima:</td>
                    <td class="valor">
                        <input type="number" readonly name="cantidadMin" id="cantidadMin" value="<?php echo $producto -> obtener_cantidad_min();?>">
                    </td>
                    
                </tr>
                <tr>
                    <td class="titulos">Precio de costo:</td>
                    <td class="valor">
                        <input type="number" readonly name="precioC" id="precioC" value="<?php echo $producto -> obtener_precio_compra();?>">
                    </td>
                    
                    <td class="titulos">Precio de venta:</td>
                    <td class="valor">
                        <input type="number" readonly name="precioV" id="precioV" value="<?php echo $producto -> obtener_precio_venta();?>">
                    </td>

                </tr>
                <tr>
                    <td class="titulos" valign="top" >Observaciones:</td>
                    <td class="valor">
                    <label for="contieneT">Contiene T.A.C.C</label>
                    <input type="text" readonly name="contieneT" id="contieneT" value="<?php echo $producto -> obtener_contiene_T();?>">
                        <br>
                        <br>
                    <label for="contieneA">Contiene azúcar</label>
                    <input type="text" readonly name="contieneA" id="contieneA" value="<?php echo $producto -> obtener_contiene_A();?>">
                        <br>
                        <br>
                    <label for="contieneL">Contiene lactosa</label>
                    <input type="text" readonly name="contieneL" id="contieneL" value="<?php echo $producto -> obtener_contiene_L();?>">
                    </td>
                    <td class="titulos" valign="top">Descripción:</td>
                    <td class="valor">
                        <textarea name="descripcion" readonly id="Descripcion"><?php echo $producto -> obtener_descripcion();?></textarea>
                    </td>
                    
    
                        
                    
                    </td>
                </tr>
            </table>
        </form>
    </div>
    
                        
    
    <div class="contenedor4">
    <a href="<?php echo ruta_inventario_principal?>"><button type="submit" name="volver" id="volver">VOLVER</button></a> 
    </div>   

  </body>

</html>
