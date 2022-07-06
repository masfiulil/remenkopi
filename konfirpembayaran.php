<?php
session_start();
//koneksi ke database
include 'koneksi.php';

//mendapatkan id pembelian dari url
$idpem = $_GET["id"];
$query = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detail = $query->fetch_assoc();

/*echo "<pre>";
print_r($detail);
print_r($_SESSION);
echo "</pre>";
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="admin/assets/css/menu.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <title>Pembayaran</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand"><img class="navbar-brand" src="admin/assets/img/logo.png" alt=""></a>
            <form class="d-flex">
                <a class="nav-link" style="color: #cfcfcf;" href="https://api.whatsapp.com/send?phone=6281230230201" tabindex="-1" target="_blank">Help +62 812-3023-0201</a>
            </form>
        </div>
    </nav>

    <?php
    $query= $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
        ON pembelian.id_pelanggan=pelanggan.id_pelanggan
        WHERE pembelian.id_pembelian='$_GET[id]'");
        $detail=$query->fetch_assoc();
    ?>

    <div class="container mb-4 mt-4">
        <h2>Konfirmasi Pembayaran</h2>
        <div class="alert alert-info">total tagihan anda <strong>Rp. <?php echo number_format(
            $detail["total_pembelian"]); ?></strong></div>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label >Nama</label>
                <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]["nama_pelanggan"]?>" class="form-control" name="nama">
            </div>
            <div class="form-group">
                <label >Metode</label>
                <input type="text" readonly value="<?php echo $detail["metode"]?>" class="form-control" name="metode">
            </div>
            <div class="form-group">
                <label >Jumlah</label>
                <input type="text" readonly value="<?php echo $detail["total_pembelian"]?>" class="form-control" name="jumlah">
            </div>
            <div class="form-group mb-4">
                <label >Foto Bukti</label>
                <input type="file" class="form-control" name="bukti" required>
            </div>
            <button class="btn btn-primary" name="kirim"><a href="index.php"></a>Kirim</button>
        </form>
    </div>
    <?php
    // jk ada tombol kirim
    if (isset($_POST["kirim"])) 

    {
        //upload dulu foto bukti
        $namabukti = $_FILES["bukti"]["name"];
        $lokasibukti = $_FILES["bukti"]["tmp_name"];
        $namafiks = date("YmdHis").$namabukti;
        move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

        $nama = $_POST["nama"];
        $metode = $_POST["metode"];
        $jumlah = $_POST["jumlah"];
        $tanggal = date("Y-m-d");

        $koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,metode,jumlah,tanggal,bukti)
        VALUES ('$idpem','$nama','$metode','$jumlah','$tanggal','$namafiks') ");

        echo "<script>alert('pesanan Anda telah diterima, mohon ditunggu');</script>";
        echo "<script>location='index.php'</script>";
    }
    ?>

    
    
</body>

</html>