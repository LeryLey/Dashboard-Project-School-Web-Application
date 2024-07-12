<?php
    // establish database connection
    $conn = mysqli_connect("localhost", "root", "", "assignment");
    // check connection
    if (!$conn) {
        die("Connection failed: ". mysqli_connect_error());
    }
      
?>