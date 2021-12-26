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
    <link rel= "stylesheet" href="assign-kelas.css">
    <script src="table2excel.js"></script>
</head>
<body>
<body>
    <div class="topnav">
        <a  href="registration_form.html">Home</a>
        <a class="active" href="assign-kelas.php">Assign Kelas</a>
        <a href="list-kelas.html">List Kelas</a>
        <a href="master-data.php">Master Data</a>
        <a href="laporan-keuangan.php">Lap. Keuangan</a>
    </div>
    
    <div class="wrapper">
    <div class="title">Assign to Class</div>
    <button class= "export-btn" id="downloadexcel">Export to Excel</button>
        <table border="1" cellspacing="0" id="export">
            <tr>
                <th>ID</th>
                <th class="nama">Nama</th>
                <th class= "asrama">Asrama</th>
                <th>Sekolah</th>
                <th>Kelas</th>
                <th class="kelas">KLS-BINGS</th>
                <th class="kelas">KLS-BINGC</th>
                <th class="kelas">KLS-MATHS</th>
                <th> Action </th>
            <tr>
                
            <?php foreach ($siswa as $row) : ?>
                <tr>
                    <td class= "row_id"> <?= $row["SiswaID"] ?> </td>
                    <td> <?= $row["NamaLengkap"] ?> </td>
                    <td> <?= $row["Asrama"] ?> </td>
                    <td> <?= $row["Sekolah"] ?> </td>
                    <td> <?= $row["Kelas"] ?> </td>
                <form  class="form" method="post" action=''>
                    <td> <input type="text" class="input" value="<?php echo $row['KLS_BINGS'];?>" list="List_BINGSREAL" name="KLS_BINGSnew"> </td>
                    <td> <input type="text" class="input" value="<?php echo $row['KLS_BINGC'];?>" list="List_BINGC" name="KLS_BINGCnew"> </td>
                        
                    <td><input type="text" class="input" value="<?php echo $row['KLS_MATHS'];?>"  list="List_MATHS" name="KLS_MATHS"> </td>                   
                     
               
                    <td> <input type ="submit" id="<?php echo $row['SiswaID'];?>" name="assign-kelas" value="<?php echo $row['SiswaID'];?>" class="btn">  Assign</input> </td>
                </form
                </tr>
            <?php endforeach;
            if(isset($_POST["assign-kelas"])) {
                $tombolID = $_REQUEST['assign-kelas'];
                $KLS_BINGC = $_POST['KLS_BINGCnew'];
                $KLS_BINGS = $_POST['KLS_BINGSnew'];
                $KLS_MATHS = $_POST['KLS_MATHS'];

                $assign_kelas = "
                    UPDATE siswa SET 
                        KLS_BINGC= '$KLS_BINGC', 
                        KLS_BINGS= '$KLS_BINGS',  
                        KLS_MATHS=  '$KLS_MATHS' 
                    WHERE SiswaID =  '$tombolID' 
                    ";
                mysqli_query($conn, $assign_kelas);
            
            if (mysqli_query($conn, $assign_kelas)) {
                echo "Record updated successfully";
                page_redirect('assign-kelas.php');
              } else {
                echo "Error updating record: " . mysqli_error($conn);
              }
            // $tombolID = $_GET["assign-kelas"]
            // $siswa = mysqli_query($conn, "SELECT * FROM invoice  ORDER BY invoiceID DESC LIMIT 1");
        }
            ?>
            <!-- <?= $row["SiswaID"] ?> -->

        </table>


    </div>
    
    <datalist id="List_BINGSREAL">
        <option value="BS_A"></option>
        <option value="BS_B"></option>
        <option value="BS_C"></option>
        <option value="BS_D"></option>
        <option value="BS_E"></option>
        <option value="BS_F"></option>
        <option value="BS_G"></option>
        <option value="BS_H"></option>
    </datalist>
    

    <datalist id="List_BINGC">
        <option value="BC_A"></option>
        <option value="BC_B"></option>
        <option value="BC_C"></option>
        <option value="BC_D"></option>
        <option value="BC_E"></option>
        <option value="BC_F"></option>
        <option value="BC_G"></option>
        <option value="BC_H"></option>
    </datalist>

    <datalist id="List_MATHS">
        <option value="MT_A"></option>
        <option value="MT_B"></option>
        <option value="MT_C"></option>
        <option value="MT_D"></option>
        <option value="MT_E"></option>
        <option value="MT_F"></option>
        <option value="MT_G"></option>
        <option value="MT_H"></option>
    </datalist>

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