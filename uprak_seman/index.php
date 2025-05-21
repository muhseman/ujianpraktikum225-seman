<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require 'connect.php';

$query = "SELECT * FROM todos";
$results = mysqli_query($connect, $query);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Todo List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #F9F7F7;
      color: #112D4E;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
    }
    .navbar-custom {
      background-color: #112D4E;
    }
    .navbar-custom .navbar-brand,
    .navbar-custom .btn {
      color: #F9F7F7;
    }
    .btn-accent {
      background-color: #3F72AF;
      color: #F9F7F7;
      border: none;
      transition: background-color 0.3s ease;
    }
    .btn-accent:hover {
      background-color: #2f5e90;
      color: #F9F7F7;
    }
    .btn-outline-light-custom {
      background-color: transparent;
      border: 1px solid #F9F7F7;
      color: #F9F7F7;
      transition: background-color 0.3s ease, color 0.3s ease;
    }
    .btn-outline-light-custom:hover {
      background-color: #F9F7F7;
      color: #112D4E;
      text-decoration: none;
    }
    .card {
      background-color: #DBE2EF;
      border-radius: 0.5rem;
      box-shadow: 0 0 10px rgba(17, 45, 78, 0.1);
    }
    table thead {
      background-color: #3F72AF;
      color: #F9F7F7;
    }
    .btn-warning {
      background-color: #F9A826;
      border: none;
      color: #112D4E;
    }
    .btn-warning:hover {
      background-color: #c27806;
      color: #FFF;
    }
    .btn-danger {
      background-color: #D7263D;
      border: none;
      color: #FFF;
    }
    .btn-danger:hover {
      background-color: #9b1b2d;
      color: #FFF;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-custom mb-4 shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#">MyTodo</a>
      <div class="ms-auto">
        <a href="logout.php" class="btn btn-outline-light-custom">Logout</a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>Todo List</h2>
      <a href="tambah.php" class="btn btn-accent">Tambah Todo</a>
    </div>

    <div class="card shadow">
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>Title</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($results) > 0): 
                $no = 1;
                while ($show = mysqli_fetch_assoc($results)): ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= htmlspecialchars($show['title']) ?></td>
                    <td><?= htmlspecialchars($show['description']) ?></td>
                    <td>
                      <a href="edit.php?id=<?= $show['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                      <form action="hapus_proses.php" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                        <input type="hidden" name="id" value="<?= $show['id'] ?>" />
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                      </form>
                    </td>
                  </tr>
              <?php 
                $no++;
                endwhile; 
              else: ?>
                <tr>
                  <td colspan="4" class="text-center text-danger">Data Tidak Ada</td>
                </tr>
              <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
