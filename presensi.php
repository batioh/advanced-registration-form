<?php
require_once __DIR__ . '/vendor/autoload.php';
$kls = $_REQUEST['print-kls'];



require "functions.php";
$presensi = query("SELECT * FROM siswa WHERE KLS_BINGS = '$kls' OR KLS_BINGC = '$kls' OR KLS_MATHS = '$kls' ");


$stylesheet = file_get_contents('presensi.css');
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel= "stylesheet" href="presensi.css">
</head>
<body>
<body>
    
    <div class="wrapper">
    <div class="title">Presensi Kelas ' . $kls . '</div>';

        $html .= '
        <table border="1" cellspacing="0">
            <tr>
                <th>No.</th>
                <th class="nama">Nama</th>
                <th class= "pertemuan">P1</th>
                <th class= "pertemuan">P2</th>
                <th class= "pertemuan">P3</th>
                <th class= "pertemuan">P4</th>
                <th class= "pertemuan">P5</th>
                <th class= "pertemuan">P6</th>
                <th class= "pertemuan">P7</th>
                <th class= "pertemuan">P8</th>
                <th class= "pertemuan">P9</th>
                <th class= "pertemuan">P10</th>
            <tr>';
            
             $i = 1;
            foreach ($presensi as $row) {
                
                $html .= '<tr>
                    <td class= "row_id">' .$i++ . ' </td>
                    <td>' . $row["NamaLengkap"] . '</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>';
            }

            $html .= '</table>';



// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

// Output a PDF file directly to the browser
$filename=  "Presensi - " . $kls . ".pdf"; //You might be not adding the extension, 
$mpdf->Output($filename,'D');

?>