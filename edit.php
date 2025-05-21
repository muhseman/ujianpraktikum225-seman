<?php
require 'connect.php';

$id = $_GET['id'];
$query = "SELECT * FROM todos WHERE id = $id";
$result = mysqli_query($connect, $query);
$show = mysqli_fetch_assoc($result);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Data</title>
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
    .btn-outline-light-custom {
      background-color: transparent;
      border: 1px solid #F9F7F7;
      color: #F9F7F7;
    }
    .btn-outline-light-custom:hover {
      background-color: #F9F7F7;
      color: #112D4E;
    }
    .card {
      background-color: #DBE2EF;
      border-radius: 0.5rem;
      box-shadow: 0 0 10px rgba(17, 45, 78, 0.1);
    }
    .form-label {
      font-weight: 600;
      color: #112D4E;
    }
    input.form-control {
      background-color: #fff;
      color: #112D4E;
      border: 1px solid #ccc;
    }
    input.form-control:focus {
      border-color: #3F72AF;
      box-shadow: 0 0 5px #3F72AF;
      outline: none;
    }
    .btn-submit {
      background-color: #3F72AF;
      color: #F9F7F7;
      border: none;
    }
    .btn-submit:hover {
      background-color: #2f5e90;
      color: #F9F7F7;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-custom mb-4 shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="index.php">MyTodo</a>
      <div class="ms-auto">
        <a href="index.php" class="btn btn-outline-light-custom">Kembali</a>
      </div>
    </div>
  </nav>

  <div class="container d-flex justify-content-center align-items-start">
    <div class="col-md-6">
      <div class="card p-4">
        <h3 class="mb-4 text-center">Edit Data Todo</h3>
        <form action="edit_proses.php" method="POST">
          <input type="hidden" name="id" value="<?= htmlspecialchars($show['id']) ?>" />
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" id="title" name="title" class="form-control" required value="<?= htmlspecialchars($show['title']) ?>" />
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" id="description" name="description" class="form-control" required value="<?= htmlspecialchars($show['description']) ?>" />
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-submit">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
