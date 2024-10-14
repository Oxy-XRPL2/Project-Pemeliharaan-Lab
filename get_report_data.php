<?php
include 'db_connect.php';

header('Content-Type: application/json');

$lab = isset($_GET['lab']) ? $_GET['lab'] : '';
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

$sql = "SELECT * FROM checklist_lab WHERE 1=1";

if (!empty($lab)) {
    $sql .= " AND lab = '$lab'";
}

if (!empty($startDate)) {
    $sql .= " AND tanggal >= '$startDate'";
}

if (!empty($endDate)) {
    $sql .= " AND tanggal <= '$endDate'";
}

$sql .= " ORDER BY tanggal DESC";

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

$conn->close();
?>