<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Siswa</title>
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
                    <b>📋 BIODATA SISWA</b>
                    <a href="form_tambah.php" class="btn btn-light btn-sm">
                        <i class="fa-solid fa-user-plus"></i> Tambah Data
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle">
                            <thead class="table-success text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                    <th>Jurusan</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include_once("../koneksi.php");

                                $qry = "SELECT 
                                            biodata.*, 
                                            biodata.id AS ids,
                                            jurusan.nama_jurusan
                                        FROM biodata
                                        INNER JOIN jurusan 
                                            ON biodata.jurusans_id = jurusan.id
                                        ORDER BY biodata.id DESC";

                                $tampil = mysqli_query($koneksi, $qry);

                                if(mysqli_num_rows($tampil) > 0){
                                    $nomor = 1;
                                    while($data = mysqli_fetch_assoc($tampil)){
                                ?>
                                <tr>
                                    <th class="text-center"><?= $nomor++ ?></th>
                                    <td><?= htmlspecialchars($data['nama']) ?></td>
                                    <td><?= htmlspecialchars($data['nisn']) ?></td>
                                    <td><?= htmlspecialchars($data['nama_jurusan']) ?></td>
                                    <td class="text-center"><?= date('d-m-Y', strtotime($data['tg_lahir'])) ?></td>
                                    <td class="text-center">
                                        <!-- Detail Modal Trigger -->
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#detail<?= $data['ids'] ?>">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>

                                        <!-- Edit -->
                                        <a href="formedit.php?id=<?= $data['ids'] ?>" class="btn btn-info btn-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <!-- Hapus Modal Trigger -->
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?= $data['ids'] ?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Detail -->
                                <div class="modal fade" id="detail<?= $data['ids'] ?>" tabindex="-1" aria-labelledby="detailLabel<?= $data['ids'] ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailLabel<?= $data['ids'] ?>">Detail <?= htmlspecialchars($data['nama']) ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center mb-3">
                                                    <img src="../fotosiswa/<?= $data['foto'] ?: 'default.png' ?>" height="150" class="rounded">
                                                </div>
                                                <table class="table table-sm">
                                                    <tr><td>Nama</td><td><?= htmlspecialchars($data['nama']) ?></td></tr>
                                                    <tr><td>NISN</td><td><?= htmlspecialchars($data['nisn']) ?></td></tr>
                                                    <tr><td>Jurusan</td><td><?= htmlspecialchars($data['nama_jurusan']) ?></td></tr>
                                                    <tr><td>Tempat Lahir</td><td><?= htmlspecialchars($data['tp_lahir']) ?></td></tr>
                                                    <tr><td>Tanggal Lahir</td><td><?= date('d-m-Y', strtotime($data['tg_lahir'])) ?></td></tr>
                                                    <tr><td>Alamat</td><td><?= htmlspecialchars($data['alamat']) ?></td></tr>
                                                    <tr><td>Email</td><td><?= htmlspecialchars($data['email']) ?></td></tr>
                                                    <tr><td>Jenis Kelamin</td><td><?= htmlspecialchars($data['jk']) ?></td></tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Hapus -->
                                <div class="modal fade" id="hapus<?= $data['ids'] ?>" tabindex="-1" aria-labelledby="hapusLabel<?= $data['ids'] ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="hapusLabel<?= $data['ids'] ?>">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data <strong><?= htmlspecialchars($data['nama']) ?></strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
