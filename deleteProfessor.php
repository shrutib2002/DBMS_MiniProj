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

if (isset($_GET['prof_id'])) {
    $prof_id = $_GET['prof_id'];

    // Use prepared statement to prevent SQL injection
    $stmt = $connection->prepare("DELETE FROM professor WHERE prof_id = ?");
    $stmt->bind_param("i", $prof_id); // Assuming prof_id is an integer. Change the "i" if it's another type.

    if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
        // User has confirmed the deletion
        if ($stmt->execute()) {
            echo "Professor deleted successfully.";
            $stmt->close();
            $connection->close();
            header("Location: professor.php"); // Redirect to professor list page
            exit;
        } else {
            echo "Error deleting professor: " . $connection->error;
        }
    } else {
        // Ask for confirmation
        echo "<script>
                var confirmed = confirm('Are you sure you want to delete this professor?');
                if(confirmed) {
                    window.location.href = 'deleteProfessor.php?prof_id=$prof_id&confirm=true';
                } else {
                    window.location.href = 'professor.php';
                }
              </script>";
    }
} else {
    echo "Professor ID not provided.";
    exit;
}
?>
