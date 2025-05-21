<?php

require  'connect.php';

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST['id'];
    $title = $_POST ['title'];
    $description = $_POST ['description'];

    $query = "UPDATE todos SET title='$title',description='$description' WHERE id = $id";

    if (mysqli_query($connect, $query)) {
        echo "<meta http-equiv='refresh' content='1;url=index.php'>";
    }else{
        echo mysqli_error($connect);
        echo "<meta http-equiv='refresh' content='5;url=edit.php?id=$id'>";
    }
}

?>