<!DOCTYPE html>
<html>
<head>
    <title>FORM ORDER</title>
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
    $sql = "DELETE FROM `order` WHERE id_order NOT IN (SELECT id_order FROM order_detail)";
    $result = mysqli_query($kon, $sql);
    if ($result == false) {
        echo ("error description: " . mysqli_error($kon));
    }

    if (isset($_POST['namapembeli'])) {
        $namapembeli = $_POST['namapembeli'];

        $sql = "INSERT INTO `order` (pembeli) VALUES ('" . $namapembeli . "')";
        $result = mysqli_query($kon, $sql);
        if ($result == false) {
            echo ("error description: " . mysqli_error($kon));
        } else {
            $last_id = mysqli_insert_id($kon);
            header("Location: ./order_detail.php?namapembeli=" . $namapembeli . "&last_id=" . $last_id);
        }
    }
    ?>
    <br><br>
    <h1>Silahkan Inputkan Nama Anda</h1>
    <form action="" method="post">
        <div class="form-group">
            <label>Nama Pembeli : </label>
            <input type="text" name="namapembeli" class="form-control" placeholder="Masukan Nama Anda" required/>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>