<h2>Detail Pembelian</h2>
<?php
$query= $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
    ON pembelian.id_pelanggan=pelanggan.id_pelanggan
    WHERE pembelian.id_pembelian='$_GET[id]'");
$detail=$query->fetch_assoc();
?>
<pre><?php print_r($detail); ?></pre>

<div class="row">
    <div class="col-md-4">
        <h3>Pembelian</h3>
        <strong>N0. Pembelian: <?php echo $detail['id_pembelian']; ?></strong><br>
        Tanggal: <?php echo $detail['tanggal_pembelian']; ?><br>
        Total: <?php echo $detail['total_pembelian']; ?>

    </div>
    <div class="col-md-4">
        <h3>Pelanggan</h3>
        <strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
        <p>
            Meja: <?php echo $detail['meja_pelanggan']; ?>
        </p>
    </div>
    <div class="col-md-4">
        <h3>Pembayaran</h3>
        <strong><?php echo $detail['metode']; ?></strong>
    </div>
</div>
<hr>
<table class="table table-bordered" style="width: 100%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga Produk</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <?php $query= $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
        <?php while($data = $query->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td>Rp. <?php echo number_format($data['harga']); ?></td>
            <td><?php echo $data['jumlah']; ?></td>
            <td>Rp. <?php echo number_format($data['subharga']); ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>