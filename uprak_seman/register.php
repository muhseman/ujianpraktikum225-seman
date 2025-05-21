<?php
session_start();
$error = $_SESSION['error'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['error'], $_SESSION['old']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Register | MyTodo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-dark text-light">

<div class="container" style="min-height:90vh; display:flex; align-items:center; justify-content:center;">
  <div class="card bg-secondary text-light p-4 shadow" style="width: 400px;">
    <h3 class="text-center mb-4">Daftar Akun Baru</h3>
    <form action="register_proses.php" method="POST" novalidate>

      <div class="mb-3">
        <label for="fullname" class="form-label">Nama Lengkap</label>
        <input type="text" name="fullname" class="form-control" value="<?= htmlspecialchars($old['fullname'] ?? '') ?>" required>
        <?php if(isset($error['fullname'])): ?>
          <small class="text-danger"><?= htmlspecialchars($error['fullname']) ?></small>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
        <?php if(isset($error['email'])): ?>
          <small class="text-danger"><?= htmlspecialchars($error['email']) ?></small>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Kata Sandi</label>
        <input type="password" name="password" class="form-control" required>
        <?php if(isset($error['password'])): ?>
          <small class="text-danger"><?= htmlspecialchars($error['password']) ?></small>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="password_confirm" class="form-label">Konfirmasi Kata Sandi</label>
        <input type="password" name="password_confirm" class="form-control" required>
        <?php if(isset($error['password_confirm'])): ?>
          <small class="text-danger"><?= htmlspecialchars($error['password_confirm']) ?></small>
        <?php endif; ?>
      </div>

      <button type="submit" class="btn btn-primary w-100">Daftar</button>
    </form>
    <p class="mt-3 text-center">Sudah punya akun? <a href="login.php" class="text-info">Masuk di sini</a></p>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
