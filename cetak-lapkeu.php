<?php
require_once __DIR__ . '/vendor/autoload.php';
require "functions.php";
$keuangan = query("SELECT * FROM laporan_keungan");



$stylesheet = file_get_contents('cetak-lapkeu.css');
$html = ' <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel= "stylesheet" href="laporan-keuangan.css">
</head>
<body>

    <div class="wrapper">
    <div class="title">Laporan Keuangan</div>';
    
    $html .= '
        <table border="1" cellspacing="0">
            <tr>
                <th>ID</th>
                <th class="nama">Nama</th>
                <th class= "asrama">Program yang Diikuti</th>
                <th>Subtotal</th>
            </tr>';
            
            $total = 0; 
            foreach ($keuangan as $row) {
                $html .= '<tr>
                    <td class= "row_id">' . $row["SiswaID"] . '</td>
                    <td>' . $row["NamaLengkap"] . ' </td>
                    <td>' . $row["Program"] . ' </td>
                    <td> ' . $row["Subtotal"] . ' </td>';
                    $total += $row["Subtotal"];
                $html .= '</tr>';
            }

        $html .= '</table>';
        $html .= '
        <table border="1" cellspacing="0" class="total">
            <tr>
                <th class="header-total">Total Pemasukan</th>
                <td class="sum-subtotal">' . $total . ' </td>
            </tr>
        </table>
    </body>
</html>
';

// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

// Output a PDF file directly to the browser
$filename=  "Laporan Keuangan" . ".pdf"; //You might be not adding the extension, 
$mpdf->Output($filename,'D');

?>