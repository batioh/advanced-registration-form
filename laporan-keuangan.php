<?php

//sambung ke database
require "functions.php";
$keuangan = query("SELECT * FROM laporan_keungan");



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Kursus Bahasa Inggris</title>
    <link rel= "stylesheet" href="laporan-keuangan.css">
</head>
<body>
    <div class="topnav">
        <a  href="registration_form.html">Home</a>
        <a href="assign-kelas.php">Assign Kelas</a>
        <a href="list-kelas.html">List Kelas</a>
        <a href="master-data.php">Master Data</a>
        <a class="active" href="laporan-keuangan.php">Lap. Keuangan</a>
    </div>
    
    <div class="wrapper">
    <div class="title">Laporan Keuangan</div>

    <a href='cetak-lapkeu.php'><input type ="submit" name="print-kls" value="Cetak" class="btn"></input></a>
   
        <table border="1" cellspacing="0">
            <tr>
                <th>ID</th>
                <th class="nama">Nama</th>
                <th class= "asrama">Program yang Diikuti</th>
                <th>Subtotal</th>
            <tr>
            
            <?php $total = 0; ?>
            <?php foreach ($keuangan as $row) : ?>
                <tr>
                    <td class= "row_id"> <?= $row["SiswaID"] ?> </td>
                    <td> <?= $row["NamaLengkap"] ?> </td>
                    <td> <?= $row["Program"] ?> </td>
                    <td> <?= $row["Subtotal"] ?> </td>
                    <?php $total += $row["Subtotal"] ?>
                </tr>
            <?php endforeach; ?>

        </table>
        <table border="1" cellspacing="0" class="total">
            <tr>
                <th class="header-total">Total Pemasukan</th>
                <td class="sum-subtotal"> <?= $total ?> </td>
            </tr>
        </table>
    </body>
</html>