<?php
session_start();
//koneksi ke database
include 'koneksi.php';

if (!isset($_SESSION['admin']))
{
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style2.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/font-awesome.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <title>Menu Remen kopi</title>
</head>

<body>
    <!-- Navbar-->
    <nav class="navbar navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img class="navbar-brand" src="assets/img/logo.png" alt=""></a>
            <div style="color: white;
            padding: 15px 50px 5px 50px;
            float: right;
                font-size: 16px;"> Last access : <?php echo date('Y-m-d') ?> &nbsp; <a href="index.php?halaman=logout"
                    class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </div>
    </nav>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="index.php">Home</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="index.php?halaman=produk">Produk</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="index.php?halaman=pembelian">Pembelian</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="index.php?halaman=laporan_pembelian">Laporan</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="index.php?halaman=pelanggan"></i>Pelanggan</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="index.php?halaman=logout"></i>Logout</a>
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Page content-->
            <div class="container-fluid">
                <?php
                if (isset($_GET['halaman']))
                {
                    if($_GET['halaman']=="produk")
                    {
                        include 'produk.php';
                    }
                    elseif($_GET['halaman']=="pembelian")
                    {
                        include 'pembelian.php';
                    }
                    elseif($_GET['halaman']=="pelanggan")
                    {
                        include 'pelanggan.php';
                    }
                    elseif($_GET['halaman']=="logout")
                    {
                        include 'logout.php';
                    }
                    elseif($_GET['halaman']=="detail")
                    {
                        include 'detail.php';
                    }
                    elseif($_GET['halaman']=="tambahproduk")
                    {
                        include 'tambahproduk.php';
                    }
                    elseif($_GET['halaman']=="hapusproduk")
                    {
                        include 'hapusproduk.php';
                    }
                    elseif($_GET['halaman']=="ubahproduk")
                    {
                        include 'ubahproduk.php';
                    }
                    elseif($_GET['halaman']=="logout")
                    {
                        include 'logout.php';
                    }
                    elseif($_GET['halaman']=="pembayaran")
                    {
                        include 'pembayaran.php';
                    }
                    elseif($_GET['halaman']=="laporan_pembelian")
                    {
                        include 'laporan_pembelian.php';
                    }

                }
                else
                {
                    include 'home.php';
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Fontawesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>