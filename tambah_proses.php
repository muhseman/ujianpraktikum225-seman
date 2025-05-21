<?php

require "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars($_POST["title"] ?? '');
    $description = htmlspecialchars($_POST["description"] ?? '');

    $query = "INSERT INTO todos (title, description) VALUES ('$title', '$description')";
    $result = mysqli_query($connect, $query);

    if ($result) {
        echo "Data berhasil ditambahkan.";
        echo "<meta http-equiv='refresh' content='1;url=index.php'>";
    } else {
        echo "Error: " . mysqli_error($connect);
    }

    mysqli_close($connect);
}
?>
