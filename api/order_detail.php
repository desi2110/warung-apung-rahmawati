<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<title>
    DETAIL ORDER</title>
<?php
    include 'koneksi.php';
    if (isset($_GET['namapembeli'])) {
        $namapembeli = $_GET['namapembeli'];
        $id_order = $_GET['last_id'];
    }
    if (isset($_POST['idmenu']))
    {
        $idmenu = $_POST ['idmenu'];
        $jumlah = $_POST ['jumlah'];

        $sql = "select harga from menu where id_menu = '".$idmenu."' ";
        $result = mysqli_query($kon, $sql);
        if ($result == false) {
            echo ("error description: " . mysqli_error($kon));
        };

        $row = mysqli_fetch_assoc($result);
        $harga = $row ['harga'];
        $subtotal = $jumlah * $harga;

        $sql = "insert into order_detail (id_order, idmenu, jumlah, harga, subtotal) values ('$id_order', '$idmenu', '$jumlah', '$harga', '$subtotal')";
        $result = mysqli_query($kon, $sql);

        if ($result == false) {
            echo ("error description: " . mysqli_error($kon));
        }

    }

?>
<body>
    <nav class="navbar navbar-dark bg-dark">
                <span class="navbar-brand mb-0 h1">WARUNG APUNG RAHMAWATI</span>
            </div>
        </nav>
    <div class="container">
    <br><br>
    <h1><center>SELAMAT DATANG <?php echo $namapembeli; ?></center></h1>
    <h2>No Order Anda : <?php echo $id_order; ?></h2>
    <h3>Order Anda</h3>

    <table border="1" class="my-3 table table-bordered">
        <?php
        $sql = "select order_detail.id_orderdetail, order_detail.id_order, order_detail.idmenu, menu.nama_menu, order_detail.jumlah, menu.harga, order_detail.subtotal
                from order_detail
                left join menu on menu.id_menu = order_detail.idmenu
                where id_order = '".$id_order."'
                order by id_orderdetail";

        $result = mysqli_query($kon, $sql);
        if ($result == false) {
            echo ("error description: " . mysqli_error($kon));
        };

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr class="table-primary">';
                echo '<td>' . $row["id_orderdetail"] . '</td>';
                echo '<td>' . $row["nama_menu"] . '</td>';
                echo '<td>' . $row["jumlah"] . '</td>';
                echo '<td>' . $row["harga"] . '</td>';
                echo '<td>' . $row["subtotal"] . '</td>';
                echo '</tr>';
            }
        };
        ?>
    <tr class="table-primary">
    <form action="" method="post">
        <td>Pilih : </td>
        <td>
        <select name="idmenu">
                <?php
                    $sql = "select id_menu, nama_menu
                    from menu
                    order by nama_menu";

                    $result = mysqli_query($kon, $sql);
                    if ($result == false) {
                        echo ("error description: " . mysqli_error($kon));
                    };
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row["id_menu"] . '">' . $row["nama_menu"] . '</option>';
                    }
                ?>
            </select>
        </td>

        <td>
            <input type="number" name="jumlah" value="1">
        </td>
        <td><button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </td>
    </form>
    </tr>
    </table>
</body>
</html>
