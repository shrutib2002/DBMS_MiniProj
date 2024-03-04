<?php
// deleteCourse.php

$servername = "localhost";
$username = "root";
$password = "";
$database = "student_management";

// Establishing connection to the database
$connection = new mysqli($servername, $username, $password, $database);

// Checking for connection errors
if ($connection->connect_error) {
    die("Connection Failed: " . $connection->connect_error);
}

// Checking if course_id is set in the URL
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    // Use prepared statement to prevent SQL injection
    $stmt = $connection->prepare("DELETE FROM courses WHERE course_id = ?");
    $stmt->bind_param("s", $course_id); // Assuming course_id is an integer. Change the "i" if it's another type.

    // Checking if the deletion is confirmed
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
        // User has confirmed the deletion
        if ($stmt->execute()) {
            echo "Course deleted successfully.";
            $stmt->close();
            $connection->close();
            header("Location: course.php"); // Redirect to course list page
            exit;
        } else {
            echo "Error deleting course: " . $connection->error;
        }
    } else {
        // Ask for confirmation
        echo "<script>
                var confirmed = confirm('Are you sure you want to delete this course?');
                if (confirmed) {
                    window.location.href = 'deleteCourse.php?course_id=$course_id&confirm=true';
                } else {
                    window.location.href = 'course.php'; // Redirect back to course list page
                }
              </script>";
    }
} else {
    echo "Course ID not provided.";
    exit;
}
?>
