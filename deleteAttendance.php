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

if (isset($_GET['aid'])) {
    $aid = $_GET['aid'];

    // Use prepared statement to prevent SQL injection
    $stmt = $connection->prepare("DELETE FROM attendance WHERE aid = ?");
    $stmt->bind_param("i", $aid); // Assuming prof_id is an integer. Change the "i" if it's another type.

    if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
        // User has confirmed the deletion
        if ($stmt->execute()) {
            echo "attendace deleted successfully.";
            $stmt->close();
            $connection->close();
            header("Location: attendance.php"); // Redirect to professor list page
            exit;
        } else {
            echo "Error deleting attendance: " . $connection->error;
        }
    } else {
        // Ask for confirmation
        echo "<script>
                var confirmed = confirm('Are you sure you want to delete this attendance?');
                if(confirmed) {
                    window.location.href = 'deleteAttendance.php?aid=$aid&confirm=true';
                } else {
                    window.location.href = 'attendance.php';
                }
              </script>";
    }
} else {
    echo "attendance ID not provided.";
    exit;
}
?>
