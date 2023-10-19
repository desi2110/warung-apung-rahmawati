<!DOCTYPE html>
<html>
<head>
    <title>FORM MENU</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <style>
        body {
            background-image: url(makanan.jpg);
            background-size: cover;
            background-attachment: fixed;
            color: white;
            font-size: 30px;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }
        h1 {
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }

    </style>
</head>
<body>
    
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $jenis=input($_POST["jenis"]);
        $nama_menu=input($_POST["nama_menu"]);
        $harga=input($_POST["harga"]);

        //Query input menginput data kedalam tabel anggota
        $sql="insert into menu (jenis,nama_menu,harga) values
		('$jenis','$nama_menu','$harga')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <br><br>
    <h1>Input Menu</h1>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Jenis:</label>
            <input type="text" name="jenis" class="form-control" placeholder="Masukan Jenis Menu" required/>
        </div>
       <div class="form-group">
            <label>Nama Menu :</label>
            <input type="text" name="nama_menu" class="form-control" placeholder="Masukan Menu" required/>
        </div>
                </p>
        <div class="form-group">
            <label>Harga:</label>
            <input type="text" name="harga" class="form-control" placeholder="Masukan harga" required/>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>