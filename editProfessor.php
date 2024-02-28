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

if(isset($_GET['prof_id']) && isset($_GET['course_id'])) {
    $prof_id = $_GET['prof_id'];
    $course_id = $_GET['course_id'];

    // Use prepared statement to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM professor WHERE prof_id = ? AND course_id=?");
    $stmt->bind_param("ss", $prof_id,$course_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0) {
        echo "Professor not found.";
        exit;
    }

    // Fetch the student details
    $row = $result->fetch_assoc();
    $fname = $row['fname'];
    $mname = $row['mname'];
    $lname = $row['lname'];
    $email= $row['email'];
    $phone_no = $row['phone_no'];
    $salary = $row['salary'];

    $stmt->close();
} else {
    echo "Professor ID  not provided.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user input
    $fname = htmlspecialchars($_POST['fname']);
    $mname = htmlspecialchars($_POST['mname']);
    $lname = htmlspecialchars($_POST['lname']);
    $email = htmlspecialchars($_POST['email']);
    $phone_no = htmlspecialchars($_POST['phone_no']);
    $salary = htmlspecialchars($_POST['salary']);

    // Update student details in the database
    $stmt = $connection->prepare("UPDATE professor SET fname=?, mname=?, lname=?, email=?, phone_no=?, salary=? WHERE prof_id=? AND course_id=?");
    $stmt->bind_param("ssssssss", $fname, $mname, $lname, $email, $phone_no, $salary, $prof_id,$course_id);

    if ($stmt->execute()) {
        echo "Professor details updated successfully.";
        $stmt->close();
        $connection->close();
        header("Location: professor.php"); // Redirect to professor list page
        exit;
    } else {
        echo "Error updating professor details: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Edit Professor</title>
</head>
<body style="background-color: #E9EDC9" class="body">
    <div class="container my-5">
        <h2>Edit Professor</h2>
        <!-- Form for editing student details -->
        <form method="post">
            <input type="hidden" name="prof_id" value="<?php echo $prof_id; ?>">
            <!-- Add form fields for editing student details here -->
            <div class="mb-3">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fname; ?>">
            </div>
            <div class="mb-3">
                <label for="mname" class="form-label">Middle Name</label>
                <input type="text" class="form-control" id="mname" name="mname" value="<?php echo $mname; ?>">
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $lname; ?>">
            </div>
            <div class="mb-3">
                <label for="course_id" class="form-label">Course Id</label>
                <input type="text" class="form-control" id="course_id" name="course_id" value="<?php echo $course_id; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
            </div>
            
            <div class="mb-3">
                <label for="phone_no" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_no" name="phone_no" value="<?php echo $phone_no;?>">
            </div>
            <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="text" class="form-control" id="salary" name="salary" value="<?php echo $salary; ?>">
            </div>
            <!-- Add more fields as needed -->
            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>
</body>
</html>
