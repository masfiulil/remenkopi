<?php
session_start();

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
    <title>Checkout</title>
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
        <?php print_r($_SESSION["pelanggan"]); ?>
    </pre>
 -->
    <section class="konten mt-4 mb-4">
        <div class="container">
            <h1>Checkout</h1>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subharga</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor=1; ?>
                    <?php $totalbelanja=0; ?>
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
                        
                    
                    </tr>
                    <?php $nomor++; ?>
                    <?php $totalbelanja+=$subharga; ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan='4'>Total Beli</th>
                        <th>Rp. <?php echo number_format($totalbelanja) ?></th>
                    </tr>
                </tfoot>
            </table>
            <hr>
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]["nama_pelanggan"]?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]["meja_pelanggan"]?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="id_metode" id="" required>
                            <option value="">Pilih Metode Pembayaran</option>
                            <?php $ambil=$koneksi->query("SELECT * FROM metode_pembayaran" ); ?>
                            <?php while($metode = $ambil->fetch_assoc()){ ?>
                            <option value="<?php echo $metode['id_metode'] ?>"> <?php echo $metode['metode'] ?></option>
                            
                            <?php } ?>

                        </select>
                    </div>
                </div><br>
                <button class="btn btn-primary" name="checkout">Checkout</button>
            </form>

            <?php
            if (isset($_POST["checkout"]))
            {
                $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                $id_metode = $_POST["id_metode"];
                $tanggal_pembelian = date("Y-m-d");

                $ambil = $koneksi->query("SELECT * FROM metode_pembayaran WHERE id_metode='$id_metode'");
                $arraymetode = $ambil->fetch_assoc();
                $metode = $arraymetode['metode'];

                $total_pembelian = $totalbelanja;

                //1. menyimpan data ke tabel pembelian
                $koneksi->query("INSERT INTO pembelian (
                    id_pelanggan, id_metode, tanggal_pembelian, total_pembelian, metode)
                    VALUES ('$id_pelanggan','$id_metode','$tanggal_pembelian', '$total_pembelian','$metode' )");
                //mendapatkan id pembelian terbaru
                $id_pembelian_terbaru = $koneksi->insert_id;

                foreach ($_SESSION["keranjang"] as $id_produk => $jumlah)
                {
                    //mendapatkan data produk berdasarkan id produk
                    $ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                    $perproduk = $ambil->fetch_assoc();

                    $nama = $perproduk['nama_produk'];
                    $harga = $perproduk['harga_produk'];

                    $subharga = $perproduk['harga_produk']*$jumlah;
                    $koneksi->query("INSERT INTO pembelian_produk (
                        id_pembelian, id_produk, nama, harga, subharga, jumlah)
                        VALUES ('$id_pembelian_terbaru', '$id_produk', '$nama','$harga', '$subharga','$jumlah') ");
                    

                    // script update stok
                    $koneksi->query("UPDATE produk SET stok_produk=stok_produk -$jumlah WHERE id_produk='$id_produk'");
                }

                // mengkosongkan keranjang belanja

                unset($_SESSION["keranjang"]);

                //tampilan dialihkan ke halaman nota, nota dari pembelian yang terbaru
                echo "<script>alert('pembelian sukses');</script>";
                echo "<script>location='nota.php?id=$id_pembelian_terbaru';</script>";
            }
            ?>
        </div>
    </section>
    <!-- <pre>
        <?php print_r($_SESSION["keranjang"]); ?>
    </pre> -->
</body>
</html>