<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: select.php'); exit;
}

$id = intval($_POST['id'] ?? 0);
if ($id <= 0) {
    $_SESSION['error'] = 'Invalid ID.';
    header('Location: select.php'); exit;
}

$stmt = $conn->prepare("DELETE FROM students WHERE id=?");
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    $_SESSION['message'] = 'Record deleted successfully.';
} else {
    $_SESSION['error'] = 'Delete failed: ' . $stmt->error;
}
$stmt->close();

header('Location: select.php');
