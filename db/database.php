<?php
    // establish database connection
    $conn = mysqli_connect("localhost", "root", "", "c101");
    // check connection
    if (!$conn) {
        die("Connection failed: ". mysqli_connect_error());
    }
      
?>