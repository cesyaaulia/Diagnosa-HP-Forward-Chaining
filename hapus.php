<?php
require 'config.php';

if (!isset($_POST['id'])) {
    echo "Invalid Request";
    exit;
}

$id = intval($_POST['id']);

$stmt = $conn->prepare("DELETE FROM konsultasi WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: riwayat.php");
exit;
?>
