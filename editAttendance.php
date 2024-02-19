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

if(isset($_GET['aid'])) {
    $aid = $_GET['aid'];

    // Use prepared statement to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM attendance WHERE aid = ?");
    $stmt->bind_param("s", $aid);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0) {
        echo "Attendance not found.";
        exit;
    }

    // Fetch the student details
    $row = $result->fetch_assoc();
    $usn = $row['usn'];
    $course_id = $row['course_id'];
    $sem = $row['sem'];
    $attended = $row['attended'];
    $date= $row['date'];
    $time= $row['time'];

    $stmt->close();
} else {
    echo "Attendance ID  not provided.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user input
    $usn = htmlspecialchars($_POST['usn']);
    $course_id = htmlspecialchars($_POST['course_id']);
    $sem = htmlspecialchars($_POST['sem']);
    $attended = htmlspecialchars($_POST['attended']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    

    // Update student details in the database
    $stmt = $connection->prepare("UPDATE attendance SET usn=?, course_id=?, sem=?, attended=?, date=?, time=? WHERE aid=?");
    $stmt->bind_param("sssssss", $usn, $course_id, $sem, $attended, $date, $time, $aid);

    if ($stmt->execute()) {
        echo "Attendance details updated successfully.";
        $stmt->close();
        $connection->close();
        header("Location: Attendance.php"); // Redirect to professor list page
        exit;
    } else {
        echo "Error updating attendance details: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Edit Attendance</title>
</head>
<body>
    <div class="container my-5">
        <h2>Edit Attendance</h2>
        <!-- Form for editing student details -->
        <form method="post">
            <input type="hidden" name="aid" value="<?php echo $aid; ?>">
            <!-- Add form fields for editing student details here -->
            <div class="mb-3">
                <label for="usn" class="form-label">USN</label>
                <input type="text" class="form-control" id="usn" name="usn" value="<?php echo $usn; ?>">
            </div>
            <div class="mb-3">
                <label for="course_id" class="form-label">COURSE ID</label>
                <input type="text" class="form-control" id="course_id" name="course_id" value="<?php echo $course_id; ?>">
            </div>
            <div class="mb-3">
                <label for="sem" class="form-label">Semester</label>
                <input type="text" class="form-control" id="sem" name="sem" value="<?php echo $sem; ?>">
            </div>
            <div class="mb-3">
                <label for="attended" class="form-label">Attended</label>
                <input type="text" class="form-control" id="attended" name="attended" value="<?php echo $attended; ?>">
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="text" class="form-control" id="date" name="date" value="<?php echo $date; ?>">
            </div>
            
            <div class="mb-3">
                <label for="time" class="form-label">Time</label>
                <input type="text" class="form-control" id="time" name="time" value="<?php echo $time;?>">
            </div>
            
            <!-- Add more fields as needed -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
