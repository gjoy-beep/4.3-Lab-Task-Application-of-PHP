<?php
$DB_HOST = 'localhost';
$DB_USER = 'student_user';
$DB_PASS = 'ThisIsAP@ssw0rd'; 
$DB_NAME = 'student_lab_crud_db';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>
