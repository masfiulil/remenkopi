<?php

$query = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$data = $query->fetch_assoc();
$fotoproduk = $data['foto_produk'];
if (file_exists("fotoproduk/$fotoproduk"))
{
    unlink("fotoproduk/$fotoproduk");
}


$hapus = $koneksi->query("DELETE FROM produk WHERE id_produk='$_GET[id]'");

echo "<script>alert('produk terhapus');</script>";
echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
?>


