<?php
// editMarks.php

$servername = "localhost";
$username = "root";
$password = "";
$database = "student_management";

$connection = new mysqli($servername, $username, $password, $database);

if($connection->connect_error){
    die("Connection Failed: " . $connection->connect_error);
}

if(isset($_GET['usn']) && isset($_GET['course_id'])) {
    $usn = $_GET['usn'];
    $course_id = $_GET['course_id'];

    // Use prepared statement to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM marks WHERE usn = ? AND course_id = ?");
    $stmt->bind_param("ss", $usn, $course_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0) {
        echo "Marks not found.";
        exit;
    }

    // Fetch the marks details
    $row = $result->fetch_assoc();
    $int_marks = $row['int_marks'];
    $ext_marks = $row['ext_marks'];
    $total = $row['total'];
    $ac_id = $row['ac_id'];
    $status = $row['status'];

    $stmt->close();
} else {
    echo "USN and course ID not provided.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user input
    $int_marks = htmlspecialchars($_POST['int_marks']);
    $ext_marks = htmlspecialchars($_POST['ext_marks']);
    $total = htmlspecialchars($_POST['total']);
    $ac_id = htmlspecialchars($_POST['ac_id']);
    $status = htmlspecialchars($_POST['status']);

    // Update marks details in the database
    $stmt = $connection->prepare("UPDATE marks SET int_marks=?, ext_marks=?, total=?, ac_id=?, status=? WHERE usn=? AND course_id=?");
    $stmt->bind_param("sssssss", $int_marks, $ext_marks, $total, $ac_id, $status, $usn, $course_id);

    if ($stmt->execute()) {
        echo "Marks details updated successfully.";
        $stmt->close();
        $connection->close();
        header("Location: marks.php"); // Redirect to marks list page
        exit;
    } else {
        echo "Error updating marks details: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Edit Marks</title>
</head>
<body style="background-color: #E9EDC9" class="body">
    <div class="container my-5">
        <h2>Edit Marks</h2>
        <!-- Form for editing marks details -->
        <form method="post">
            <!-- Add hidden input fields for usn and course_id -->
            <input type="hidden" name="usn" value="<?php echo $usn; ?>">
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
            <!-- Add form fields for editing marks details here -->
            <div class="mb-3">
                <label for="int_marks" class="form-label">Internal Marks</label>
                <input type="text" class="form-control" id="int_marks" name="int_marks" value="<?php echo $int_marks; ?>">
            </div>
            <div class="mb-3">
                <label for="ext_marks" class="form-label">External Marks</label>
                <input type="text" class="form-control" id="ext_marks" name="ext_marks" value="<?php echo $ext_marks; ?>">
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="text" class="form-control" id="total" name="total" value="<?php echo $total; ?>">
            </div>
            <div class="mb-3">
                <label for="ac_id" class="form-label">AC_ID</label>
                <input type="text" class="form-control" id="ac_id" name="ac_id" value="<?php echo $ac_id; ?>">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?php echo $status; ?>">
            </div>
            <!-- Add more fields as needed -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
