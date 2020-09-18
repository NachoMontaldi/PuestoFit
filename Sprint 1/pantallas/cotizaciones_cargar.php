<!DOCTYPE html>
<?php
    include_once '../config.inc.php';
    include_once '../clases/escritor_filas.class.php';
    include_once '../conexion.class.php';
    include_once '../clases/repositorio_cotizacion.class.php';
    include_once '../clases/cotizaciones.class.php';
    include_once '../clases/detalle_cotizacion.class.php';
    include_once '../clases/redireccion.class.php';
    include_once '../pantallas/barra_nav.php';
    
    Conexion::abrirConexion();

    if(isset($_POST['cargar'])){
        
        $id = $_POST['cargar'];
        
       
    }elseif(isset($_POST['agregar'])){

        $id = $_POST['cod_cotizacion'];

    }



    if (isset($_POST['agregar'])){


        $cotizacion_precio = repositorio_cotizacion :: precio_unitario(Conexion :: obtenerConexion(),$_POST['agregar'],$_POST['precio_unitario']);

        $total = repositorio_cotizacion:: calcular_precios($id); 
        
        
    }


    if(isset($_POST['enviar_carga'])){
        
    $cotizacion_cargada = repositorio_cotizacion:: estado_cotizacion_cargada(Conexion :: obtenerConexion(),$_POST['id_mod']);
    $cotizacion_cargada_fecha = repositorio_cotizacion :: fecha_cotizacion_cargada (Conexion :: obtenerConexion(),$_POST['id_mod']);
    $total = repositorio_cotizacion:: calcular_precios($_POST['id_mod']); 
    $cotizacion_cargada_total = repositorio_cotizacion :: total_cotizacion_cargada (Conexion :: obtenerConexion(),$_POST['id_mod'],$total);
    repositorio_cotizacion :: eliminar_falsos (Conexion :: obtenerConexion());
    Redireccion::redirigir(ruta_cotizaciones_principal);
       
      }    

?>
<html>

<head>
    <title>Cargar datos de cotización</title>
    <link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
    <link rel="stylesheet" type="text/css" href="/puestofit/css/cotizaciones_cargar.css">
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

    <!---------------------------------------------------------------------------------------------------->
    <div id="formulario" class="form">
       

            <table class="tabla" border="1px">
                <tr>
                    <td colspan="3" class="titulo">
                        CARGAR DATOS DE COTIZACIÓN
                    </td>
                </tr>
                <tr>
                    <td>
                        <!--Grilla de productos para cotizacion-->
                        <div class="table-responsive-lg">
                            <table id="grilla" class="table-hover table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Marca</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                               
                                     escritor_filas :: escribir_cargas_cotizacion($id);
                           
                                    ?>
                            <tr>

                            <tr>

                                <td colspan="4" align="right">
                                    <h3>Total</h3>
                                </td>
                                <td align="center">
                                    <h3> <?php  if (isset($_POST['agregar'])){ echo $total . " $"; }//echo number_format($precio,2) ?> </h3>
                                </td>

                                </tr>
                            </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>

                <form method="post">
                <tr>
                    <td colspan="4 " style="text-align:right" class="valor">
                        <button type="submit" name="enviar_carga" id="gd" class="boton">CARGAR</button>
                        <?php if(isset($_POST['agregar'])){
                        ?>
                            <input  type="hidden" name="id_mod"  id="id_mod" value="<?php echo $_POST['cod_cotizacion'] ;?>">
                            
                        <?php } ?>
                    </td>
                </tr>
                </form>
            </table>
    </div>

    <div class="contenedor4">
        <a href="<?php echo ruta_cotizaciones_principal?>"><button type="submit" name="volver"
                id="volver">VOLVER</button></a>
    </div>