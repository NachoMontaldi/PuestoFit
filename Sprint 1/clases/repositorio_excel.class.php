<?php
class repositorio_excel{
 

    /* Acens */ 
    public static function exportar_excel_2($libros) {

        if(!empty($libros)) {

            $timestamp = date("Y-m-d");

            $filename = "Ranking de Productos ". $timestamp .".xls";

            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=".$filename);

            $mostrar_columnas = false;

            foreach($libros as $libro) {
            
                if(!$mostrar_columnas) {
                    echo implode("\t", array_keys($libro)) . "\n";
                    $mostrar_columnas = true;
                }

                echo implode("\t", array_values($libro)) . "\n";
            }   

        }else{
            echo 'No hay datos a exportar';
        }

        exit;
    }
    public static function exportar_excel_saldo($libros) {

        if(!empty($libros)) {

            $timestamp = date("Y-m-d");

            $filename = "Saldo Ingresos-Egresos ". $timestamp .".xls";

            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=".$filename);

            $mostrar_columnas = false;

            foreach($libros as $libro) {
         
                if(!$mostrar_columnas) {
                    echo implode("\t", array_keys($libro)) . "\n";
                    $mostrar_columnas = true;
                }

                echo implode("\t", array_values($libro)) . "\n";
            }   

        }else{
            echo 'No hay datos a exportar';
        }

        exit;
    }
    public static function exportar_excel_ingresos($libros) {

        if(!empty($libros)) {

            $timestamp = date("Y-m-d");

            $filename = "Ingresos ". $timestamp .".xls";

            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=".$filename);

            $mostrar_columnas = false;

            foreach($libros as $libro) {

                if(!$mostrar_columnas) {
                    echo implode("\t", array_keys($libro)) . "\n";
                    $mostrar_columnas = true;
                }

                echo implode("\t", array_values($libro)) . "\n";
            }   

        }else{
            echo 'No hay datos a exportar';
        }

        exit;
    }
    public static function exportar_excel_egresos($libros) {

        if(!empty($libros)) {

            $timestamp = date("Y-m-d");

            $filename = "Egresos ". $timestamp .".xls";

            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=".$filename);

            $mostrar_columnas = false;

            foreach($libros as $libro) {

                if(!$mostrar_columnas) {
                    echo implode("\t", array_keys($libro)) . "\n";
                    $mostrar_columnas = true;
                }

                echo implode("\t", array_values($libro)) . "\n";
            }   

        }else{
            echo 'No hay datos a exportar';
        }

        exit;
    }
}