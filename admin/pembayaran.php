<h2>Data Pembayaran</h2>

<?php

//mendapatkan id pembelian dari url
$id_pembelian = $_GET['id'];

//mengambil data pembayaran dari id pembelian
$query = $koneksi->query("SELECT *FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$detail = $query->fetch_assoc();

echo "<pre>";
print_r($detail);
echo "</pre>";
?>

<div class="row">
    <div class="col-md-6">
        <table class="table">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?php echo $detail['nama']; ?></td>
            </tr>
            <tr>
                <td>Metode</td>
                <td>:</td>
                <td><?php echo $detail['metode']; ?></td>
            </tr>
            <tr>
                <td>Jumlah</td>
                <td>:</td>
                <td><?php echo $detail['jumlah']; ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><?php echo $detail['tanggal']; ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
    <img src="../bukti_pembayaran/<?php echo $detail['bukti']; ?>" width="200" alt="" class="img-responsive">
    </div>
</div>