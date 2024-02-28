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

if(isset($_GET['usn'])) {
    $usn = $_GET['usn'];

    // Use prepared statement to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM students WHERE usn = ?");
    $stmt->bind_param("s", $usn);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0) {
        echo "Student not found.";
        exit;
    }

    // Fetch the student details
    $row = $result->fetch_assoc();
    $fname = $row['fname'];
    $mname = $row['mname'];
    $lname = $row['lname'];
    $dob = $row['dob'];
    $sem= $row['sem'];
    $gender = $row['gender'];
    $phone_no = $row['phone_no'];
    $email = $row['email'];

    $stmt->close();
} else {
    echo " USN not provided.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user input
    $fname = htmlspecialchars($_POST['fname']);
    $mname = htmlspecialchars($_POST['mname']);
    $lname = htmlspecialchars($_POST['lname']);
    $dob = htmlspecialchars($_POST['dob']);
    $sem = htmlspecialchars($_POST['sem']);
    $gender = htmlspecialchars($_POST['gender']);
    $phone_no = htmlspecialchars($_POST['phone_no']);
    $email = htmlspecialchars($_POST['email']);

    // Update student details in the database
    $stmt = $connection->prepare("UPDATE students SET fname=?, mname=?, lname=?, dob=?, sem=?, gender=?, phone_no=?, email=? WHERE usn=?");
    $stmt->bind_param("sssssssss", $fname, $mname, $lname, $dob, $sem, $gender, $phone_no, $email, $usn);

    if ($stmt->execute()) {
        echo "Student details updated successfully.";
        $stmt->close();
        $connection->close();
        header("Location: students.php"); // Redirect to student list page
        exit;
    } else {
        echo "Error updating student details: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Edit Student</title>
</head>
<body style="background-color: #E9EDC9" class="body">
    <div class="container my-5">
        <h2>Edit Student</h2>
        <!-- Form for editing student details -->
        <form method="post">
            <input type="hidden" name="usn" value="<?php echo $usn; ?>">
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
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="text" class="form-control" id="dob" name="dob" value="<?php echo $dob; ?>">
            </div>
            <div class="mb-3">
                <label for="sem" class="form-label">Sem</label>
                <input type="text" class="form-control" id="sem" name="sem" value="<?php echo $sem; ?>">
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $gender; ?>">
            </div>
            <div class="mb-3">
                <label for="phone_no" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_no" name="phone_no" value="<?php echo $phone_no;?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
            </div>
            <!-- Add more fields as needed -->
            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>
</body>
</html>
