<?php
// deleteProfessor.php

$servername = "localhost";
$username = "root";
$password = "";
$database = "student_management";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection Failed: " . $connection->connect_error);
}

if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    // Use prepared statement to prevent SQL injection
    $stmt = $connection->prepare("DELETE FROM courses WHERE course_id = ?");
    $stmt->bind_param("i", $course_id); // Assuming prof_id is an integer. Change the "i" if it's another type.

    if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
        // User has confirmed the deletion
        if ($stmt->execute()) {
            echo "Course deleted successfully.";
            $stmt->close();
            $connection->close();
            header("Location: course.php"); // Redirect to professor list page
            exit;
        } else {
            echo "Error deleting course: " . $connection->error;
        }
    } else {
        // Ask for confirmation
        echo "<script>
                var confirmed = confirm('Are you sure you want to delete this course?');
                if(confirmed) {
                    window.location.href = 'deleteCourse.php?course_id=$course_id&confirm=true';
                } else {
                    window.location.href = 'course_id.php';
                }
              </script>";
    }
} else {
    echo "Course ID not provided.";
    exit;
}
?>
