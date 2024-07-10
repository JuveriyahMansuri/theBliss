<?php
include 'con12.php';
require_once 'C:\xampp\htdocs\Login\vendor\autoload.php';
$oid = $_GET['$oid'];

use Dompdf\Dompdf;


$date = date('d-m-y');
$sql = mysqli_query($con,"SELECT * FROM `order` o,`order_detail` od , product pd WHERE o.order_id = od.order_id AND o.order_id = '$oid' AND od.product_id = pd.product_id;");
$discount = 0;
$gt = 0; 
$i=1;
$rupee = "₹";

$html = '<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Invoice </title>
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


</style>
</head>
<body>
<header>
			<h1>The Bliss</h1>
			<address contenteditable>
				<p>Navrangpura,Ahmedabad</p>
				<p> +91 7845961230 </p>
			</address>
		<!--	<span> <img src="./image/Logo.jpg" alt=""/> </span>-->
		</header>
        <table class="meta">
        <tr>
            <th><span contenteditable>Invoice No.</span></th>
            <td><span contenteditable>'.$oid.'</span></td>
        </tr>
        <tr>
            <th><span contenteditable>Date</span></th>
            <td><span contenteditable>'.$date.'</span></td>
        </tr>
    </table>
   <br/> <br/> <br/> <br/><br/> <br/>
   <h2> INVOICE </h2>
    <table>
        <thead>
            <tr>
                <th> ID </th>
                <th> Product </th>
                <th> Price (in Rs)</th>
                <th> Discount (in %)</th>
                <th> Quantity </th>
                <th> Total </th>
            </tr>
        </thead>
        <tbody>';

        while($row = mysqli_fetch_array($sql)){
            $product_id = $row['product_id'];
            $odis = mysqli_query($con,"SELECT `offer/discount_id` FROM product WHERE product_id = '$product_id';");
            $odis = mysqli_fetch_assoc($odis);
            $disper = $odis['offer/discount_id'];

            $percent = mysqli_query($con,"SELECT `discount` From `offer/discount` where `offer/discount_id` = '$disper';");
            $percent = mysqli_fetch_assoc($percent);
            $discountper = $percent['discount'];

            $tprice = $row['price'] - $row['discount_price'];
            $price = $tprice * $row['quantity'];
            $pay_status = $row['payment_status'];
            $pay_mode = $row['payment_mode'];
           // $pdiscount = $pdiscount + $tprice;
            $html .='<tr>
            <td>' .$i. '</td>
            <td>'.$row['name']. '</td>
            <td>' .$row['price']. '</td>
            <td>' .$discountper. '</td>
            <td>' .$row['quantity']. '</td>
            <td>' .$price. '</td>
        </tr>';
        $discount = $discount + ($row['discount_price'] * $row['quantity']);
        $gt = $gt + $price;
        $i++;
        }
        $html .='   </tbody>
       
        <tr> 
            <th colspan="5" class="my-table"> Grand Total </th>
            <th>' .$gt. ' Rs</th>
        </tr>
    </table>
    <br/> <br/>
    <p style="text-transform: capitalize;"> Payment Mode : '.$pay_mode.' </p>
    <p style="text-transform: capitalize;"> Payment Status : '.$pay_status.' </p>
</body>
</html>';

$dompdf = new Dompdf();
$dompdf->loadhtml($html);
$dompdf->setpaper('A4','portrait');
$dompdf->render();
$dompdf->stream('invoice.pdf',  ['Attachment'=>0]);
?>


            
     