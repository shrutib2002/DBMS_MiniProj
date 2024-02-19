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
        <a class="btn btn-primary" href="createAttendance.php" role="button">New Attendance</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Attendance Id</th>
                    <th>USN</th>
                    <th>Course Id</th>
                    <th>Semester</th>
                    <th>Attended</th>
                    <th>Date</th>
                    <th>Time</th>
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
                $sql ="SELECT * FROM attendance";
                $result =$connection->query($sql);

                if(!$result){
                    die("Invalid query:" .$connection->error);
                }

                while($row = $result->fetch_assoc()){
                    $aid = $row['aid'];
                    $usn = $row['usn'];
                    $course_id = $row['course_id'];
                    $sem = $row['sem'];
                    $attended = $row['attended'];
                    $date= $row['date'];
                    $time= $row['time'];
                   
                    echo '
                    <tr>
                    <td>'.$aid.'</td>
                    <td>'.$usn.'</td>
                    <td>'.$course_id.'</td>
                    <td>'.$sem.'</td>
                    <td>'.$attended.'</td>
                    <td>'.$date.'</td>
                    <td>'.$time.'</td>
                    <td>
                    <a class="btn btn-primary btn-sm" href="editAttendance.php?prof_id='.$aid.'">Edit</a>
                    <a class="btn btn-danger btn-sm" href="deleteAttendance.php?prof_id='.$aid.'">Delete</a>

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