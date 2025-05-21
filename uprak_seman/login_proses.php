<?php
session_start();
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validasi sederhana
    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = "Email dan kata sandi wajib diisi.";
        header('Location: login.php');
        exit;
    }

    // Prepare statement untuk mencegah SQL injection
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        // Asumsi password di DB sudah hashed dengan password_hash()
        if (password_verify($password, $user['password'])) {
            // Login sukses, set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['success'] = "Login berhasil, selamat datang!";
            header('Location: index.php');
            exit;
        } else {
            $_SESSION['login_error'] = "Password salah.";
        }
    } else {
        $_SESSION['login_error'] = "User tidak ditemukan.";
    }
} else {
    $_SESSION['login_error'] = "Metode request tidak valid.";
}

header('Location: login.php');
exit;
