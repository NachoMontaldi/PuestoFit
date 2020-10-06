<!DOCTYPE html>
<?php
    include_once '../conexion.class.php';
    include_once '../config.inc.php';
    include_once '../clases/inventario.class.php';
    include_once '../clases/repositorio_inventario.class.php';
    include_once '../clases/redireccion.class.php';
    include_once '../pantallas/barra_nav.php';
    
    Conexion :: abrirConexion(); 
    if(isset($_POST['editar'])){

        
        
        $producto=repositorio_inventario::obtener_producto(Conexion::obtenerConexion(),$_POST['editar']);
        $_SESSION['id']='';
        $_SESSION['id']=$_POST['editar'];
        
       
       
    }

?>
<html>

  <head>
    <title>Modificar producto</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/mod_producto.css">
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
</head>
  <body>


     <!---------------------------------------------------------------------------------------------------->
    <div id="formulario" class="form">
        <form name="formP1" action="<?php echo ruta_inventario_principal ?>" method="post">
            <table class="tabla" border="1px"> 
                <tr>
                    <td colspan="4" class="titulo">
                        MODIFICAR PRODUCTO
                    </td>
                </tr>
                <tr> 
                    <td class="titulos">Nombre producto:</td>
                    <td class="valor" colspan="3">
                        <input type="text" readonly name="nombre" id="nombre" value="<?php echo $producto -> obtener_nombre();?>">
                    </td>
   
                </tr>
                <tr>
                    <td class="titulos">Categoria:</td>
                    <td class="valor" colspan="3">
                        <select name="categoria" id="categoria">
                            <option selected value="0"> Elije una categoria</option>
                            <option value="cereales">Cereales</option>
                            <option value="yogures">Yogures</option>
                            <option value="suplementos">Suplementos</option>
                            <option value="barritas">Barritas</option>
                        </select>
                    </td>
                    
                </tr>
                <tr>
                    <td class="titulos">Marca:</td>
                    <td class="valor">
                        <input type="text" name="marca" id="marca" value="<?php echo $producto -> obtener_marca();?>">
                    </td>
                    <td class="titulos">Cantidad Mínima:</td>
                    <td class="valor">
                        <input type="number" name="cantidadMin" id="cantidadMin" value="<?php echo $producto -> obtener_cantidad_min();?>">
                    </td>
                    
                </tr>
                <tr>
                    <td class="titulos">Precio de costo:</td>
                    <td class="valor">
                        <input type="number" readonly name="precioC" id="precioC" value="<?php echo $producto -> obtener_precio_compra();?>">
                    </td>
                    
                    <td class="titulos">Precio de venta:</td>
                    <td class="valor">
                        <input type="number" name="precioV" id="precioV" value="<?php echo $producto -> obtener_precio_venta();?>">
                    </td>

                </tr>
                <tr>
                    <td class="titulos" valign="top" >Observaciones:</td>
                    <td class="valor">
                    <label for="contieneT">Contiene T.A.C.C</label>
                    <input type="text"  name="contieneT" id="contieneT" value="<?php echo $producto -> obtener_contiene_T();?>">
                        <br>
                        <br>
                    <label for="contieneA">Contiene azúcar</label>
                    <input type="text"  name="contieneA" id="contieneA" value="<?php echo $producto -> obtener_contiene_A();?>">
                        <br>
                        <br>
                    <label for="contieneL">Contiene lactosa</label>
                    <input type="text"  name="contieneL" id="contieneL" value="<?php echo $producto -> obtener_contiene_L();?>">
                    
                    </td>
                    <td class="titulos" valign="top">
                        Descripción:</td>
                    <td class="valor">
                    <textarea name="descripcion" id="Descripcion"><?php echo $producto -> obtener_descripcion();?></textarea>
                    </td>
                    <td>
                    <input type="hidden" name="id"  id="id" value="<?php echo $producto -> obtener_cod_prod();?>"></input>
                    </td>
                </tr>
                <tr>
                <td colspan="4" style="text-align:right" class="valor">
                    <button type="submit" name="guardar_cambios" id="gd"  class="boton">GUARDAR</button>
                    <button type="refresh" name="limpiar" id="ld" class="boton">LIMPIAR DATOS</button>
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