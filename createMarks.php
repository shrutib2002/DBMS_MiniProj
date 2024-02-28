<?php
$servername = "localhost";
$username = "root";
$password ="";
$database = "student_management";


$connection = new mysqli($servername, $username, $password, $database);



$usn ="";
$course_id ="";
$int_marks ="";
$ext_marks ="";
$total="";
$ac_id ="";
$status ="";




$errorMessage = "";
$successMessage = "";


if( $_SERVER['REQUEST_METHOD']== 'POST'){
    $usn =$_POST["usn"];
    $course_id=$_POST["course_id"];
    $int_marks =$_POST["int_marks"];
    $ext_marks =$_POST["ext_marks"];
    $total =$_POST["total"];
    $ac_id =$_POST["ac_id"];
    $status =$_POST["status"];

    do{
        if(empty($usn) || empty($course_id) ||empty($int_marks) || empty($ext_marks) || empty($total) ||empty($ac_id)||  empty($status)){
            $errorMessage = "All the fields are required";
            break;
        }

        //add client to db
        $sql = "INSERT INTO marks(usn,course_id,int_marks,ext_marks,total,ac_id,status)" .
        "VALUES('$usn','$course_id','$int_marks','$ext_marks','$total','$ac_id','$status')";
        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query" . $connection->error;
            break;
        }

       

        $successMessage = "marks added Correctly";
        header("location:marks.php");
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
        <h2>New Marks</h2>


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
            <label class="col-sm-3 col-form-label">Course Id</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="course_id" value="<?php echo $course_id; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Internal Marks</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="int_marks" value="<?php echo $int_marks; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">External Marks</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="ext_marks" value="<?php echo $ext_marks; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Total </label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="total" value="<?php echo $total; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Academic Id</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="ac_id" value="<?php echo $ac_id; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Status</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="status" value="<?php echo $status; ?>">
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
                <a class="btn btn-outline-secondary" href="marks.php" role="button">Cancel</a>
            </div>
        </div>

        </form>
    </div>
</body>
</html>