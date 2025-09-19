<?php
session_start();

if (!isset($_SESSION['user']) || $_GET['view'] !== 'details') {
    echo "No user data found.";
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-info text-white text-center">
                        <h4>Registered User Profile</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></li>
                            <li class="list-group-item"><strong>Age:</strong> <?= htmlspecialchars($user['age']) ?></li>
                            <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></li>
                        </ul>
                        <a href="index.php" class="btn btn-secondary mt-3 w-100">Back to Registration</a>
                    </div>
                    <div class="card-footer text-muted text-center">
                        Mini Registration + Display
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
