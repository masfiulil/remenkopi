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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <title>Login Pelanggan</title>
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

    <div class="container mb-4 mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-tittle">Informasi Pelanggan</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label >Nama</label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label >Meja</label>
                                <input type="text" class="form-control" name="meja" required>
                            </div>
                            <br>
                            <a href="keranjang.php" class="btn btn-outline-dark">Kembali ke Keranjang</a>
                            <button class="btn btn-primary" name="simpan">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php
    //jika ada tombol simpan ditekan
    if (isset($_POST["simpan"]))
    {
        //simpan informasi pelanggan
        $koneksi->query("INSERT INTO pelanggan
            (nama_pelanggan,meja_pelanggan)
            VALUES('$_POST[nama]','$_POST[meja]')");
        $nama = $_POST["nama"];
        $meja = $_POST["meja"];
        //lakukan query mengecek akun di tabel pelanggan pada database
        $query=$koneksi->query("SELECT * FROM pelanggan
            WHERE nama_pelanggan='$nama' AND meja_pelanggan='$meja' ");

        //menghitung akun yg diambil
        $akunyangcocok = $query->num_rows;

        //jika 1 akun yang cocok, maka diloginkan
        if ($akunyangcocok==1)
        {
            //anda sudah login
            //mendapatkan akun untuk login
            $akun = $query->fetch_assoc();
            //simpan di session pelanggan
            $_SESSION["pelanggan"] = $akun;
            echo "<script>alert('Data nomor meja telah disimpan');</script>";
            echo "<script>location='checkout.php'</script>";
        }
        else
        {
            //anda gagal login
            echo "<script>alert('Maaf meja telah penuh terisi');</script>";
            echo "<script>location='login.php'</script>";
        }
    }

    ?>
</body>
</html>