<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('THE BLISS');
$pdf->SetTitle('THE BLISS');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

class PDF extends TCPDF 
{
    public function Header(){
        $imageFile = K_PATH_IMAGES.'The Bliss.png';
        $this->Image($imageFile, 40, 10, 40,'','PNG','','T',false, 300, '',false,false,0,false,false,false);
        $this->Ln(5);
        $this->SetFont('helvetica','B',12);
        $this->Cell(189,5,'The Bliss',0,1,'C');

    }

   /* public function Footer(){
        $this->SetY(-148);
        $this->Ln(5);
        $this->SetFont('times','B',10);
        $this->MultiCell(189,15,'The Bliss',0,'L',0,1,'','',true);
    }*/
}


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO , PDF_HEADER_LOGO_WIDTH, 'THE BLISS', 'Navrangpura, Ahmedabad');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content






include 'con12.php';
$oid = $_GET['$oid'];




$date = date('d-m-y');
$sql = mysqli_query($con,"SELECT * FROM `order` o,`order_detail` od , product pd WHERE o.order_id = od.order_id AND o.order_id = '$oid' AND od.product_id = pd.product_id;");
$discount = 0;
$gt = 0; 
$i=1;
$rupee = "₹";

$html = '
<html>
<head>
<title> </title>

<style>
h2{
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    text-align: center;
}
table{
    font-family: Arial, Helvetica, sans-serif;
    border-collaspe: collapse;
    width: 100%;
}
td,th{
    border: 1px solid #444;
    padding: 8px;
    text-align: left;
    font-size : 14px;
}
.my-table{
    text-align: right;
}




*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

*[contenteditable] { cursor: pointer; }

*[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

span[contenteditable] { display: inline-block; }

/* heading */

h1 { font: bold 100% sans-serif;  text-align: center; text-transform: uppercase; }



/* table meta & balance */

table.meta, table.balance { float: right; width: 36%; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

/* table meta */

table.meta th { width: 40%; }
table.meta td { width: 60%; }



p{
        border: 0;
        box-sizing: content-box;
        color: inherit;
        font-family: inherit;
        font-size: inherit;
        font-style: inherit;
        font-weight: inherit;
        line-height: inherit;
        list-style: none;
        margin: 0;
        padding: 0;
        text-decoration: none;
        vertical-align: top;
}
.tc{
    text-align:center;
}


</style>
</head>
<body>
<table class="meta" cellspacing="3" cellpadding="2">
<tr> 
<br> <br>
   &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;
   &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;
   &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;
   &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;
   &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;
   &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp; 

   <th style="font-weight: bold; text-align: center; "><span contenteditable>Invoice No.</span></th>
    <td  style = "text-align: center;"><span contenteditable>'.$oid.'</span></td>
</tr>
<tr>
    <th style="font-weight: bold; text-align: center; "><span contenteditable>Date</span></th>
    <td style = "text-align: center;"><span contenteditable>'.$date.'</span></td>
</tr>
</table>
<br/> <br/> <br/>   
<h2> INVOICE </h2>
<table border="2" cellspacing="3" cellpadding="4">
<thead>
    <tr >
        <th style="font-weight: bold;" class="tc"> ID </th>
        <th style="font-weight: bold;" class="tc"> Product </th>
        <th style="font-weight: bold;" class="tc"> Price (in Rs)</th>
        <th style="font-weight: bold;" class="tc"> Discount (in %)</th>
        <th style="font-weight: bold;" class="tc"> Quantity </th>
        <th style="font-weight: bold;" class="tc"> Total </th>
    </tr>
</thead>
<tbody>';

while($row = mysqli_fetch_array($sql)){
    $product_id = $row['product_id'];
    $odis = mysqli_query($con,"SELECT `offer/discount_id` FROM product WHERE product_id = '$product_id';");
    $odis = mysqli_fetch_assoc($odis);
    $disper = $odis['offer/discount_id'];

    if($disper != null)
    {
        $percent = mysqli_query($con,"SELECT `discount` From `offer/discount` where `offer/discount_id` = '$disper';");
        $percent = mysqli_fetch_assoc($percent);
        $discount_percent =  $percent['discount'];
        $price = ($row['price'] - ($row['price'] * $discount_percent/100)) * $row['quantity'];
    }
    else{
        $discount_percent = "-";
        $price = $row['price'] * $row['quantity']; 
    }
   

    //$tprice = $row['price'] - $row['discount_price'];
    //$price = $tprice * $row['quantity'];
    $pay_status = $row['payment_status'];
    $pay_mode = $row['payment_mode'];
   // $pdiscount = $pdiscount + $tprice;
    $html .='<tr>
    <td class="tc">' .$i. '</td>
    <td class="tc">'.$row['name']. '</td>
    <td class="tc">' .$row['price']. '</td>
    <td class="tc"> '.$discount_percent.'</td>
    <td class="tc">' .$row['quantity']. '</td>
    <td class="tc">' .$price. '</td>
</tr>';


$discount = $discount + ($row['discount_price'] * $row['quantity']);
$gt = $gt + $price;
$i++;
}
$html .='   

<tr> 
    <th colspan="5" class="my-table" style="font-weight: bold;"> Grand Total </th>
    <th class="tc">' .$gt. ' Rs</th>
</tr>
</tbody>
</table>

<br/> <br/>
<div style="text-transform: capitalize;"> Payment Mode : '.$pay_mode.' </div>
<div style="text-transform: capitalize;"> Payment Status : '.$pay_status.' </div>

</body>
</html>';



$pdf->writeHTML($html, true, false, true, false, '');








// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('The Bliss Invoice.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+