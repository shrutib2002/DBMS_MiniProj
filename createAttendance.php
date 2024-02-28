<?php
$servername = "localhost";
$username = "root";
$password ="";
$database = "student_management";


$connection = new mysqli($servername, $username, $password, $database);



$aid ="";
$usn ="";
$course_id="";
$sem ="";
$attended="";
$date ="";
$time ="";




$errorMessage = "";
$successMessage = "";


if( $_SERVER['REQUEST_METHOD']== 'POST'){
    $aid =$_POST["aid"];
    $usn=$_POST["usn"];
    $course_id =$_POST["course_id"];
    $sem =$_POST["sem"];
    $attended =$_POST["attended"];
    $date =$_POST["date"];
    $time=$_POST["time"];
   

    do{
        if(empty($aid) || empty($usn) ||empty($course_id) || empty($sem) || empty($attended) ||empty($date)||  empty($time)){
            $errorMessage = "All the fields are required";
            break;
        }

        //add client to db
        $sql = "INSERT INTO attendance(aid,usn,course_id,sem,attended,date,time)" .
        "VALUES('$aid','$usn','$course_id','$sem','$attended','$date','$time')";
        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query" . $connection->error;
            break;
        }

       

        $successMessage = "Attendance added Correctly";
        header("location:Attendance.php");
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
        <h2>New Attendance</h2>


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
            <label class="col-sm-3 col-form-label">Attendance Id</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="aid" value="<?php echo $aid; ?>">
            </div>
        </div>
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
            <label class="col-sm-3 col-form-label">Semester</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="sem" value="<?php echo $sem; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Attended</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="attended" value="<?php echo $attended; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Date</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="date" value="<?php echo $date; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Time</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="time" value="<?php echo $time; ?>">
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
                <a class="btn btn-outline-secondary" href="Attendance.php" role="button">Cancel</a>
            </div>
        </div>

        </form>
    </div>
</body>
</html>