<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Produk :</label>
        <input type="text" class="form-control" name="nama">
    </div>
    <div class="form-group">
        <label>Harga (Rp) :</label>
        <input type="text" class="form-control" name="harga">
    </div>
    <div class="form-group">
        <label>Foto :</label>
        <input type="file" class="form-control" name="foto">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label>Stok :</label>
        <input type="text" class="form-control" name="stok">
    </div>
    <button class="btn btn-primary" name="save">Simpan</button>
</form>
<?php
if (isset($_POST['save']))
{
    $nama = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasi, "fotoproduk/".$nama);
    $koneksi->query("INSERT INTO produk
        (nama_produk,harga_produk,foto_produk,deskripsi_produk,stok_produk)
        VALUES('$_POST[nama]','$_POST[harga]','$nama','$_POST[deskripsi]','$_POST[stok]')");
    echo "<div class='alert alert-info'>Data Tersimpan</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
}
?>

