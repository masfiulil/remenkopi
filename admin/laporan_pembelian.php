<?php
$semuadata=array();
$tgl_mulai="-";
$tgl_selesai="-";
if (isset($_POST["kirim"]))
{
    $tgl_mulai = $_POST["tglm"];
    $tgl_selesai = $_POST["tgls"];
    $query = $koneksi->query("SELECT * FROM pembelian LEFT JOIN pelanggan ON
        pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
    while($data = $query->fetch_assoc())
    {
        $semuadata[]=$data;
    }
}
?>
<h2>Laporan Pembelian dari <?php echo $tgl_mulai; ?> hingga <?php echo $tgl_selesai; ?></h2>
<hr>

<form method="post">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label>Tanggal Mulai</label>
                <input type="date" class="form-control" name="tglm">
            </div>
        </div>
        <div class="col-md-5">
        <div class="form-group">
                <label>Tanggal Selesai</label>
                <input type="date" class="form-control" name="tgls">
            </div>
        </div>
        <div class="col-md-2">
            <br>
            <button class="btn btn-primary" name="kirim">Lihat</button>
        </div>
    </div>
</form>
<br><br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Metode</th>
        </tr>
    </thead>
    <tbody>
        <?php $total=0;?>
        <?php foreach ($semuadata as $key => $value): ?>
        <?php $total+=$value['total_pembelian'];?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $value["nama_pelanggan"]; ?></td>
            <td><?php echo $value["tanggal_pembelian"]; ?></td>
            <td>Rp. <?php echo number_format($value["total_pembelian"]); ?></td>
            <td><?php echo $value["metode"]; ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">Total</th>
            <th>Rp. <?php echo number_format($total); ?></th>
        </tr>
    </tfoot>
</table>