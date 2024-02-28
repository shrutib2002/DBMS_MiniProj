<?php
$servername = "localhost";
$username = "root";
$password ="";
$database = "student_management";


$connection = new mysqli($servername, $username, $password, $database);



$usn ="";
$fname ="";
$mname ="";
$lname ="";
$dob="";
$sem ="";
$gender ="";
$phone_no ="";
$email="";




$errorMessage = "";
$successMessage = "";


if( $_SERVER['REQUEST_METHOD']== 'POST'){
    $usn =$_POST["usn"];
    $fname=$_POST["fname"];
    $mname =$_POST["mname"];
    $lname =$_POST["lname"];
    $dob =$_POST["dob"];
    $sem =$_POST["sem"];
    $gender =$_POST["gender"];
    $phone_no =$_POST["phone_no"];
    $email =$_POST["email"];

    do{
        if(empty($usn) || empty($fname) ||empty($mname) || empty($lname) || empty($dob) ||empty($sem)||  empty($gender)||empty($phone_no)  || empty($email)){
            $errorMessage = "All the fields are required";
            break;
        }

        //add client to db
        $sql = "INSERT INTO students(usn,fname,mname,lname,dob,sem,gender,phone_no,email)" .
        "VALUES('$usn','$fname','$mname','$lname','$dob','$sem','$gender','$phone_no','$email')";
        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query" . $connection->error;
            break;
        }

       

        $successMessage = "Customer added Correctly";
        header("location:students.php");
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
<body style="background-color: #E9EDC9" class="body">
    <div class="container my-5"> 
        <h2>New student</h2>


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
            <label class="col-sm-3 col-form-label">USN</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="usn" value="<?php echo $usn; ?>">
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
            <label class="col-sm-3 col-form-label">DOB</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="dob" value="<?php echo $dob; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Semester</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="sem" value="<?php echo $sem; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Gender</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="gender" value="<?php echo $gender; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Phone Number</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phone_no" value="<?php echo $phone_no; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
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
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-secondary" href="students.php" role="button">Cancel</a>
            </div>
        </div>

        </form>
    </div>
</body>
</html>