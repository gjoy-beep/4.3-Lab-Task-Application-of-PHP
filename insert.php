<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: select.php'); exit;
}

$name   = trim($_POST['name'] ?? '');
$email  = trim($_POST['email'] ?? '');
$age    = trim($_POST['age'] ?? '');
$course = trim($_POST['course'] ?? '');

if ($name === '' || $email === '') {
    $_SESSION['error'] = 'Name and Email are required.';
    header('Location: select.php'); exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Invalid email format.';
    header('Location: select.php'); exit;
}

$stmt = $conn->prepare("INSERT INTO students (name,email,age,course) VALUES (?, ?, NULLIF(?, ''), ?)");
$stmt->bind_param('ssss', $name, $email, $age, $course);

if ($stmt->execute()) {
    $_SESSION['message'] = 'Student added successfully.';
} else {
    $_SESSION['error'] = 'Insert failed: ' . $stmt->error;
}
$stmt->close();

header('Location: select.php');
