<?php

require 'connect.php';

if($_SERVER['REQUEST_METHOD'] == "POST");
    $id = $_POST['id'];
    $qeuery = "DELETE FROM todos WHERE id = $id";

    if (mysqli_query($connect, $qeuery)) {
        echo "<meta http-equiv='refresh' content='1;url=index.php'>";
    }else{
        echo mysqli_error($connect);
        echo "<meta http-equiv='refresh' content='5;url=index.php'>";
    }