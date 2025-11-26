<?php

    include_once "app/models/ReportModel.php";
    include_once "config/db_connection.php";
    include_once "public/libraries/fpdf/fpdf.php";
    include_once "public/libraries/phplot/phplot.php";

    class ReportController{

        private $model;

        public function __construct($connection){
            $this -> model = new ReportModel($connection);
        }

        // Método para generar el PDF
        public function generarPDF(){

            $usuarios = $this -> model -> consultarUsuarios();

            // Crear la instancia y crear el archivo
            $pdf = new FPDF();
            $pdf -> AddPage(); // Añadir una página

            // TÍTULO DEL ARCHIVO
            $pdf -> SetFont('Arial', 'B', 16);
            $pdf -> Cell(0, 10, "Usuarios en la base de datos", 0, 1, 'C');
            $pdf -> Ln(10); // Salto de línea

            // CABECERA DE LA TABLA
            $pdf -> SetFont('Arial', 'B', 12);
            $pdf -> SetFillColor(0,0,0); // Agregar un relleno con color
            $pdf -> SetTextColor(255,255,255); // Cambia el color de la letra

            $pdf -> Cell(40, 10, 'ID', 1, 0, 'C', true);
            $pdf -> Cell(50, 10, 'Nombre', 1, 0, 'C', true);
            $pdf -> Cell(50, 10, 'Edad', 1, 0, 'C', true);
            $pdf -> Cell(50, 10, 'Fecha', 1, 0, 'C', true);
            $pdf -> Ln();

            // CUERPO DE LA TABLA
            $pdf -> SetFont('Arial', 'B', 12);
            $pdf -> SetTextColor(0,0,0);

            $edades = 0;
            $i = 0;

            foreach($usuarios as $u){
                $pdf -> Cell(40,10,$u['id_list'],1,0,'C');
                $pdf -> Cell(50,10,$u['nombre'],1,0,'C');
                $pdf -> Cell(50,10,$u['edad'],1,0,'C');
                $pdf -> Cell(50,10,$u['fecha'],1,0,'C');
                $pdf -> Ln();

                // Sumar los valores de todas las edades y aumentar el contador
                $edades += (int) $u['edad'];
                $i++;

            }

            $promedioEdad = $edades / $i;

            $pdf -> Ln(10);
            $pdf -> Cell(0,10,"Promedio edad: " . number_format($promedioEdad, 2),0,1);

            $pdf -> Output('D', 'Reporte_usuarios.pdf');

        }

        // Método para generar gráfica y PDF
        public function generarGrafica(){
            
            $data = $this -> model -> consultarProductos();

            // GENERAR GRÁFICA
            $plot = new PHPlot(800, 600);
            $plot -> SetImageBorderType('plain'); // Añadir borde a la imagen
            $plot -> SetPlotType('bars'); // Definir el tipo de gráfica
            $plot -> SetDataType('text-data'); // Tipo de datos en la gráfica
            $plot -> SetDataValues($data); // Cargar datos del modelo

            $plot -> SetTitle('Producto - Precio');
            $plot -> setXTitle('Nombre');
            $plot -> SetYTitle('Precio');
            $plot -> SetShading(5); // Añadir una sombra a la gráfica
            $plot -> SetDataColors(['#fc3503']); // Cambiar el color de la gráfica

            $filename = 'public/media/graphs/grafica_barra.png';
            $plot -> SetOutputFile($filename); // Agregar gráfica al sistema
            $plot -> SetIsInline(true); // Guardar imagen de forma local
            $plot -> DrawGraph(); // Dibujar la gráfica

            // GENERAR PDF
            $pdf = new FPDF();
            $pdf -> AddPage();

            $pdf -> SetFont('Arial', 'B', 16);
            $pdf -> Cell(0, 10, utf8_decode('Conexión'), 0, 1, 'C');

            //$pdf -> Image(ruta, X, Y, ancho, alto);
            $pdf -> Image($filename, 30, 40, 150, 100);
            $pdf -> Output();

        }

        public function generarPastel(){

            $data = $this -> model -> consultarMarcas();

            // GENERAR GRÁFICA
            $plot = new PHPlot(600, 400);

            $plot -> SetDataValues($data); // Añadir los datos de la gráfica
            $plot -> SetPlotType('pie'); // Gráfica de pastel
            $plot -> SetDataType('text-data-single');

            $plot -> SetTitle('Porcentaje de productos por marca');

            $plot -> SetLegend(array_column($data, 0));

            $filename = 'public/media/graphs/grafica_pastel.png';

            $plot -> SetOutputFile($filename);
            $plot -> SetIsInline(true);
            $plot-> DrawGraph();

            // GENERAR PDF
            $pdf = new FPDF();
            $pdf -> AddPage();

            $pdf -> SetFont('Arial', 'B', 16);
            $pdf -> Cell(0, 10, 'Reporte de marcas', 0, 1, 'C');
            
            $pdf -> Image($filename, 30, 40, 150, 100);
            $pdf -> Ln(100);

            $pdf -> Output();

        }

    }