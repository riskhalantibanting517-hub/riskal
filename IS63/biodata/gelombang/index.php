<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Gelombang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/all.css">
</head>

<body style="background-color:#d1e6d4">

<?php include_once("../navbar.php"); ?>

<div class="container">
    <div class="row my-5">
        <div class="col-11 col-md-10 m-auto">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <b>📊 DATA GELOMBANG</b>
                    <a href="form_tambah.php" class="btn btn-light btn-sm">
                        <i class="fa-solid fa-plus"></i> Tambah Data
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle">
                            <thead class="table-success text-center">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Nama Gelombang</th>
                                    <th>Tahun</th>
                                    <th>Biaya Pendaftaran</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                            include_once("../koneksi.php");

                            $query  = "SELECT * FROM gelombang ORDER BY id DESC";
                            $result = mysqli_query($koneksi, $query);

                            if (mysqli_num_rows($result) > 0) {
                                $no = 1;
                                while ($data = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($data['biaya_pendaftaran']) ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-primary">
                                            <?= htmlspecialchars($data['tahun']) ?>
                                        </span>
                                    </td>

                                    <!-- ✅ BARIS 51 SUDAH DIPERBAIKI -->
                                    <td>
                                        Rp <?= number_format((int)$data['biaya_pendaftaran'], 0, ',', '.') ?>
                                    </td>

                                    <td class="text-center">
                                        <a href="formedit.php?id=<?= $data['id'] ?>" 
                                           class="btn btn-info btn-sm me-1">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <a href="proseshapus.php?id=<?= $data['id'] ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                }
                            } else {
                            ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        Data gelombang belum tersedia
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/all.js"></script>
</body>
</html>
