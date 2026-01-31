<?php
include_once("../koneksi.php");

$idedit = $_GET['id'];
$qry = "SELECT * FROM data WHERE id='$idedit'";
$edit = mysqli_query($koneksi, $qry);
$data = mysqli_fetch_assoc($edit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Biodata Siswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color:#d1e6d4">

<?php include_once("../navbar.php"); ?>

<div class="container">
    <div class="row my-5">
        <div class="col-8 m-auto">
            <div class="card shadow">
                <div class="card-header">
                    <b>FORM EDIT BIODATA SISWA</b>
                </div>

                <div class="card-body">
                    <form action="proses_edit.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="id" value="<?= $data['id'] ?>">

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control"
                                   value="<?= $data['nama'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NISN</label>
                            <input type="text" name="nisn" class="form-control"
                                   value="<?= $data['nisn'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="tp_lahir" class="form-control"
                                   value="<?= $data['tp_lahir'] ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gelombang</label>
                            <select name="gelombang_id" class="form-select" required>
                                <option value="">-- Pilih Gelombang --</option>
                                <?php
                                $qry_gel = "SELECT * FROM gelombang";
                                $data_gel = mysqli_query($koneksi, $qry_gel);
                                while ($gel = mysqli_fetch_assoc($data_gel)) {
                                ?>
                                    <option value="<?= $gel['id'] ?>"
                                        <?= $data['gelombang_id'] == $gel['id'] ? 'selected' : '' ?>>
                                        <?= $gel['nama_gelombang'] ?> - <?= $gel['tahun'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="index.php" class="btn btn-secondary">Kembali</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
