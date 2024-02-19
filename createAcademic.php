<?php
$servername = "localhost";
$username = "root";
$password ="";
$database = "student_management";


$connection = new mysqli($servername, $username, $password, $database);



$ac_id ="";
$year ="";




$errorMessage = "";
$successMessage = "";


if( $_SERVER['REQUEST_METHOD']== 'POST'){
    $ac_id =$_POST["ac_id"];
    $year=$_POST["year"];
    
    do{
        if(empty($ac_id) || empty($year) ){
            $errorMessage = "All the fields are required";
            break;
        }

        //add client to db
        $sql = "INSERT INTO academic_year(ac_id,year)" .
        "VALUES('$ac_id','$year')";
        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query" . $connection->error;
            break;
        }

       

        $successMessage = "Academic Year added Correctly";
        header("location:academic.php");
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
        <h2>New Academic Year</h2>


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
            <label class="col-sm-3 col-form-label">Academic Id</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="ac_id" value="<?php echo $ac_id; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Year</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="year" value="<?php echo $year; ?>">
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
                <a class="btn btn-outline-primary" href="academic.php" role="button">Cancel</a>
            </div>
        </div>

        </form>
    </div>
</body>
</html>