<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
        <h2>List of Professor</h2>
        <a class="btn btn-primary" href="createProfessor.php" role="button">New Professor</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Professor Id</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Course Id</th>
                    <th>Email</th>
                    <th>Phone_no</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername= "localhost";
                $username ="root";
                $password="";
                $database ="student_management";
                 
                $connection =new mysqli( $servername,  $username,  $password,$database );

                if($connection->connect_error){
                    die("Connection Failed:" .$connection->connect_error);
                }
                $sql ="SELECT * FROM professor";
                $result =$connection->query($sql);

                if(!$result){
                    die("Invalid query:" .$connection->error);
                }

                while($row = $result->fetch_assoc()){
                    $prof_id = $row['prof_id'];
                    $fname = $row['fname'];
                    $mname = $row['mname'];
                    $lname = $row['lname'];
                    $course_id = $row['course_id'];
                    $email = $row['email'];
                    $phone_no = $row['phone_no'];
                    $salary = $row['salary'];
                   
                    echo '
                    <tr>
                    <td>'.$prof_id.'</td>
                    <td>'.$fname.'</td>
                    <td>'.$mname.'</td>
                    <td>'.$lname.'</td>
                    <td>'.$course_id.'</td>
                    <td>'.$email.'</td>
                    <td>'.$phone_no.'</td>
                    <td>'.$salary.'</td>
                    <td>
                    <a class="btn btn-primary btn-sm" href="editProfessor.php?prof_id='.$prof_id.'">Edit</a>
                    <a class="btn btn-danger btn-sm" href="deleteProfessor.php?prof_id='.$prof_id.'">Delete</a>

                    </td>
                    </tr>
                    ';
                }

                ?>
            </tbody>
        </table>
    </div>
</body>
</html>