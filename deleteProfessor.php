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

if (isset($_GET['prof_id']) && isset($_GET['course_id'])) {
    $prof_id = $_GET['prof_id'];
    $course_id = $_GET['course_id'];

    // Use prepared statement to prevent SQL injection
    $stmt = $connection->prepare("DELETE FROM professor WHERE prof_id = ? AND course_id = ?");
    $stmt->bind_param("is", $prof_id, $course_id); // Assuming usn and course_id are strings. Change the "s" if they are another type.0

    if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
        // User has confirmed the deletion
        if ($stmt->execute()) {
            echo "Marks deleted successfully.";
            $stmt->close();
            $connection->close();
            header("Location: professor.php"); // Redirect to marks list page
            exit;
        } else {
            echo "Error deleting Marks: " . $connection->error;
        }
    } else {
        // Ask for confirmation
        echo "<script>
                var confirmed = confirm('Are you sure you want to delete these Professor?');
                if(confirmed) {
                    window.location.href = 'deleteProfessor.php?prof_id=$prof_id&course_id=$course_id&confirm=true';
                } else {
                    window.location.href = 'Professor.php';
                }
              </script>";
    }
} else {
    echo "Prof_id and course ID not provided.";
    exit;
}
?>
