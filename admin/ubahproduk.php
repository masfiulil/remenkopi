<h2>Ubah Produk</h2>
<?php
$query = $koneksi->query("SELECT *FROM produk WHERE id_produk='$_GET[id]'");
$data = $query->fetch_assoc();

echo "<pre>";
print_r($query);
echo "</pre>";
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Produk</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $data['nama_produk']; ?>">
    </div>
    <div class="form-group">
        <label>Harga Rp</label>
        <input type="text" name="harga" class="form-control" value="<?php echo $data['harga_produk']; ?>">
    </div>
    <div class="form-group">
        <img src="fotoproduk/<?php echo $data['foto_produk']; ?>" width="200">
    </div>
    <div class="form-group">
        <label>Ganti Foto</label>
        <input type="file" name="foto" class="form-control">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" cols="30" rows="10">
        <?php echo $data['deskripsi_produk']; ?>
        </textarea>
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="text" name="stok" class="form-control" value="<?php echo $data['stok_produk']; ?>">
    </div>
    <button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php
if (isset($_POST['ubah']))
{
    $namafoto=$_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];
    //jika foto diubah
    if (!empty($lokasifoto))
    {
        move_uploaded_file($lokasifoto, "fotoproduk/$namafoto");

        $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
            harga_produk='$_POST[harga]',foto_produk='$namafoto', deskripsi_produk='$_POST[deskripsi]',stok_produk='$_POST[stok]'
            WHERE id_produk='$_GET[id]'");
    }
    else
    {
        $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
            harga_produk='$_POST[harga]',foto_produk='$_POST[foto]', deskripsi_produk='$_POST[deskripsi]',stok_produk='$_POST[stok]'
            WHERE id_produk='$_GET[id]'");
    }
    echo "<script>alert('data produk telah diubah');</script>";
    echo "<script>location='index.php?halaman=produk';</script>";
}
?>