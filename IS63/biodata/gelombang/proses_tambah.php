<?php
    // 1. Koneksi ke MySQL
    include("../koneksi.php");

    // 2. Mengambil value dari form
    $biaya_pendaftaran = $_POST['biaya_pendaftaran'];
    $tahun = $_POST['tahun'];

    // 3. Query Insert (perbaikan: hapus koma & variabel konsisten)
    $query = "INSERT INTO gelombang (biaya_pendaftaran, tahun) 
              VALUES ('$biaya_pendaftaran', '$tahun')";

    // 4. Eksekusi query
    $tambah = mysqli_query($koneksi, $query);

    // 5. Cek hasil
    if ($tambah) {
        header("Location: index.php");
        exit;
    } else {
        echo "Data gagal ditambahkan: " . mysqli_error($koneksi);
    }
?>
