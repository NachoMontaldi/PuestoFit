<!DOCTYPE html>
<?php
    include_once '../config.inc.php';
    include_once '../clases/escritor_filas.class.php';
    include_once '../clases/repositorio_proveedores.class.php';
    include_once '../clases/proveedores.class.php';
    include_once '../conexion.class.php';
    include_once '../clases/repositorio_cotizacion.class.php';
    include_once '../clases/cotizaciones.class.php';
    include_once '../clases/detalle_cotizacion.class.php';
    include_once '../clases/redireccion.class.php';

    Conexion::abrirConexion();
    

    if(isset($_POST["emitir_cot"])){

      
  
      $cotizacion = new cotizaciones('','','','','',0);
      
      $cotizacion_insertada = repositorio_cotizacion :: insertar_cotizacion(Conexion :: obtenerConexion(),$cotizacion);
      
   
    }

    $id = repositorio_cotizacion::obtener_ultimo_id(Conexion::obtenerConexion());

    if(isset($_POST['vista'])){



      $detalle_cotizacion = new detalle_cotizacion('',$id, $_POST['nombre'],$_POST['marca'],$_POST['cantidad']);
      
      $detalle_insertado = repositorio_cotizacion :: insertar_detalle_cotizacion(Conexion :: obtenerConexion(),$detalle_cotizacion);

    }
    

    if(isset($_POST['enviar'])){

      echo $_POST['proveedor_mod'];

      $pedido_validado = repositorio_cotizacion:: estado_cotizacion(Conexion :: obtenerConexion(),$id);
      $pedido_proveedor = repositorio_cotizacion :: proveedor_cotizacion(Conexion :: obtenerConexion(),$id,$_POST['proveedor_mod']);
      Redireccion::redirigir(ruta_cotizaciones_principal);
     
    }    


?>
<html>

  <head>
    <title>Emitir solicitud de cotización</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/cotizaciones_emitir.css">
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
        <li><a href="#">Ventas</a></li>
        <li><a href="<?php echo ruta_proveedor_principal?>">Proveedores</a></li>
        <li><a href="<?php echo ruta_compras_principal?>">Compras</a></li>
        <li><a href="<?php echo ruta_inventario_principal?>">Stock</a></li>
      </ul>
    </div>

      <!---------------------------------------------------------------------------------------------------->
      <div id="formulario" class="form">
            <table class="tabla" border="1px"> 
                <tr>
                  <td colspan="3" class="titulo">
                        EMITIR SOLICITUD DE COTIZACIÓN
                    </td>
                </tr>
                <tr>
                  <td class="titulos">Fecha:</td>
                  <td class="valor">
                    <input type="date" name="Fecha" id="Fecha" readonly value="<?php echo date("Y-m-d");?>">
                  </td>
                  <td colspan="2" rowspan="6">
                      <!--Grilla de productos para cotizacion-->
                      <div class="table-responsive-lg">
                        <table id="grilla" class="table-hover table table-bordered">
                          <thead class="thead-dark">
                            <tr>
                              <th>Nombre</th>
                              <th>Marca</th>
                              <th>Cantidad</th>
                              <th></th>
                            </tr>
                            <?php
                            
                             escritor_filas :: escribir_detalles_cotizacion($id);

                            ?>
                          </tbody>
                        </table>
                      </div>
                    </td>
                </tr>
                <tr>
                <form method="post" action="<?php echo ruta_cotizaciones_emitir ?>">
                    <td class="titulos">Proveedor:</td>
                    <td class="valor">
                        <!-- desplegable -->
                        <select name="proveedor" id="proveedor">
                            <option selected value="<?php 
                                /*if(isset($_POST['vista'])){
                                    echo $_POST['proveedor'];
                                }else{
                                  print "0";
                                }*/
                            ?>0"> Elije un proveedor</option>
                            <?php

                              escritor_filas::escribir_lista_proveedores();
                            
                            ?>

                        </select>
                    </td>   
                </tr>
                <tr>
                    <td class="titulos">Nombre producto:</td>
                    <td class="valor">
                        <input type="text" name="nombre" id="nombre">
                    </td>   
                </tr>
                <tr>
                <td class="titulos">Marca:</td>
                  <td class="valor">
                      <input type="text" name="marca" id="marca">
                  </td>      
                </tr>
                </tr>
                <tr>
                <td class="titulos">Cantidad:</td>
                  <td class="valor">
                      <input type="number" name="cantidad" id="cantidad" min="1">
                  </td>      
                </tr>
                <tr>
                  <td class="valor" colspan="2">
                    <div class="botones">
                      <input type="submit" name="vista" value="Agregar a Vista Previa" id="avp">
                    </div>
                  </td>
                </tr>
                </form>
                <form method="post" >
                <tr>
                    <td colspan="4" style="text-align:right" class="valor">
                    <?php if(isset($_POST['vista'])){
                      ?>
                        <input type="hidden" name="proveedor_mod"  id="proveedor_mod" value="<?php echo $_POST['proveedor'] ;?>">
                    <?php } ?>
                       
                        <button type="submit" name="enviar" id="gd" class="boton">REGISTRAR</button>
                       
                        
                    </td>
                </tr>
                </form>
            </table>
    </div>

    <div class="contenedor4">
        <a href="<?php echo ruta_cotizaciones_principal?>"><button type="submit" name="volver" id="volver">VOLVER</button></a> 
    </div> 
