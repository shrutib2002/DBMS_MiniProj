<?php
$servername = "localhost";
$username = "root";
$password ="";
$database = "student_management";


$connection = new mysqli($servername, $username, $password, $database);



$prof_id ="";
$fname ="";
$mname ="";
$lname ="";
$course_id="";
$email ="";
$phone_no ="";
$salary ="";



$errorMessage = "";
$successMessage = "";


if( $_SERVER['REQUEST_METHOD']== 'POST'){
    $prof_id =$_POST["prof_id"];
    $fname=$_POST["fname"];
    $mname =$_POST["mname"];
    $lname =$_POST["lname"];
    $course_id =$_POST["course_id"];
    $email =$_POST["email"];
    $phone_no =$_POST["phone_no"];
    $salary =$_POST["salary"];

    do{
        if(empty($prof_id) || empty($fname) ||empty($mname) || empty($lname) || empty($course_id) ||empty($email)||  empty($salary)||empty($phone_no)){
            $errorMessage = "All the fields are required";
            break;
        }

        //add client to db
        $sql = "INSERT INTO professor(prof_id,fname,mname,lname,course_id,email,phone_no,salary)" .
        "VALUES('$prof_id','$fname','$mname','$lname','$course_id','$email','$phone_no','$salary')";
        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query" . $connection->error;
            break;
        }

       

        $successMessage = "professor added Correctly";
        header("location:professor.php");
        exit;

    }while(false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5"> 
        <h2>New Professor</h2>


        <?php
        if(!empty($errorMessage)){
            echo"
            <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        
        ?>
        <form method="post">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Prof_ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="prof_id" value="<?php echo $prof_id; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">First Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Middle Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="mname" value="<?php echo $mname; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Last Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Course ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="course_id" value="<?php echo $course_id; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">email</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Phone Number</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phone_no" value="<?php echo $phone_no; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Salary</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="salary" value="<?php echo $salary; ?>">
            </div>
        </div>
        

        <?php
        if(!empty($successMessage)){
            echo"
            <div class = 'row mb-3'>
            <div class ='offset-sm-3 col-sm-6'>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>$successMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>
            </div>
            </div>
            ";
        }

        ?>

        
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="professor.php" role="button">Cancel</a>
            </div>
        </div>

        </form>
    </div>
</body>
</html>