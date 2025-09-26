<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: select.php'); exit;
}

$id     = intval($_POST['id'] ?? 0);
$name   = trim($_POST['name'] ?? '');
$email  = trim($_POST['email'] ?? '');
$age    = trim($_POST['age'] ?? '');
$course = trim($_POST['course'] ?? '');

if ($id <= 0) {
    $_SESSION['error'] = 'Invalid ID.';
    header('Location: select.php'); exit;
}
if ($name === '' || $email === '') {
    $_SESSION['error'] = 'Name and Email are required.';
    header('Location: select.php'); exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Invalid email format.';
    header('Location: select.php'); exit;
}

$stmt = $conn->prepare("UPDATE students SET name=?, email=?, age=NULLIF(?, ''), course=? WHERE id=?");
$stmt->bind_param('ssssi', $name, $email, $age, $course, $id);

if ($stmt->execute()) {
    $_SESSION['message'] = 'Student updated successfully.';
} else {
    $_SESSION['error'] = 'Update failed: ' . $stmt->error;
}
$stmt->close();

header('Location: select.php');
