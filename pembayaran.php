<?php
session_start();
//koneksi ke database
include 'koneksi.php';

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
        <h2>Scan Disini</h2>
        <p>nb:</p>
        <ol>
            <li>Jangan lupa screenshot bukti transfer untuk bukti pembayaran</li>
            <li>Untuk pembayaran di tempat bisa lanjut ke Konfirmasi Pembayaran</li>
        </ol>
        <img src="metode/kode.png" width="500" alt="">
        <br><br>
        <a href="konfirpembayaran.php?id=<?php echo $detail["id_pembelian"]; ?>" class="btn btn-success">Konfirmasi Pembayaran</a>
    </div>
    
</body>

</html>