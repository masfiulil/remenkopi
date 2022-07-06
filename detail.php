<?php 
session_start();
include 'koneksi.php'; 
?>
<?php
// mendapatkan id produk dari url
$id_produk = $_GET["id"];
// query ambil data
$query = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $query->fetch_assoc();
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
    <title>Detail</title>
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
    <!-- <pre>
        <?php print_r($detail); ?>
    </pre> -->

    <section class="konten mb-4 mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="admin/fotoproduk/<?php echo $detail['foto_produk']; ?>" width="500" alt="" class="img-responsive">
                </div>
                <div class="col-md-6">
                    <h2><?php echo $detail['nama_produk']; ?></h2>
                    <h4>Rp. <?php echo number_format($detail['harga_produk']); ?></h4>
                    <h5>Stok: <?php echo $detail['stok_produk']; ?></h5>
                    <form method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" min="1" class="form-control" name="jumlah" max="<?php echo $detail['stok_produk']; ?>" required>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" name="beli">Beli</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <?php
                    // jika klik tombol beli
                    if (isset($_POST['beli']))
                    {
                        // mendapatkan jumlah yang diinputkan
                        $jumlah = $_POST["jumlah"];

                        // masukkan di keranjang belanja
                        //jika sudah ada produk di keranjang, maka produk itu jumlahnya di + jumlah inputan
                        if(isset($_SESSION['keranjang'][$id_produk]))
                        {
                            $_SESSION['keranjang'][$id_produk]+=$jumlah;
                        }
                        //selain itu (blm ada di keranjang), maka produk itu dianggap dibeli sejumlah inputan
                        else
                        {
                            $_SESSION['keranjang'][$id_produk] = $jumlah;
                        }

                        echo "<script>alert('produk telah masuk ke keranjang belanja')</script>";
                        echo "<script>location='keranjang.php'</script>";

                    }
                    ?>
                    <p>
                    <?php echo $detail['deskripsi_produk']; ?>
                    </p>
                </div>
            </div>
        </div>
    </section>
    
</body>
</html>