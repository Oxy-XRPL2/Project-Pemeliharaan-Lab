<?php
include 'db_connect.php';

$lab = $_POST['lab'];
$petugas1 = $_POST['petugas1'];
$petugas2 = $_POST['petugas2'];
$petugas3 = $_POST['petugas3'];
$tanggal = $_POST['tanggal'];
$komputer_baik = $_POST['komputer_baik'];
$komputer_rusak = $_POST['komputer_rusak'];
$komputer_total = $_POST['komputer_total'];
$komputer_keterangan = $_POST['komputer_keterangan'];
// Tambahkan data lainnya...

$sql = "INSERT INTO checklist_lab (lab, petugas1, petugas2, petugas3, tanggal, komputer_baik, komputer_rusak, komputer_total, komputer_keterangan, monitor_baik, monitor_rusak, monitor_total, monitor_keterangan, cpu_baik, cpu_rusak, cpu_total, cpu_keterangan, keyboard_baik, keyboard_rusak, keyboard_total, keyboard_keterangan, mouse_baik, mouse_rusak, mouse_total, mouse_keterangan, kabel_baik, kabel_rusak, kabel_total, kabel_keterangan)
        VALUES ('$lab', '$petugas1', '$petugas2', '$petugas3', '$tanggal', '$komputer_baik', '$komputer_rusak', '$komputer_total', '$komputer_keterangan', '$monitor_baik', '$monitor_rusak', '$monitor_total', '$monitor_keterangan', '$cpu_baik', '$cpu_rusak', '$cpu_total', '$cpu_keterangan', '$keyboard_baik', '$keyboard_rusak', '$keyboard_total', '$keyboard_keterangan', '$mouse_baik', '$mouse_rusak', '$mouse_total', '$mouse_keterangan', '$kabel_baik', '$kabel_rusak', '$kabel_total', '$kabel_keterangan')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
