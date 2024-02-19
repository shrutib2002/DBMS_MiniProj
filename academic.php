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
        <h2>List of Academic Years</h2>
        <a class="btn btn-primary" href="createAcademic.php" role="button">New Academic Year</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Academic ID</th>
                    <th>Year</th>
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
                $sql ="SELECT * FROM academic_year";
                $result =$connection->query($sql);

                if(!$result){
                    die("Invalid query:" .$connection->error);
                }

                while($row = $result->fetch_assoc()){
                    $ac_id = $row['ac_id'];
                    $year = $row['year'];
                   
                    echo '
                    <tr>
                    <td>'.$ac_id.'</td>
                    <td>'.$year.'</td>
                    <td>
                    <a class="btn btn-primary btn-sm" href="editAcademic.php?ac_id='.$ac_id.'">Edit</a>
                    <a class="btn btn-danger btn-sm" href="deleteAcademic.php?ac_id='.$ac_id.'">Delete</a>

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