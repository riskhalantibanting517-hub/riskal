<?php
include("../koneksi.php");

// Ambil data dari form
$id           = $_POST['id'];
$nama         = $_POST['nama'];
$nisn         = $_POST['nisn'];
$tp_lahir     = $_POST['tp_lahir'];
$gelombang_id = $_POST['gelombang_id'];

// Data foto
$nama_foto = $_FILES['foto']['name'];
$tmp_foto  = $_FILES['foto']['tmp_name'];

// Jika foto diubah
if ($nama_foto != "") {

    // Ambil foto lama
    $qry = mysqli_query($koneksi, "SELECT foto FROM data WHERE id='$id'");
    $data = mysqli_fetch_assoc($qry);

    // Hapus foto lama
    if ($data['foto'] != "" && file_exists("../fotosiswa/" . $data['foto'])) {
        unlink("../fotosiswa/" . $data['foto']);
    }

    // Upload foto baru
    move_uploaded_file($tmp_foto, "../fotosiswa/" . $nama_foto);

    // Update dengan foto
    $query = "UPDATE data SET
                nama='$nama',
                nisn='$nisn',
                tp_lahir='$tp_lahir',
                gelombang_id='$gelombang_id',
                foto='$nama_foto'
              WHERE id='$id'";

} else {

    // Update tanpa foto
    $query = "UPDATE data SET
                nama='$nama',
                nisn='$nisn',
                tp_lahir='$tp_lahir',
                gelombang_id='$gelombang_id'
              WHERE id='$id'";
}

// Eksekusi query
$update = mysqli_query($koneksi, $query);

// Cek hasil
if ($update) {
    header("Location: index.php");
    exit;
} else {
    echo "Data gagal diupdate: " . mysqli_error($koneksi);
}
?>
