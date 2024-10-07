<?php
include 'db_connect.php';

// Set header untuk JSON response
header('Content-Type: application/json');

// Tangkap data dari form
$lab = $_POST['lab'];
$petugas1 = $_POST['petugas1'];
$petugas2 = $_POST['petugas2'];
$petugas3 = $_POST['petugas3'];
$tanggal = $_POST['tanggal'];

$komputer_baik = $_POST['komputer_baik'];
$komputer_rusak = $_POST['komputer_rusak'];
$komputer_total = $_POST['komputer_total'];
$komputer_keterangan = $_POST['komputer_keterangan'];

$monitor_baik = $_POST['monitor_baik'];
$monitor_rusak = $_POST['monitor_rusak'];
$monitor_total = $_POST['monitor_total'];
$monitor_keterangan = $_POST['monitor_keterangan'];

$cpu_baik = $_POST['cpu_baik'];
$cpu_rusak = $_POST['cpu_rusak'];
$cpu_total = $_POST['cpu_total'];
$cpu_keterangan = $_POST['cpu_keterangan'];

$keyboard_baik = $_POST['keyboard_baik'];
$keyboard_rusak = $_POST['keyboard_rusak'];
$keyboard_total = $_POST['keyboard_total'];
$keyboard_keterangan = $_POST['keyboard_keterangan'];

$mouse_baik = $_POST['mouse_baik'];
$mouse_rusak = $_POST['mouse_rusak'];
$mouse_total = $_POST['mouse_total'];
$mouse_keterangan = $_POST['mouse_keterangan'];

$kabel_baik = $_POST['kabel_baik'];
$kabel_rusak = $_POST['kabel_rusak'];
$kabel_total = $_POST['kabel_total'];
$kabel_keterangan = $_POST['kabel_keterangan'];

// Buat query SQL untuk menyimpan data ke database
$sql = "INSERT INTO checklist_lab (lab, petugas1, petugas2, petugas3, tanggal, komputer_baik, komputer_rusak, komputer_total, komputer_keterangan, monitor_baik, monitor_rusak, monitor_total, monitor_keterangan, cpu_baik, cpu_rusak, cpu_total, cpu_keterangan, keyboard_baik, keyboard_rusak, keyboard_total, keyboard_keterangan, mouse_baik, mouse_rusak, mouse_total, mouse_keterangan, kabel_baik, kabel_rusak, kabel_total, kabel_keterangan)
        VALUES ('$lab', '$petugas1', '$petugas2', '$petugas3', '$tanggal', '$komputer_baik', '$komputer_rusak', '$komputer_total', '$komputer_keterangan', '$monitor_baik', '$monitor_rusak', '$monitor_total', '$monitor_keterangan', '$cpu_baik', '$cpu_rusak', '$cpu_total', '$cpu_keterangan', '$keyboard_baik', '$keyboard_rusak', '$keyboard_total', '$keyboard_keterangan', '$mouse_baik', '$mouse_rusak', '$mouse_total', '$mouse_keterangan', '$kabel_baik', '$kabel_rusak', '$kabel_total', '$kabel_keterangan')";

if ($conn->query($sql) === TRUE) {
    // Jika sukses, kirimkan respons sukses dalam bentuk JSON
    echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
} else {
    // Jika gagal, kirimkan respons error
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
}

// Tutup koneksi
$conn->close();
?>
