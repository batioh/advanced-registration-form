<?php

//sambung ke database
require "functions.php";
$siswa = query("SELECT * FROM kls_bings");
$kls = "KLS_BINGS";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Kursus Bahasa Inggris</title>
    <link rel= "stylesheet" href="kelas.css">
</head>
<body>
<body>
    
    <div class="wrapper">
    <a href="list-kelas.html"><button type="button">Back</button></a>
    <div class="title">Pendaftar Bahasa Inggris Sekolah</div>
        <table border="1" cellspacing="0">
            <tr>
                <th>ID</th>
                <th class="nama">Nama</th>
                <th class= "asrama">Asrama</th>
                <th>Sekolah</th>
                <th>Kelas</th>
                <th class="kelas">KLS-BINGS</th>
            <tr>
                
            <?php foreach ($siswa as $row) : ?>
                <tr>
                    <td class= "row_id"> <?= $row["SiswaID"] ?> </td>
                    <td> <?= $row["NamaLengkap"] ?> </td>
                    <td> <?= $row["Asrama"] ?> </td>
                    <td> <?= $row["Sekolah"] ?> </td>
                    <td> <?= $row["Kelas"] ?> </td>
                    <td> <?= $row[$kls] ?> </td>
                </tr>
            <?php endforeach; ?>
            