<?php
    // include database
    include("../db/database.php");
    $id = $_GET['id'];
    $sql = "DELETE FROM employees WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    unlink('../img'.$photo);
    if($result){
        header("Location:../app/employees.php");
    }else{
        echo "Error: ". $sql. "<br>". mysqli_error($conn);
    }
?>