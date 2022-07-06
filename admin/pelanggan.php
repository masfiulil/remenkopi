<h2>Data Pelanggan</h2>

<table class="table table-bordered" style="width: 100%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>No Meja</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <?php $query=$koneksi->query("SELECT * FROM pelanggan" ); ?>
        <?php while($data = $query->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo $data['nama_pelanggan']; ?></td>
            <td><?php echo $data['meja_pelanggan']; ?></td>
            <td><button type="button" class="btn btn-danger">Hapus</button>
                <button type="button" class="btn btn-warning">Edit</button>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>