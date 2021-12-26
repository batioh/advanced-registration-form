<?php

//connect to database
$conn = mysqli_connect("localhost", "root", "", "registrasi_kursus");

function query ($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {

        $rows[] = $row;
    }

    return $rows;
}

function page_redirect($location)
 {
   echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$location.'">';
   exit; 
 }



function ubah($data) {
  global $conn;
  $SiswaID = $_POST['SiswaID'];
  $NamaLengkap = $_POST['NamaLengkap'];
  $KotaKelahiran = $_POST['KotaKelahiran'];
  $TanggalLahir = $_POST['TanggalLahir'];
  $AlamatRumah = $_POST['AlamatRumah'];
  $Asrama = $_POST['Asrama'];
  $JenPend = $_POST['JenPend'];
  $Sekolah = $_POST['Sekolah'];
  $Kelas = $_POST['Kelas'];
  $Program = $_POST['Program'];
  $ProgramGabungan = implode(", " , $Program);

  $query = "
            UPDATE siswa SET 
                NamaLengkap = '$NamaLengkap',
                KotaKelahiran '$KotaKelahiran',
                TanggalLahir ='$TanggalLahir',
                AlamatRumah = '$AlamatRumah',
                Asrama = '$Asrama',
                JenPend ='$JenPend',
                Sekolah ='$Sekolah',
                Kelas = '$Kelas',
                Program ='$Program',
                ProgramGabungan = '$ProgramGabungan'
            WHERE
                SiswaID = '$SiswaID'
            ";
                mysqli_query($conn, $edit_data);
                return mysqli_affected_rows($conn);
}


?>