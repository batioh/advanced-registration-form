<?php
require "functions.php";
// cek apakah tombol sumbit pernah ditekan atau belum

    $SiswaID = $_GET["SiswaID"];
    $siswa = query("SELECT * FROM siswa WHERE SiswaID = $SiswaID ")[0];

   
    
            
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Kursus Bahasa Inggris</title>
    <link rel= "stylesheet" href="edit-data.css">
</head>
<body>
    
    <form  class="form" action="" method="post">
    <div class="wrapper">
            <div class="title">Edit Data Siswa</div>
            
                <div class="form">
                    <input type="hidden" name="SiswaID" value="<?= $siswa["SiswaID"]; ?>" >
                    <div class="input_field">
                        <label>Nama Lengkap</label>
                        <input type="text" class="input" name="NamaLengkap" value="<?= $siswa["NamaLengkap"]; ?>" id="NamaLengkap">
                    </div>
                    <div class="input_field">
                        <label>Kota Kelahiran</label>
                        <input type="text" class="input" name="KotaKelahiran" value="<?= $siswa["KotaKelahiran"]; ?>" id="KotaKelahiran">
                    </div>
                    <div class="input_field">
                        <label>Tanggal Lahir</label> 
                        <input type="date" class="input" name="TanggalLahir" value="<?= $siswa["TanggalLahir"]; ?>" id="TanggalLahir" >
                    </div>
                    <div class="input_field">
                        <label>Alamat Rumah</label>
                        <textarea  class="input" name="AlamatRumah" value="<?= $siswa["AlamatRumah"]; ?>" id="AlamatRumah"></textarea>
                    </div>
                    <div class="input_field">
                        <label>Asrama</label>
                        <input type="text" class="input" name="Asrama" value="<?= $siswa["Asrama"]; ?>" id="Asrama">
                    </div>
                    <div class="input_field">
                        <label>Jenjang Pend.</label>
                        <div class="optionsPend">
                            <label class="radios"><input type="radio" name="JenPend" value="SLTP" id="JenPend">  SLTP</label>
                            <label class="radios"><input type="radio" name="JenPend" value="SLTA" id="Jenpend">   SLTA</label>
                        </div>
                    </div>
                    <div class="input_field">
                        <label >Sekolah</label>
                        <input type="text" class="input" list="List_sekolah" name="Sekolah" value="<?= $siswa["Sekolah"]; ?>" id="Sekolah">
                        <datalist id="List_sekolah">
                            <option value="SMASA">SMA Darul Ulum 1</option>
                            <option value="SMADU">SMA Darul Ulum 2</option>
                            <option value="TRISMA">SMA Darul Ulum 3</option>
                            <option value="MAU">MA Unggulan</option>
                            <option value="MAN">MAN 2 Jombang</option>
                            <option value="TELKOM">SMK Telkom</option>
                            <option value="TEMPLEK">SMK Templek</option>
                            <option value="SPASA">SMP Darul Ulum 1</option>
                            <option value="RASTA">SMPN 3 Penterongan</option>
                            <option value="MTSN">MTSN 2 Jombang</option>
                            <option value="PK">MTS PK</option>
                            <option value="MIN">MIN 4 Jombang</option>
                        </datalist>
                    </div>
                    <div class="input_field">
                        <label>Kelas</label>
                        <div class="optionsKelas">
                            <label class="radios"><input type="radio" name="Kelas" value="2 SMP" id="Kelas">   2 SMP</label>
                            <label class="radios"><input type="radio" name="Kelas" value="1 SMP" id="Kelas">   1 SMP</label>
                            <label class="radios"><input type="radio" name="Kelas" value="3 SMP" id="Kelas">   3 SMP</label>
                            <br>
                            <br>
                            <label class="radios"><input type="radio" name="Kelas" value="1 SMA" id="Kelas">   1 SMA</label>
                            <label class="radios"><input type="radio" name="Kelas" value="2 SMA" id="Kelas">   2 SMA</label>
                            <label class="radios"><input type="radio" name="Kelas" value="3 SMA" id="Kelas">   3 SMA</label>

                        </div>
                    </div>
                    <br>
                    <div class="input_field">
                            <label>Pilihan Program</label>
                            <label><input type="checkbox" id="program" class="pilihan_program" value="BING-S" name="Program[]" id="pilihan_program">BING-M</label>
                            <label ><input type="checkbox" id="program" class="pilihan_program"  value="BING-C" name="Program[]" id="pilihan_program">BING-C</label><br>
                            <label><input type="checkbox" id="program"  class="pilihan_program" value="MATH-S" name="Program[]" id="pilihan_program">MATH-M</label><br>
                    </div>
                    <div class="input_field">
                        <button type="submit"  class="btn" name="ubah"/>UBAH</button>
                    </div>
                </div>
            


            </div>
    </form>
    <?php
        if(isset($_POST["ubah"])) {
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


                    $edit_data = 
                    "UPDATE `siswa` SET 
                        NamaLengkap =    '$NamaLengkap', 
                        KotaKelahiran = '$KotaKelahiran',
                        TanggalLahir ='$TanggalLahir',
                        AlamatRumah = '$AlamatRumah',
                        Asrama = '$Asrama',
                        JenPend ='$JenPend',
                        Sekolah ='$Sekolah',
                        Kelas = '$Kelas',
                        ProgramGabungan = '$ProgramGabungan'
                    WHERE
                        SiswaID =  '$SiswaID'
                        ";

                    mysqli_query($conn, $edit_data);
                    
                
                if (mysqli_query($conn, $edit_data)) {
                    echo "Record updated successfully";
                    page_redirect('master-data.php');
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }
        }
    ?>
</body>
</html>


