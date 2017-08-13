<?php


use Dompdf\Dompdf;
use Dompdf\Options;

require_once 'dompdf/autoload.inc.php';


function select() {
 

$html = '<html>

<head>
<style>


@import url("https://fonts.googleapis.com/css?family=Lato:300,400,700|Roboto:400,500");

body {
	font-family: "Lato", sans-serif;


}


table {
    font-family: Lato, sans-serif;
    border-collapse: collapse;
    width: 100%;
    margin: 0px auto 0;

}

.small {
    height: 100px;
}

th {
    background-color: #f73829;
    color: white;
    font-size: 13px;
    padding: 10px;
    text-align: center;
    border-right: 2px solid rgba(0,0,0,0.02);
    text-transform: uppercase;
}
td {
    border: 1px solid #f3f3f3;
    text-align: center;
    padding: 8px;
    font-weight: 300;
       min-height: 92px;
}

tr:nth-child(even) {
    background-color: #fdfdfd;
}

table img {
       width: 75px;
    margin: 0 auto;
    display: inline-block;
    height: 56px;
}


.circle {
       width: 75px;
    height: 56px;
    background: #f3f3f3;
    border-radius: 50%;
    margin: 0 auto;
    display: block;
}

.footer { position: fixed; bottom: 0px; padding: 5px 0; color: #022638 }

.pagenum {
    float: right;
}
      .pagenum:before { content: counter(page); }

</style>
</head>
 <body>


 <header style="background-color: #022638; padding: 10px 0;">
 <div class="logo">
<center><img src="logo.png" style="max-height: 120px;"></center>
 </div>
 </header>

 <div style="font-weight:bold;border: 0 !important;background-color: #021f2d;padding:8px 0; text-align: center; text-transform: uppercase;color:#fff;">Price List For Light Fittings</div>

<table>';

$html .= $_POST['data_table'];
$html .='</table>    <div class="footer"><span class="pagenum"></span></div>
</body></html>';


// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

$pdf = $dompdf->output();
file_put_contents("page.pdf", $pdf);

   exit;
}

select();

// Connect to database "download" using: dbname , username , password 
