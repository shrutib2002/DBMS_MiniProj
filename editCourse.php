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

if(isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    // Use prepared statement to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM courses WHERE course_id = ?");
    $stmt->bind_param("s", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0) {
        echo "Course not found.";
        exit;
    }

    // Fetch the student details
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $total_class = $row['total_class'];
  

    $stmt->close();
} else {
    echo "Course ID  not provided.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user input
    $name = htmlspecialchars($_POST['name']);
    $total_class = htmlspecialchars($_POST['total_class']);


    // Update student details in the database
    $stmt = $connection->prepare("UPDATE courses SET name=?, total_class=? WHERE course_id=?");
    $stmt->bind_param("sss", $name, $total_class, $course_id);

    if ($stmt->execute()) {
        echo "Course details updated successfully.";
        $stmt->close();
        $connection->close();
        header("Location: course.php"); // Redirect to professor list page
        exit;
    } else {
        echo "Error updating Course details: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Edit Course</title>
</head>
<body style="background-color: #E9EDC9" class="body">
    <div class="container my-5">
        <h2>Edit Course</h2>
        <!-- Form for editing student details -->
        <form method="post">
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
            <!-- Add form fields for editing student details here -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
            </div>
            <div class="mb-3">
                <label for="total_class" class="form-label">Total Class</label>
                <input type="text" class="form-control" id="total_class" name="total_class" value="<?php echo $total_class; ?>">
            </div>
            <!-- Add more fields as needed -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
