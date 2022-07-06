<?php
session_start();
//echo "<pre>";
//print_r($_SESSION['keranjang']);
//echo "</pre>";
include 'koneksi.php';

if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
    echo "<script>alert('keranjang kosong, silahkan belanja terlebih dahulu');</script>";
    echo "<script>location='index.php';</script>";
}
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
    <title>Keranjang</title>
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

    <section class="konten">
        <div class="container">
            <h1 class="mt-4 mb-4">Keranjang Belanja</h1>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subharga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor=1; ?>
                    <?php foreach ($_SESSION['keranjang'] as $id_produk=> $jumlah): ?>
                    <!-- menampilkan produk yg sedang diperulangkan dengan id_produk-->
                    <?php 
                        $query = $koneksi->query("SELECT *FROM produk WHERE id_produk='$id_produk'");
                        $produk = $query->fetch_assoc();
                        $subharga = $produk["harga_produk"]*$jumlah;
                        //echo "<pre>";
                        //print_r($produk);
                        //echo "</pre>";
                    ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $produk['nama_produk']; ?></td>
                        <td>Rp. <?php echo number_format($produk['harga_produk']); ?></td>
                        <td><?php echo $jumlah; ?></td>
                        <td>Rp. <?php echo number_format($subharga); ?></td>
                        <td>
                            <a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">Hapus</a>
                        </td>
                    
                    </tr>
                    <?php $nomor++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
            <hr>
            <a href="index.php" class="btn btn-outline-dark">Lanjutkan Belanja</a>
            <a href="login.php" class="btn btn-primary">Checkout</a>
        </div>
    </section>

</body>

</html>