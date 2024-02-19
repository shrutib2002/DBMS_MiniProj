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

if (isset($_GET['ac_id'])) {
    $course_id = $_GET['ac_id'];

    // Use prepared statement to prevent SQL injection
    $stmt = $connection->prepare("DELETE FROM academic WHERE ac_id = ?");
    $stmt->bind_param("i", $ac_id); // Assuming prof_id is an integer. Change the "i" if it's another type.

    if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
        // User has confirmed the deletion
        if ($stmt->execute()) {
            echo "Academic Year deleted successfully.";
            $stmt->close();
            $connection->close();
            header("Location: academic.php"); // Redirect to professor list page
            exit;
        } else {
            echo "Error deleting academic year: " . $connection->error;
        }
    } else {
        // Ask for confirmation
        echo "<script>
                var confirmed = confirm('Are you sure you want to delete this course?');
                if(confirmed) {
                    window.location.href = 'deleteAcademic.php?ac_id=$ac_id&confirm=true';
                } else {
                    window.location.href = 'ac_id.php';
                }
              </script>";
    }
} else {
    echo "Academic ID not provided.";
    exit;
}
?>
