<?php 

require('fpdf.php');

class PDF extends FPDF
{

// Cabecera de página

function Header()
{

    // Arial bold 15
    $this->SetFont('Arial','B',18);

    // Movernos a la derecha
    $this->Cell(80);

    // Título
    $this->Cell(70,10,'Productos',0,0,'C');

    // Salto de línea    
    $this->Ln(20);

    // Valores del input
    $this->Cell(100,10,'Nombre', 1, 0, 'C', 0);
    $this->Cell(45,10,'Precio', 1, 0, 'C', 0);
    $this->Cell(45,10,'Stock', 1, 1, 'C', 0);


}

// Pie de página

function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);

    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10, utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require 'conexion.php';
$consulta= " SELECT * FROM productos";
$resultado= $mysqli->query($consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 16);
//$pdf->Cell(40,10,utf8_decode('¡Hola,Mundo!'));

 while($row = $resultado->fetch_assoc()){
    $pdf->Cell(100,10,$row['nombre'], 1, 0, 'C', 0);
    $pdf->Cell(45,10,$row['precio'], 1, 0, 'C', 0);
    $pdf->Cell(45,10,$row['stock'], 1, 1, 'C', 0);
 }
$pdf->Output();



?>