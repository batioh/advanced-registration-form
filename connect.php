<?php

    //Penamaan Variabel
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


    //Database Connection
    $conn = new mysqli('localhost', 'root', '', 'registrasi_kursus');
    
    if (mysqli_connect_error()){
    //Error Handiling
        echo "$conn->connect_error";
        die('Connection Failed: '. $conn->connect_error);
    } else{
    //Masukin data ke tabel

    //Insert 1
        $stmt = $conn->prepare("INSERT INTO siswa(NamaLengkap, KotaKelahiran, AlamatRumah, TanggalLahir, Asrama, JenPend, Sekolah, Kelas, ProgramGabungan) VALUES(?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssss", $NamaLengkap, $KotaKelahiran, $AlamatRumah, $TanggalLahir, $Asrama, $JenPend, $Sekolah, $Kelas, $ProgramGabungan);
        $execval= $stmt->execute();
        $stmt->close();
        $conn->close();

    //Insert 2
        $conn = new mysqli('localhost', 'root', '', 'registrasi_kursus');
        $Program = $_POST['Program'];
        $hasil = mysqli_query($conn, "SELECT * FROM invoice  ORDER BY invoiceID DESC LIMIT 1");
            $invoice = mysqli_fetch_assoc($hasil);
            $tagihan = ($invoice["invoiceID"]);
        foreach($Program as $items){
            
            $stmt = $conn->prepare("INSERT INTO line_buy(invoiceID, ProgramID) VALUES(?,?)");
            $stmt->bind_param("is", $tagihan, $items);
            $execval= $stmt->execute();
            $stmt->close();
        }
        $conn->close();
    //Pendefinisian varibel
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

    

    
?>
        <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Registrasi Kursus Bahasa Inggris</title>
                <link rel= "stylesheet" href="connect-style.css">
            </head>
            <body>
            
                <div class="wrapper">
                    <div class="title">Bukti Pembayaran Kursus</div>
                    <div class="input_field">
                        <label>Nomor Pembayaran: </label><?php echo $id ?>
                    </div>
                    <br>
                    <div class="input_field">
                        <label class=sub-heading>Nama: </label> <?php echo $namalengkap ?>
                    </div>
                    <br>
                    <div class="input_field">
                        <label>Asrama: </label><?php echo $asrama ?>
                    </div>
                    <br>
                    <div class="input_field">
                        <label>Program: </label><?php echo $program ?>
                    </div>
                    <br>
                    <div class="input_field">
                        <label>Total Tagihan: </label><?php echo $tagihan ?>
                    </div>
                    <br>
                    <div class="input_field">
                        <label>Tanggal Pembayaran: </label><?php echo $tanggaldaftar ?>
                    </div>
                    <br>
                    <div class="input_field">
                        <label>Status : </label> Lunas
                    </div>
                    <br>
                    <div class="navigate">
                        <a href = registration_form.html
                            <button type ="submit" class="back" value="Back" id="back" href="_cetak.php" target="_blank">Kembali</button> 
                        </a>
                        <a href = cetak.php target="_blank">
                            <button type ="submit" class="btn">Cetak</button>
                        </a>
                    </div>
                </div>
            </body>
        </html>
        <?php
    }
?>