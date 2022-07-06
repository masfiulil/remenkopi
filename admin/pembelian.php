<h2>Data Pembelian</h2>

<table class="table table-bordered" style="width: 100%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pembeli</th>
            <th>Tanggal Pembelian</th>
            <th>Total Pembelian</th>
            <th>Metode Pembayaran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <?php $query=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan" ); ?>
        <?php while($data = $query->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo $data['nama_pelanggan']; ?></td>
            <td><?php echo $data['tanggal_pembelian']; ?></td>
            <td><?php echo $data['total_pembelian']; ?></td>
            <td><?php echo $data['metode']; ?></td>
            <td><a href="index.php?halaman=detail&id=<?php echo $data['id_pembelian'] ?>" class="btn btn-info">Detail</a>
                <a href="index.php?halaman=pembayaran&id=<?php echo $data['id_pembelian'] ?>" class="btn btn-success">Pembayaran</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>