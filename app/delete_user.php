<?php
    include('../db/database.php');

    $id = $_GET['id'];
    $sql = ("DELETE FROM `users` WHERE id=$id LIMIT 1");
    $result = mysqli_query($conn, $sql);
    if($result){
        header("Location:../app/user.php");
    }else{
        echo "Error: ". $sql. "<br>". mysqli_error($conn);
    }
?>