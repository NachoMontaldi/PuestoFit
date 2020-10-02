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
    include_once '../clases/repositorio_pedido_reposicion.class.php';
    include_once '../pantallas/barra_nav.php';

    Conexion::abrirConexion(); 
    

    if(isset($_POST["emitir_cot"])){

      
  
      $cotizacion = new cotizaciones('','','','','','',0,1);
      
      $cotizacion_insertada = repositorio_cotizacion :: insertar_cotizacion(Conexion :: obtenerConexion(),$cotizacion);
      
   
    }

    $id = repositorio_cotizacion::obtener_ultimo_id(Conexion::obtenerConexion());

    
    
    

    if(isset($_POST['enviar'])){

      //echo $_POST['proveedor'];

      //actualiza el estado a 1
      $pedido_validado = repositorio_cotizacion:: estado_cotizacion(Conexion :: obtenerConexion(),$id);

      //actualiza el proveedor al que se seleccionó
      $pedido_proveedor = repositorio_cotizacion :: proveedor_cotizacion(Conexion :: obtenerConexion(),$id,$_POST['proveedor']);

      //actualiza el codigo pedido en cotizaciones
      $codigo = repositorio_cotizacion :: pedido_cotizacion (Conexion :: obtenerConexion(),$id,$_POST['cod_pedido']);

      // insertar los detalles
      
      repositorio_cotizacion :: cargar_detalles($_POST['cod_pedido'], $id);
      
      // borrar los estados igual a 0
      repositorio_cotizacion :: eliminar_falsos (Conexion :: obtenerConexion());

      // actualiza el estado del pedido de reposicion a 2
      repositorio_pedido_reposicion :: actualizar_estado_listo(Conexion::obtenerConexion(),$_POST['cod_pedido']);

      //redirige despues de insertar
      Redireccion::redirigir(ruta_cotizaciones_principal);
     
    }    


?>
<html>

  <head>
    <title>Emitir solicitud de cotización</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/cotizaciones_emitir.css">
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
                  <td rowspan="4">
                      <!--Grilla de productos para cotizacion-->
                      <div class="table-responsive-lg">
                        <table id="grilla" class="table-hover table table-bordered">
                          <thead class="thead-dark">
                            <tr>
                              <th>Nombre</th>
                              <th>Marca</th>
                              <th>Cantidad</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if(isset($_POST['seleccionar'])){
  
                              escritor_filas :: escribir_detalles_pedido_cot($_POST['seleccionar']);
                        
                            }?>
                            
                          </tbody>
                        </table>
                      </div>
                    </td>
                </tr>
                <tr>
                  <td class="titulos"> Pedido Reposición:</td>
                  <td class="valor">
                  <form method="post">
                    <input type="text" style="width: 85%; margin-right: 1,5%" readonly name="cod_pedido" id="codigo_ped_rep" value="<?php
                    
                    if(isset($_POST['seleccionar'])){
  
                          echo $_POST['seleccionar'];

                    }?>">
                    <a href="<?php echo ruta_seleccionar_pedido_rep ?>">
                      <button type="button" name="busqueda" id="buscar" class="boton_buscar" >
                      <i class="fa fa-search"></i></button>
                    </a>
                  </td>
                </tr>

                <tr>
                  <td class="titulos"> Sucursal:</td>
                  <td class="valor">
                  <form method="post">
                    <input type="text" readonly name="sucursal" id="sucursal" value="<?php
                    
                    if(isset($_POST['seleccionar'])){
                
                          echo $_POST['sucursal2'];

                    }?>">
                  </td>
                </tr>

                <tr>
                    <td class="titulos">Proveedor:</td>
                    <td class="valor">
                        <!-- desplegable -->
                        <select name="proveedor" id="proveedor">
                            <option selected value="<?php 
                            ?>0"> Elije un proveedor</option>
                            <?php

                              escritor_filas::escribir_lista_proveedores();
                            
                            ?>

                        </select>
                    </td>   
                </tr>
                <form method="post" >
                  <tr>
                      <td colspan="3" style= "text-align:right" class="valor">
                      <?php /* if(isset($_POST['vista'])){
                        ?>
                          <input type="hidden" name="proveedor_mod"  id="proveedor_mod" value="<?php echo $_POST['proveedor'] ;?>">
                      <?php } */ ?>
                        
                          <button type="submit" name="enviar" id="gd" class="boton">REGISTRAR</button>
                        
                          
                      </td>
                  </tr>
                </form>
            </table>
    </div>

    <div class="contenedor4">
        <a href="<?php echo ruta_cotizaciones_principal?>"><button type="submit" name="volver" id="volver">VOLVER</button></a> 
    </div> 
