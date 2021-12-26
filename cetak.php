<?php
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
$conn = new mysqli('localhost', 'root', '', 'registrasi_kursus');
    $result = mysqli_query($conn, "SELECT * FROM siswa  ORDER BY SiswaID DESC LIMIT 1");
    $siswa = mysqli_fetch_assoc($result);
    $namalengkap = ($siswa["NamaLengkap"]);
    $tanggaldaftar = $siswa['register_date'];
    $asrama = $siswa['Asrama'];
    $program = $siswa['ProgramGabungan'];
    $id = $siswa['SiswaID'];
    $query_harga = mysqli_query($conn, 
    "SELECT * FROM sump WHERE InvoiceID = ". $id);
    $sump = mysqli_fetch_array($query_harga);
    $tagihan = $sump['Subtotal'];

    
// Write some HTML code:
$stylesheet = file_get_contents('cetak.css');
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href="./cetak.css">
</head>
<body>

    <div class="wrapper">
        <div class="title">Bukti Pembayaran Kursus</div>
        <div class="input_field">
            <label class="label" >Nomor Pembayaran: </label>  ' .$id .   '
        </div>
        <br>
        <div class="input_field">
            <label class="label" >Nama: </label>  ' .$namalengkap .   '
        </div>
        <br>
        <div class="input_field">
            <label class="label" >Asrama: </label>  ' .$asrama. '
        </div>
        <br>
        <div class="input_field">
            <label class="label" >Program:  </label> ' . $program . '
        </div>
        <br>
        <div class="input_field">
             <label>Total Tagihan: </label>'. $tagihan . '
         </div>
         <br>
        <div class="input_field">
            <label class="label" >Tanggal Pembayaran: </label>  ' . $tanggaldaftar . '
        </div>
        <br>
        <div class="input_field">
            <label class="label" >Status: </label>  Lunas
        </div>
        <br>
    </div>
</body>
</html>
';

// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

// Output a PDF file directly to the browser
$filename= $id . "-" . $namalengkap . ".pdf"; //You might be not adding the extension, 
$mpdf->Output($filename,'D');

?>