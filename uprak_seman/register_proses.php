<?php
session_start();
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    $error = [];
    $old = ['fullname' => $fullname, 'email' => $email];

    // Validasi sederhana
    if (!$fullname) $error['fullname'] = "Nama lengkap wajib diisi.";
    if (!$email) $error['email'] = "Email wajib diisi.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $error['email'] = "Email tidak valid.";
    if (!$password) $error['password'] = "Password wajib diisi.";
    elseif (strlen($password) < 6) $error['password'] = "Password minimal 6 karakter.";
    if ($password !== $password_confirm) $error['password_confirm'] = "Konfirmasi password tidak cocok.";

    // Cek email sudah terdaftar?
    $stmt = $connect->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $error['email'] = "Email sudah terdaftar.";
    }
    $stmt->close();

    if ($error) {
        $_SESSION['error'] = $error;
        $_SESSION['old'] = $old;
        header("Location: register.php");
        exit();
    }

    // Hash password & simpan ke DB
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $connect->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullname, $email, $password_hash);
    if ($stmt->execute()) {
        $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['error'] = ['general' => "Terjadi kesalahan, coba lagi."];
        $_SESSION['old'] = $old;
        header("Location: register.php");
        exit();
    }
} else {
    header("Location: register.php");
    exit();
}
