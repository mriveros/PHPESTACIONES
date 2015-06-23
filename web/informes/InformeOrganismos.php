<?php 
session_start();
?>
<?php
//Example FPDF script with PostgreSQL
//Ribamar FS - ribafs@dnocs.gov.br

require('fpdf.php');

class PDF extends FPDF{
function Footer()
{
        
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.2);
	$this->Line(343,236,9,236);//largor,ubicacion derecha,inicio,ubicacion izquierda
    // Go to 1.5 cm from bottom
        $this->SetY(-15);
    // Select Arial italic 8
        $this->SetFont('Arial','I',8);
    // Print centered page number
	$this->Cell(0,2,utf8_decode('Página: ').$this->PageNo().' de {nb}',0,0,'R');
	$this->text(10,234,'Consulta Generada: '.date('d-M-Y').' '.date('h:i:s'));
}

function Header()
{
   // Select Arial bold 15
    $this->SetFont('Arial','',8);
    $this->Image('img/intn.jpg',10,10,-300,0,'','../../InformeCargos.php');
    // Move to the right
    $this->Cell(80);
    // Framed title
    $this->text(10,32,utf8_decode('Instituto Nacional de Tecnología, Normalización y Metrología'));
    $this->text(315,32,'Sistema Control de Instrumentos');
    //$this->Cell(30,10,'noc',0,0,'C');
    // Line break
    $this->Ln(30);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.2);
	$this->Line(360,33,10,33);//largor,ubicacion derecha,inicio,ubicacion izquierda

    //table header        
    $this->SetFont('Arial','B',12);
    $this->SetTitle('LISTADO DE INGRESOS');
    $this->Cell(300,10,'Listado Ingresos de Instrumentos',100,100,'C');//Titulo
    $this->SetFillColor(153,192,141);
    $this->SetTextColor(255);
    $this->SetDrawColor(153,192,141);
    $this->SetLineWidth(.3);
    $this->Cell(50,10,'Item',1,0,'C',1);
    $this->Cell(50,10,'Proforma',1,0,'C',1);
    $this->Cell(50,10,'Cliente',1,0,'C',1);
    $this->Cell(50,10,'Algo',1,1,'C',1);
}
}
$pdf=new PDF();//'P'=vertical o 'L'=horizontal,'mm','A4' o 'Legal'
//------------------------QUERY and data cargue y se reciben los datos-----------
$conectate=pg_connect("host=localhost port=5434 dbname=onmworkflow user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
$consulta=pg_exec($conectate,"Select * from ingreso");
$numregs=pg_numrows($consulta);
//-------------------------Damos formato al informe-----------------------------      
$pdf->AddPage('L', 'Legal');
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
//Build table

$fill=false;
$i=0;
while($i<$numregs)
{
    
    $nrolinea=pg_result($consulta,$i,'ing_proforma');
    $cargo=pg_result($consulta,$i,'cli_cod');
    $cedula=pg_result($consulta,$i,'fecha_recepcion');
    
    $pdf->Cell(50,5,$i+1,1,0,'C',$fill);
    $pdf->Cell(50,5,number_format($nrolinea, 0, '', '.'),1,0,'C',$fill);
    $pdf->Cell(50,5,$cargo,1,0,'C',$fill);
    $pdf->Cell(50,5,$cedula,1,1,'C',$fill);
    $fill=!$fill;
    $i++;
}

//Add a rectangle, a line, a logo and some text
/*
$pdf->Rect(5,5,170,80);
$pdf->Line(5,90,90,90);
//$pdf->Image('mouse.jpg',185,5,10,0,'JPG','http://www.dnocs.gov.br');
$pdf->SetFillColor(224,235);
$pdf->SetFont('Arial','B',8);
$pdf->SetXY(5,95);
$pdf->Cell(170,5,'PDF gerado via PHP acessando banco de dados - Por Ribamar FS',1,1,'L',1,'mailto:ribafs@dnocs.gov.br');
*/
$pdf->Output();
$pdf->Close();
?>