<!DOCTYPE html>
<?php
include_once '../config.inc.php';
include_once '../conexion.class.php';
include_once '../clases/escritor_filas_cotizaciones_seleccion.class.php';
include_once '../clases/repositorio_pedido_reposicion.class.php';
include_once '../pantallas/barra_nav.php';

Conexion::abrirConexion();



?>
<html>

<head></head>
<title>Seleccionar cotización</title>
<link rel="stylesheet" type="text/css" href="/puestofit/css/header.css">
<link rel="stylesheet" type="text/css" href="/puestofit/css/seleccionar_pedido_rep.css">
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
        <table class="tabla" border="1px" style="height: 400px">
            <tr>
                <td colspan="4" class="titulo">
                    SELECCIONAR COTIZACIÓN

            <tr>
                <td colspan="4">
                                     <!---BARRA DE BUSQUEDA-->
                    <!--Se mete dentro de un form para poder usar el metodo post-->
                    <div>
                    <form role="form" method="post" action="<?php echo
                        $_SERVER['PHP_SELF']?>">
                        <div class="form-group">
                            <p id="busqueda">
                                <input type="text" class="form-control" id="searchBox"
                                    name="criterio" placeholder="BUSCAR">
                                <!--El button se hace de type = "submit" para que pueda trasladar datos-->
                                <button type="submit" class="form-control" name="busqueda"
                                    id="searchBotton"><i class="fa fa-search"></i></button>
                            </p>
                        </div>
                    </form>
                    </div>
                    <!--Grilla de productos-->
                    <div class="table-responsive-lg">
                        <table id="grilla" class="table-hover table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Cod.</th>
                                    <th>Fecha emisión</th>
                                    <th>Fecha presupuesto</th>
                                    <th>Sucursal</th>
                                    <th>Proveedor</th>
                                    <th>Cotización</th>
                                    <th></th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    if(isset($_POST['busqueda'])){//si entra en el if quiere decir que la pagina se cargo por la busqueda
                                                                        
                                        
                                        $criterio= $_POST['criterio'];
                                        escritor_filas_cotizaciones_seleccion::escribir_filas_filtradas_sel_cotizacion($criterio);
                                        
                                    }else{//si entra por else quiere decir que la pagina cargo desde la barra de navegacion

                                        escritor_filas_cotizaciones_seleccion::obtener_cotizaciones_cargadas(Conexion::obtenerConexion());

                                    }


                                   

                                    ?>


                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
        </table>
    </div>




    <div class="contenedor4">
        <a href="<?php echo ruta_registrar_orden_de_compra ?>"><button name="volver" id="volver">VOLVER</button></a>
    </div>
</body>

</html>