<?php
session_start();
require 'db_connect.php';

// Flash messages
$message = $_SESSION['message'] ?? null;
$error   = $_SESSION['error'] ?? null;
unset($_SESSION['message'], $_SESSION['error']);

// Always sort alphabetically by name
$sql = "SELECT * FROM students ORDER BY name ASC";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Students - CRUD</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #ffafbd, #ffc3a0); /* soft pastel gradient */
      min-height: 100vh;
    }
    .card {
      border-radius: 1rem;
      box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    h2 {
      font-family: 'Comic Sans MS', cursive, sans-serif;
      color: #ff4b5c;
    }
    .btn-primary {
      background-color: #ff4b5c;
      border: none;
    }
    .btn-primary:hover {
      background-color: #ff2e44;
    }
    .btn-back {
      background-color: #6c63ff;
      border: none;
    }
    .btn-back:hover {
      background-color: #5848e6;
    }
  </style>
</head>
<body>
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>🎀 Student Records</h2>
    <div>
      <a href="index.php" class="btn btn-back me-2">< Back</a>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">＋ Add Student</button>
    </div>
  </div>

  <?php if ($message): ?>
    <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
  <?php endif; ?>
  <?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
          <thead class="table-danger">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Age</th>
              <th>Course</th>
              <th>Registered</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                  <td><?= $row['id'] ?></td>
                  <td><?= htmlspecialchars($row['name']) ?></td>
                  <td><?= htmlspecialchars($row['email']) ?></td>
                  <td><?= $row['age'] ?? '-' ?></td>
                  <td><?= htmlspecialchars($row['course'] ?? '-') ?></td>
                  <td><?= $row['created_at'] ?></td>
                  <td>
                    <button class="btn btn-sm btn-outline-secondary btn-edit"
                      data-id="<?= $row['id'] ?>"
                      data-name="<?= htmlspecialchars($row['name'], ENT_QUOTES) ?>"
                      data-email="<?= htmlspecialchars($row['email'], ENT_QUOTES) ?>"
                      data-age="<?= $row['age'] ?>"
                      data-course="<?= htmlspecialchars($row['course'], ENT_QUOTES) ?>"
                      data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>

                    <button class="btn btn-sm btn-outline-danger btn-delete"
                      data-id="<?= $row['id'] ?>"
                      data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr><td colspan="7" class="text-center">No records found 🎓</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="insert.php" novalidate>
        <div class="modal-header">
          <h5 class="modal-title">Add Student ✨</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" type="text" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Age</label>
            <input name="age" type="number" class="form-control" min="0">
          </div>
          <div class="mb-3">
            <label class="form-label">Course</label>
            <input name="course" type="text" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="update.php" novalidate>
        <div class="modal-header">
          <h5 class="modal-title">Edit Student 🎀</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="edit-id">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input id="edit-name" name="name" type="text" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input id="edit-email" name="email" type="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Age</label>
            <input id="edit-age" name="age" type="number" class="form-control" min="0">
          </div>
          <div class="mb-3">
            <label class="form-label">Course</label>
            <input id="edit-course" name="course" type="text" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form method="post" action="delete.php">
        <div class="modal-header">
          <h5 class="modal-title">Confirm Delete ❌</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="delete-id">
          <p>Are you sure you want to delete this record?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.btn-edit').forEach(btn => {
  btn.addEventListener('click', () => {
    document.getElementById('edit-id').value = btn.dataset.id;
    document.getElementById('edit-name').value = btn.dataset.name;
    document.getElementById('edit-email').value = btn.dataset.email;
    document.getElementById('edit-age').value = btn.dataset.age;
    document.getElementById('edit-course').value = btn.dataset.course;
  });
});

document.querySelectorAll('.btn-delete').forEach(btn => {
  btn.addEventListener('click', () => {
    document.getElementById('delete-id').value = btn.dataset.id;
  });
});
</script>
</body>
</html>
