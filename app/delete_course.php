<?php
include('../db/database.php');

$id = $_GET['id'];

// Begin transaction
mysqli_begin_transaction($conn);

try {
    // Delete dependent rows in course_professors table
    $sql1 = "DELETE FROM `course_professors` WHERE course_id = $id";
    if (!mysqli_query($conn, $sql1)) {
        throw new Exception("Error deleting from course_professors: " . mysqli_error($conn));
    }

    // Delete row in courses table
    $sql2 = "DELETE FROM `courses` WHERE course_id = $id LIMIT 1";
    if (!mysqli_query($conn, $sql2)) {
        throw new Exception("Error deleting from courses: " . mysqli_error($conn));
    }
    // Commit transaction
    mysqli_commit($conn);
    header("Location: ../app/course.php");
} catch (Exception $e) {
    // Rollback transaction
    mysqli_rollback($conn);
    echo $e->getMessage();
}

// Close connection
mysqli_close($conn);
?>
