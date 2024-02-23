<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./styles/Hstyle.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div id="sidebar">
      <header></header>
      <ul>
          <li>
              <a href="students.php">
                  <i class="fa-solid fa-users"></i>
                  <span>Students</span>
              </a>
          </li>
          <li>
              <a href="professor.php">
                  <i class="fa-solid fa-chalkboard-user"></i>
                  <span>Professor</span>
              </a>
          </li>
          <li>
              <a href="course.php">
                  <i class="fa-solid fa-book-open-reader"></i>
                  <span>Courses</span>
              </a>
          </li>
          <li>
              <a href="attendance.php">
                  <i class="fa-solid fa-clipboard-user"></i>
                  <span>Attendance</span>
              </a>
          </li>
          <li>
              <a href="academic.php">
              <i class="fa-solid fa-calendar-days"></i>
                  <span>Academic Year</span>
              </a>
          </li>
          <li>
              <a href="marks.php">
                  <i class="fa-solid fa-paste"></i>
                  <span>Marks</span>
              </a>
          </li>
          <!-- Add more options as needed -->
      </ul>
      <footer></footer>
  </div>
  <div id="content">
<div class="container my-5">
    <h2>List of Marks</h2>
    <a class="btn btn-primary" href="createMarks.php" role="button">New Marks</a>
    <br>
    <table class="table table-bordered">
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
</div>
</body>
</html>
