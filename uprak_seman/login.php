<?php
session_start();
$error = $_SESSION['login_error'] ?? '';
$success = $_SESSION['success'] ?? '';
unset($_SESSION['login_error'], $_SESSION['success']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Login | MyTodo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-dark text-light">

<div class="container" style="min-height:90vh; display:flex; align-items:center; justify-content:center;">
  <div class="card bg-secondary text-light p-4 shadow" style="width: 400px;">
    <h3 class="text-center mb-4">Masuk ke MyTodo</h3>

    <?php if ($error): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form action="login_proses.php" method="POST" novalidate>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required autofocus>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Masuk</button>
    </form>
    <p class="mt-3 text-center">Belum punya akun? <a href="register.php" class="text-info">Daftar di sini</a></p>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
