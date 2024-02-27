<?php
// editstudents.php

$servername = "localhost";
$username = "root";
$password ="";
$database = "student_management";

$connection = new mysqli($servername, $username, $password, $database);

if($connection->connect_error){
    die("Connection Failed: " . $connection->connect_error);
}

if(isset($_GET['ac_id'])) {
    $ac_id = $_GET['ac_id'];

    // Use prepared statement to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM academic_year WHERE ac_id = ?");
    $stmt->bind_param("s", $ac_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0) {
        echo "Academic Year  not found.";
        exit;
    }

    // Fetch the student details
    $row = $result->fetch_assoc();
    $year = $row['year'];
  

    $stmt->close();
} else {
    echo "Academic ID  not provided.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user input
    $year = htmlspecialchars($_POST['year']);


    // Update student details in the database
    $stmt = $connection->prepare("UPDATE academic_year SET year=? WHERE ac_id=?");
    $stmt->bind_param("ss", $year, $ac_id);

    if ($stmt->execute()) {
        echo "Academic Year details updated successfully.";
        $stmt->close();
        $connection->close();
        header("Location: academic.php"); // Redirect to professor list page
        exit;
    } else {
        echo "Error updating Academic year details: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Edit Academic Year</title>
</head>
<body style="background-color: #E9EDC9" class="body">
    <div class="container my-5">
        <h2>Edit Academic Year</h2>
        <!-- Form for editing student details -->
        <form method="post">
            <input type="hidden" name="ac_id" value="<?php echo $ac_id; ?>">
            <!-- Add form fields for editing student details here -->
            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="text" class="form-control" id="year" name="year" value="<?php echo $year; ?>">
            </div>
            <!-- Add more fields as needed -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
