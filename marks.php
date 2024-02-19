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
    <h2>List of Marks</h2>
    <a class="btn btn-primary" href="createMarks.php" role="button">New Marks</a>
    <br>
    <table class="table">
        <thead>
        <tr>
            <th>USN</th>
            <th>Course Id</th>
            <th>Internal Marks</th>
            <th>External Marks</th>
            <th>Total</th>
            <th>Academic Id</th>
            <th>Status</th>
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
        $sql ="SELECT * FROM marks";
        $result =$connection->query($sql);

        if(!$result){
            die("Invalid query:" .$connection->error);
        }

        while($row = $result->fetch_assoc()){
            $usn= $row['usn'];
            $course_id = $row['course_id'];
            $int_marks = $row['int_marks'];
            $ext_marks = $row['ext_marks'];
            $total = $row['total'];
            $ac_id = $row['ac_id'];
            $status = $row['status'];


            echo '
                <tr>
                    <td>'.$usn.'</td>
                    <td>'.$course_id.'</td>
                    <td>'.$int_marks.'</td>
                    <td>'.$ext_marks.'</td>
                    <td>'.$total.'</td>
                    <td>'.$ac_id.'</td>
                    <td>'.$status.'</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="editMarks.php?usn='.$usn.'&amp;course_id='.$course_id.'">Edit</a>
                        <a class="btn btn-danger btn-sm" href="deleteMarks.php?usn='.$usn.'&amp;course_id='.$course_id.'">Delete</a>
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
