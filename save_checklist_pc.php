<?php
include 'db_connect.php';

// Set header untuk mengirimkan respon dalam format JSON
header('Content-Type: application/json');

// Tangkap data dari form dan lakukan validasi sederhana
$nomor_lab = isset($_POST['nomor_lab']) ? $_POST['nomor_lab'] : null;
$petugas1 = isset($_POST['petugas1']) ? $_POST['petugas1'] : null;
$petugas2 = isset($_POST['petugas2']) ? $_POST['petugas2'] : null;
$petugas3 = isset($_POST['petugas3']) ? $_POST['petugas3'] : null;
$tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : null;
$nomor_pc = isset($_POST['nomor_pc']) ? $_POST['nomor_pc'] : null;
$items = isset($_POST['item']) ? implode(",", $_POST['item']) : null; // Konversi array checkbox menjadi string
$keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : ''; // Tidak perlu implode jika bukan array

// Pastikan input yang wajib sudah terisi
if ($nomor_lab && $petugas1 && $tanggal && $nomor_pc && $items) {

    // Menggunakan prepared statements untuk keamanan dari SQL injection
    $stmt = $conn->prepare("INSERT INTO checklist_pc (nomor_lab, petugas1, petugas2, petugas3, tanggal, nomor_pc, items, keterangan) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Cek apakah statement berhasil dipersiapkan
    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Gagal mempersiapkan statement: ' . $conn->error]);
        exit();
    }
    
    // Bind parameter ke statement
    $stmt->bind_param("ssssssss", $nomor_lab, $petugas1, $petugas2, $petugas3, $tanggal, $nomor_pc, $items, $keterangan);

    // Eksekusi query dan cek apakah berhasil
    if ($stmt->execute()) {
        // Respons sukses
        echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
    } else {
        // Respons error jika terjadi masalah saat menyimpan data
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data: ' . $stmt->error]);
    }

    // Tutup statement
    $stmt->close();
    
} else {
    // Jika ada input yang tidak diisi, kirim pesan error
    echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap. Mohon lengkapi semua kolom wajib.']);
}

// Tutup koneksi database
$conn->close();
?>
