<?php
include 'db_connect.php';

// Pastikan semua variabel POST sudah diterima dan divalidasi
$nomor_lab = isset($_POST['nomor_lab']) ? $_POST['nomor_lab'] : null;
$petugas1 = isset($_POST['petugas1']) ? $_POST['petugas1'] : null;
$petugas2 = isset($_POST['petugas2']) ? $_POST['petugas2'] : null;
$petugas3 = isset($_POST['petugas3']) ? $_POST['petugas3'] : null;
$tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : null;
$nomor_pc = isset($_POST['nomor_pc']) ? $_POST['nomor_pc'] : null;
$items = isset($_POST['item']) ? implode(",", $_POST['item']) : null; // Konversi array ke string
$keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : null;

// Pastikan semua data yang wajib diisi sudah terisi
if ($nomor_lab && $petugas1 && $tanggal && $nomor_pc && $items) {

    // Menggunakan prepared statements untuk keamanan
    $stmt = $conn->prepare("INSERT INTO checklist_pc (nomor_lab, petugas1, petugas2, petugas3, tanggal, nomor_pc, items, keterangan) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("ssssssss", $nomor_lab, $petugas1, $petugas2, $petugas3, $tanggal, $nomor_pc, $items, $keterangan);

    // Eksekusi dan cek apakah berhasil
    if ($stmt->execute()) {
        // Mengirim respon sukses ke JavaScript
        echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
    } else {
        // Mengirim respon error ke JavaScript jika terjadi kesalahan
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data: ' . $stmt->error]);
    }

    // Tutup statement
    $stmt->close();
    
} else {
    // Jika ada input yang tidak diisi, kirim pesan error ke JavaScript
    echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap. Mohon lengkapi semua kolom wajib.']);
}

// Tutup koneksi database
$conn->close();
?>
