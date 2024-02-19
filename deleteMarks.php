<?php
// deleteMarks.php

$servername = "localhost";
$username = "root";
$password = "";
$database = "student_management";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection Failed: " . $connection->connect_error);
}

if (isset($_GET['usn']) && isset($_GET['course_id'])) {
    $usn = $_GET['usn'];
    $course_id = $_GET['course_id'];

    // Use prepared statement to prevent SQL injection
    $stmt = $connection->prepare("DELETE FROM marks WHERE usn = ? AND course_id = ?");
    $stmt->bind_param("ss", $usn, $course_id); // Assuming usn and course_id are strings. Change the "s" if they are another type.

    if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
        // User has confirmed the deletion
        if ($stmt->execute()) {
            echo "Marks deleted successfully.";
            $stmt->close();
            $connection->close();
            header("Location: marks.php"); // Redirect to marks list page
            exit;
        } else {
            echo "Error deleting Marks: " . $connection->error;
        }
    } else {
        // Ask for confirmation
        echo "<script>
                var confirmed = confirm('Are you sure you want to delete these Marks?');
                if(confirmed) {
                    window.location.href = 'deleteMarks.php?usn=$usn&course_id=$course_id&confirm=true';
                } else {
                    window.location.href = 'marks.php';
                }
              </script>";
    }
} else {
    echo "USN and course ID not provided.";
    exit;
}
?>
