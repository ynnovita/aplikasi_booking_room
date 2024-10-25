<div class="container">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="text-center">Laporan Transaksi</h1>
                <hr>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>Meja</th>
                            <th>Status</th>
                            <th>Total Bayar</th>
                        </tr>
                    </thead>
                    <tbody id="laporan_trx">
                        <?php
                        $no = 1;
                        if (mysqli_num_rows($data) > 0) {
                            while ($item = mysqli_fetch_array($data)) {
                        ?>
                                <tr>
                                    <td style="width: 10%;"><?= $no++ ?></td>

                                    <td><?= $item['tgl_transaksi'] ?></td>
                                    <td><?= $item['no_transaksi'] ?></td>
                                    <td><?= $item['no_meja'] ?> (<?= $item['jenis_meja'] ?>) </td>
                                    <td>
                                        <?php if ($item['status'] == "proses") { ?>
                                            <span class="badge badge-warning">Sedang Di Proses</span>
                                        <?php } else { ?>
                                            <span class="badge badge-success">Selesai</span>
                                        <?php } ?>
                                    </td>
                                    <td>Rp.<?= number_format($item['jumlah_bayar']) ?>.00,-</td>
                                </tr>
                        <?php
                            }
                        }else{
                            ?>
                            <tr>
                                <td colspan="100%" class="text-center text-muted">Tidak Ada Data</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-9"></div>
                    <div class="col-sm-3 text-center">
                        <br>
                        <br>
                        <p>
                            Karangploso, ....
                            <br>
                            <br>
                            <br>
                            ................
                        </p>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.print();
</script>