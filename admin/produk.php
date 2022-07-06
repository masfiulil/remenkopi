<h2>Data produk</h2>

<table class="table table-bordered" style="width: 100%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Foto</th>
            <th>Deskripsi</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <?php $query=$koneksi->query("SELECT * FROM produk" ); ?>
        <?php while($data = $query->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor++ ?></td>
            <td><?php echo $data['nama_produk'] ?></td>
            <td><?php echo $data['harga_produk'] ?></td>
            <td>
                <img src="fotoproduk/<?php echo $data['foto_produk'] ?>" width="100" >
            </td>
            <td><?php echo $data['deskripsi_produk'] ?></td>
            <td><?php echo $data['stok_produk'] ?></td>
            <td><a href="index.php?halaman=hapusproduk&id=<?php echo $data['id_produk'] ?>" class="btn btn-danger">Hapus</a>
                <a href="index.php?halaman=ubahproduk&id=<?php echo $data['id_produk'] ?>" class="btn btn-warning">Edit</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Data</a>