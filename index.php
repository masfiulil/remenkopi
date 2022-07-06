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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <title>Remen kopi</title>
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
    <!-- Head -->
    <section class="head">
        <div class="judul">
            <h1 class="garisbawah">Our Menu</h1>
        </div>
    </section>

    <!-- Konten -->
    <section class="konten">
        <div class="container">
            <div class="row">
                <?php $query = $koneksi->query("SELECT * FROM produk"); ?>
                <?php while($produk = $query->fetch_assoc()){ ?>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img src="admin/fotoproduk/<?php echo $produk['foto_produk']; ?>" width="200" height="200">
                        <div class="caption">
                            <h3><?php echo $produk['nama_produk']; ?></h3>
                            <h5><?php echo number_format($produk['harga_produk']); ?></h5>
                            <a href="beli.php?id=<?php echo $produk['id_produk']; ?>" class="btn btn-primary">Beli</a>
                            <a href="detail.php?id=<?php echo $produk['id_produk']; ?>" class="btn btn-light">Detail</a>
                        </div>
                    </div>
                    <br><br>
                </div>
                <?php } ?>
            </div>            
        </div>
    </section>

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