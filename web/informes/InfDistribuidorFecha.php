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
	$this->Line(230,280,9,280);//largor,ubicacion derecha,inicio,ubicacion izquierda
    // Go to 1.5 cm from bottom
        $this->SetY(-15);
    // Select Arial italic 8
        $this->SetFont('Arial','I',8);
    // Print centered page number
	$this->Cell(0,2,utf8_decode('Página: ').$this->PageNo().' de {nb}',0,0,'R');
	$this->text(10,283,'Datos Generados en: '.date('d-M-Y').' '.date('h:i:s'));
}

function Header()
{
   // Select Arial bold 15
    $this->SetFont('Arial','',16);
    $this->Image('img/intn.jpg',10,14,-300,0,'','../../InformeCargos.php');
    // Move to the right
    $this->Cell(80);
    // Framed title
    $this->text(37,19,utf8_decode('Instituto Nacional de Tecnología, Normalización y Metrología'));
    $this->SetFont('Arial','',8);
    $this->text(37,24,"Avda. Gral. Artigas 3973 c/ Gral Roa- Tel.: (59521)290 160 -Fax: (595921) 290 873 ");
    $this->text(37,29,"ORGANISMO NACIONAL DE METROLOGIA");
    $this->text(37,34,"Telefax: (595921) 295 408 e-mail: metrologia@intn.gov.py");
    //-----------------------TRAEMOS LOS DATOS DE CABECERA----------------------
   
    //---------------------------------------------------------
    $this->Ln(30);
    $this->Ln(30);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.2);
	$this->Line(230,40,10,40);//largor,ubicacion derecha,inicio,ubicacion izquierda
    //------------------------RECIBIMOS LOS VALORES DE POST-----------
    if  (empty($_POST['txtDistribuidor'])){$coddistribuidor='';}else{ $coddistribuidor = $_POST['txtDistribuidor'];}
    if  (empty($_POST['txtDesdeFecha'])){$desde='';}else{ $desde= $_POST['txtDesdeFecha'];}
    if  (empty($_POST['txtHastaFecha'])){$hasta='';}else{ $hasta= $_POST['txtHastaFecha'];}
    $conectate=pg_connect("host=localhost port=5434 dbname=ESTACIONES user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
    $consulta=pg_exec($conectate,"select dis_nom as distribuidor from distribuidor where dis_cod=$coddistribuidor");
    $distribuidor=pg_result($consulta,0,'distribuidor');
    //table header CABECERA        
    $this->SetFont('Arial','B',12);
    $this->SetTitle('Clientes-Estaciones');
    $this->text(55,50,'CONTROL DE ESTACIONES DE SERVICIOS');
    $this->text(10,65,'DISTRIBUIDOR:');//Titulo
    $this->text(50,65,$distribuidor);
    $this->text(10,75,'DESDE FECHA:');
    $this->text(45,75,$desde);
    $this->text(10,85,'HASTA FECHA:');
    $this->text(45,85,$hasta);
    
}
}
$pdf= new PDF();//'P'=vertical o 'L'=horizontal,'mm','A4' o 'Legal'
$pdf->AddPage();
//------------------------RECIBIMOS LOS VALORES DE POST-----------
    if  (empty($_POST['txtDistribuidor'])){$coddistribuidor='';}else{ $coddistribuidor = $_POST['txtDistribuidor'];}
    if  (empty($_POST['txtDesdeFecha'])){$desde='';}else{ $desde= $_POST['txtDesdeFecha'];}
    if  (empty($_POST['txtHastaFecha'])){$hasta='';}else{ $hasta= $_POST['txtHastaFecha'];}
    
//-------------------------Damos formato al informe-----------------------------    
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
    
//----------------------------Build table---------------------------------------
$pdf->SetXY(10,100);
$pdf->Cell(25,10,'Cantidad',1,0,'C',50);
$pdf->Cell(25,10,'Aprobados',1,0,'C',50);
$pdf->Cell(25,10,'Reprobados',1,0,'C',50);
$pdf->Cell(25,10,'Clausurados',1,0,'C',50);
$pdf->Cell(50,10,'Usuario',1,0,'C',50);
$pdf->Cell(30,10,'Fecha Registro',1,1,'C',50);
$fill=false;
$i=0;
$pdf->SetFont('Arial','',10);

//------------------------QUERY and data cargue y se reciben los datos-----------
$conectate=pg_connect("host=localhost port=5434 dbname=ESTACIONES user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
$consulta=pg_exec($conectate,"select reg.reg_cant,reg.reg_aprob, reg.reg_reprob, 
reg.reg_reprob,reg.reg_claus,usu.usu_nom||' '||usu.usu_ape as usuario,
to_char(reg.reg_fecha,'DD/MM/YYYY') as reg_fecha
from registros reg,usuarios usu,clientes cli,distribuidor dis 
where reg.cli_cod=cli.cli_cod
and reg.dis_cod=dis.dis_cod
and reg.usu_cod=usu.usu_cod 
and dis.dis_cod=$coddistribuidor 
and reg.reg_fecha >=  '$desde'
and reg.reg_fecha <= '$hasta' order by reg_fecha");
$numregs=pg_numrows($consulta);
while($i<$numregs)
{   
    $cantidad=pg_result($consulta,$i,'reg_cant');
    $aproba=pg_result($consulta,$i,'reg_aprob');
    $reprob=pg_result($consulta,$i,'reg_reprob');
    $claus=pg_result($consulta,$i,'reg_claus');
    $usuario=pg_result($consulta,$i,'usuario');
    $fecha=pg_result($consulta,$i,'reg_fecha');
    $pdf->Cell(25,5,$cantidad,1,0,'C',$fill);
    $pdf->Cell(25,5,$aproba,1,0,'L',$fill);
    $pdf->Cell(25,5,$reprob,1,0,'L',$fill);
    $pdf->Cell(25,5,$claus,1,0,'L',$fill);
    $pdf->Cell(50,5,$usuario,1,0,'L',$fill);
    $pdf->Cell(30,5,$fecha,1,1,'L',$fill);
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