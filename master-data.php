<?php

//sambung ke database
require "functions.php";
$siswa = query("SELECT * FROM siswa");


// if(isset($_POST["submit"]) ) {
    
//     if(assign-kelas($_POST)>0) {
//         echo "
//             <script>
//                 alert('Student successfully assigned');
//                 document.location.href = 'assign-kelas.php';
//             </script>
//         ";

//     } else {
//         echo "
//             <script>
//             alert('Data was not successfully assigned');
//             document.location.href = 'assign-kelas.php';
//         </script>
//     ";
//     }
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Kursus Bahasa Inggris</title>
    <link rel= "stylesheet" href="master-data.css">
    <script src="table2excel.js"></script>
</head>
<body>
<body>
    <div class="topnav">
        <a  href="registration_form.html">Home</a>
        <a  href="assign-kelas.php">Assign Kelas</a>
        <a href="list-kelas.html">List Kelas</a>
        <a class="active" href="master-data.php">Master Data</a>
        <a href="laporan-keuangan.php">Lap. Keuangan</a>
    </div>
    
    <div class="wrapper">
    <div class="title">Assign to Class</div>
    <button class= "export-btn" id="downloadexcel">Export to Excel</button>
        <table border="1" cellspacing="0" id="export">
            <tr>
                <th>ID</th>
                <th class="nama">Nama</th>
                <th class= "asrama">Kota Kelahiran</th>
                <th>Alamat</th>
                <th>Jenjang Pendidikan</th>
                <th>Sekolah</th>
                <th>Kelas</th>
                <th>Program</th>
                <th>Tanngal Pendaftaran</th>
                
            <tr>
                
            <?php foreach ($siswa as $row) : ?>
                <tr>
                    <td class= "row_id"> <?= $row["SiswaID"] ?> </td>
                    <td> <?= $row["NamaLengkap"] ?> </td>
                    <td> <?= $row["KotaKelahiran"] ?> </td>
                    <td> <?= $row["AlamatRumah"] ?> </td>
                    <td> <?= $row["JenPend"] ?> </td>
                    <td> <?= $row["Sekolah"] ?> </td>
                    <td> <?= $row["Kelas"] ?> </td>
                    <td> <?= $row["ProgramGabungan"] ?> </td>
                    <td> <?= $row["register_date"] ?> </td>
                    <td> <a href="edit-data.php?SiswaID=<?= $row["SiswaID"];?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>

        </table>


    </div>
    

    <?php
        //Assign ke kelas klo 'assign'   yang diteken
        // $KLS_BINGC = $_POST['KLS-BINGC'];
        // $KLS_BINGS = $_POST['KLS-BINGS'];
        // $KLS_MATHS = $_POST['KLS-MATHS'];

    ?>
    
    <script>
        document.getElementById('downloadexcel').addEventListener('click', function() {
        var table2excel = new Table2Excel();
        table2excel.export(document.querySelectorAll("#export"), "Data-pendaftar");
        });
    </script>

</body>
</html>