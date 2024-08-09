<?php
session_start();
if(@$_SESSION['validada']==1){

}else
header("location: ../iniciosesion.php");
require "fpdf.php";

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {

      $this->Image('logo_oficial_lema.png', 9, 10, 100); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->Ln(6); // Salto de línea
      $this->SetFont('Arial', 'B', 30); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(125); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(130, 15, utf8_decode('UNIVERSIDAD TECNOLÓGICA'), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Cell(125); // Movernos a la derecha
      $this->Cell(130, 15, utf8_decode('DE LA SELVA'), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(8); // Salto de línea
      $this->SetTextColor(103); //color

      /* GENERADO 
      $this->Cell(8);  // mover a la derecha
      $this->SetFont('Arial', 'B', 14);
      $this->Cell(96, 10, utf8_decode("Generado por : " . $_SESSION['nombre']), 0, 0, '', 0);
      $this->Ln(15);*/

      /* CORREO */
      /*$this->Cell(8);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Correo : "), 0, 0, '', 0);
      $this->Ln(5);*/

      /* TELEFONO */
      /*$this->Cell(8);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : "), 0, 0, '', 0);
      $this->Ln(20);*/
      $nombre_cuerpo=$_SESSION['nombre_cuerpo'];
      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(228, 100, 0);
      $this->Cell(88); // mover a la derecha
      $this->SetFont('Arial', 'B', 18);
      $this->Cell(100, 10, utf8_decode("REPORTE DE LINEAS DE INVESTIGACIÓN DEL CUERPO ACADÉMICO:"), 0, 1, 'C', 0);
      $this->SetTextColor(228, 100, 0);
      $this->Cell(88); // mover a la derecha
      $this->SetFont('Arial', 'B', 18);
      $this->Cell(100, 10, utf8_decode($nombre_cuerpo), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      /*la suma del ancho de la tabla
         debe de dar 275*/
      $this->SetFillColor(228, 100, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(20, 10, utf8_decode('ID'), 1, 0, 'C', 1);
      $this->Cell(126, 10, utf8_decode('NOMBRE'), 1, 0, 'C', 1);
      $this->Cell(130, 10, utf8_decode('DESCRIPCIÓN'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }

   // Método para calcular el número de líneas necesarias para el texto en una celda de ancho dado
   function NbLines($w, $txt)
   {
       $cw = $this->CurrentFont['cw'];
       if ($w == 0)
           $w = $this->w - $this->rMargin - $this->x;
       $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
       $s = str_replace("\r", '', $txt);
       $nb = strlen($s);
       if ($nb > 0 and $s[$nb - 1] == "\n")
           $nb--;
       $sep = -1;
       $i = 0;
       $j = 0;
       $l = 0;
       $nl = 1;
       while ($i < $nb) {
           $c = $s[$i];
           if ($c == "\n") {
               $i++;
               $sep = -1;
               $j = $i;
               $l = 0;
               $nl++;
               continue;
           }
           if ($c == ' ')
               $sep = $i;
           $l += $cw[$c];
           if ($l > $wmax) {
               if ($sep == -1) {
                   if ($i == $j)
                       $i++;
               } else
                   $i = $sep + 1;
               $sep = -1;
               $j = $i;
               $l = 0;
               $nl++;
           } else
               $i++;
       }
       return $nl;
   }

   // Método para crear una celda con ajuste automático de altura
   function Row($data)
   {
       $nb = 0;
       $widths = [20, 126, 130];
       for ($i = 0; $i < count($data); $i++) {
           $nb = max($nb, $this->NbLines($widths[$i], $data[$i]));
       }
       $h = 10 * $nb;
       $this->CheckPageBreak($h);
       for ($i = 0; $i < count($data); $i++) {
           $w = $widths[$i];
           $a = 'C';
           $x = $this->GetX();
           $y = $this->GetY();
           $this->Rect($x, $y, $w, $h);
           $this->MultiCell($w, 10, $data[$i], 0, $a);
           $this->SetXY($x + $w, $y);
       }
       $this->Ln($h);
   }

   // Verificar si es necesario un salto de página
   function CheckPageBreak($h)
   {
       if ($this->GetY() + $h > $this->PageBreakTrigger)
           $this->AddPage($this->CurOrientation);
   }

}


//CADENA DE CONEXION
$con = mysqli_connect("localhost","root","","gestor_de_proyectos");

$nombre_cuerpo=$_SESSION['nombre_cuerpo'];

$consulta = "SELECT * FROM linea_investigacion WHERE nombre_cuerpo='$nombre_cuerpo' ";
  
$result = mysqli_query($con,$consulta);

$pdf = new PDF();
$pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

/*$consulta_reporte_alquiler = $conexion->query("  ");*/

while ($row = mysqli_fetch_array($result)) { 
                     
                        /* TABLA */
                        $id = utf8_decode($row['id_linea']);
                         $nombre = utf8_decode($row['nombre']);
                         $descripcion = utf8_decode($row['descripcion']);
                     
                         $pdf->Row([$id, $nombre, $descripcion]);

$exec=mysqli_query($con,$consulta); 

}

mysqli_close($con);

$pdf->Output('Reporte Docentes.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
