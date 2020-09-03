<!DOCTYPE html>
<?php
    include_once '../config.inc.php';
?>
<html>

  <head>
    <title>Modificar producto</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/alta_mod_det_producto.css">
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
        <li><a href="<?php echo ruta_proveedor_principal?>">Proveedores</a></li>
        <li><a href="<?php echo ruta_compras_principal?>">Compras</a></li>
        <li><a href="<?php echo ruta_inventario_principal?>" class="current">Inventario</a></li>
        <li><a href="#">Facturas</a></li>
      </ul>
    </div>

     <!---------------------------------------------------------------------------------------------------->
    <div id="formulario" class="form">
        <form name="formP1" action="" >
            <table class="tabla" border="1px"> 
                <tr>
                    <td colspan="4" class="titulo">
                        MODIFICAR PRODUCTO
                    </td>
                </tr>
                <tr>
                    <td class="titulos">Nombre producto:</td>
                    <td class="valor">
                        <input type="text" name="Nombre" id="Nombre">
                    </td>
                    <td class="titulos">Proveedor:</td>
                    <td class="valor">
                        <select name="preveedor" id="proveedor">
                            <option selected value="0"> Elije un proveedor </option>
                            <option value="prov1">prov1</option>
                            <option value="prov2">prov2</option>
                            <option value="prov3">prov3</option>
                            <option value="prov4">prov4</option>
                        </select>
                    </td>   
                </tr>
                <tr>
                    <td class="titulos">Categoria:</td>
                    <td class="valor">
                        <select name="categoria" id="categoria">
                            <option selected value="0"> Elije una categoria</option>
                            <option value="cereales">Cereales</option>
                            <option value="yogures">Yogures</option>
                            <option value="suplementos">Suplementos</option>
                            <option value="barritas">Barritas</option>
                        </select>
                    </td>
                    <td class="titulos">Cantidad:</td>
                    <td class="valor">
                        <input type="number" name="cantidad" id="cantidad">
                    </td>
                    
                </tr>
                <tr>
                    <td class="titulos">Marca:</td>
                    <td class="valor">
                        <input type="text" name="marca" id="marca">
                    </td>
                    <td class="titulos">Cantidad Mínima:</td>
                    <td class="valor">
                        <input type="number" name="cantidadMin" id="cantidadMin">
                    </td>
                    
                </tr>
                <tr>
                    <td class="titulos">Precio de costo:</td>
                    <td class="valor">
                        <input type="number" name="precioC" id="precioC">
                    </td>
                    
                    <td class="titulos">Precio de venta:</td>
                    <td class="valor">
                        <input type="number" name="precioV" id="precioV">
                    </td>

                </tr>
                <tr>
                    <td class="titulos" valign="top" >Observaciones:</td>
                    <td class="valor">
                        <div class="checkbuttons">
                            <label class="container"> Contiene T.A.C.C
                                <input type="checkbox" checked="checked">
                                <span class="checkmark"></span>
                              </label><br/>
                              
                              <label class="container"> Contiene azúcar
                                <input type="checkbox">
                                <span class="checkmark"></span>
                              </label><br/>
                              
                              <label class="container">Contiene lactosa
                                <input type="checkbox">
                                <span class="checkmark"></span>
                              </label><br/>   
                        </div>
                    </td>
                    <td class="titulos" valign="top">Descripción:</td>
                    <td class="valor">
                        <textarea name="Descripcion" id="Descripcion"></textarea>
                    </td>

                    
                </tr>
 
            </table>
        </form>
    </div>
    <div class="botones">
        <input type="button" value="GUARDAR CAMBIOS" id="gd"  class="boton">
        <input type="button" value="LIMPIAR DATOS" id="ld" class="boton">
    </div>
    <div class="contenedor4">
        <button type="button" id="volver"> VOLVER </i></button>
    </div>   

  </body>

</html>