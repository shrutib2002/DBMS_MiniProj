<?php
// deleteStudent.php

$servername = "localhost";
$username = "root";
$password ="";
$database = "student_management";

$connection = new mysqli($servername, $username, $password, $database);

if($connection->connect_error){
    die("Connection Failed: " . $connection->connect_error);
}

if(isset($_GET['usn'])) {
    $usn = $_GET['usn'];

    // Use prepared statement to prevent SQL injection
    $stmt = $connection->prepare("DELETE FROM students WHERE usn = ?");
    $stmt->bind_param("s", $usn);

    if(isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
        // User has confirmed the deletion
        if ($stmt->execute()) {
            echo "Student deleted successfully.";
            $stmt->close();
            $connection->close();
            header("Location: students.php"); // Redirect to student list page
            exit;
        } else {
            echo "Error deleting student: " . $connection->error;
        }
    } else {
        // Ask for confirmation
        echo "<script>
                var confirmed = confirm('Are you sure you want to delete this student?');
                if(confirmed) {
                    window.location.href = 'deleteStudent.php?usn=$usn&confirm=true';
                } else {
                    window.location.href = 'students.php';
                }
              </script>";
    }
} else {
    echo "USN not provided.";
    exit;
}
?>
