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
        <h2>List of Courses</h2>
        <a class="btn btn-primary" href="createCourse.php" role="button">New Course</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Course ID</th>
                    <th>Name</th>
                    <th>Total Class</th>
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
                $sql ="SELECT * FROM courses";
                $result =$connection->query($sql);

                if(!$result){
                    die("Invalid query:" .$connection->error);
                }

                while($row = $result->fetch_assoc()){
                    $course_id = $row['course_id'];
                    $name = $row['name'];
                    $total_class = $row['total_class'];
                   
                    echo '
                    <tr>
                    <td>'.$course_id.'</td>
                    <td>'.$name.'</td>
                    <td>'.$total_class.'</td>
                    <td>
                    <a class="btn btn-primary btn-sm" href="editCourse.php?course_id='.$course_id.'">Edit</a>
                    <a class="btn btn-danger btn-sm" href="deleteCourse.php?course_id='.$course_id.'">Delete</a>

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