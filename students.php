<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./styles/Hstyle.css" />
</head>
<body>
<div class="container my-5">
<nav class="sidebar close">
  <header>
    <div class="image-text">
      <div class="text header-text">
        <span class="main">Student Dashboard</span>
      </div>
    </div>
    <i class="bx bx-chevron-right toggle"></i>
  </header>

  <div class="menu-bar">
    <div class="menu">
      <ul class="menu-links">
        <li class="nav-link">
          <i class="fa-solid fa-users"></i>
          <a href="#">
            <span class="text nav-text">Students</span>
          </a>
        </li>
        <li class="nav-link">
          <i class="fa-solid fa-chalkboard-user"></i>
          <a href="professor.php">
            <span class="text nav-text">Professors</span>
          </a>
        </li>
        <li class="nav-link">
          <i class="fa-solid fa-book-open-reader"></i>
          <a href="#">
            <span class="text nav-text">Courses </span>
          </a>
        </li>
        <li class="nav-link">
          <i class="fa-solid fa-clipboard-user"></i>
          <a href="#">
            <span class="text nav-text">Attendance</span>
          </a>
        </li>
        <li class="nav-link">
          <i class="fa-solid fa-paste"></i>
          <a href="#">
            <span class="text nav-text">Marks</span>
          </a>
        </li>
      </ul>
    </div>

    <div class="bottom-content">
      <li class="mode">
        <div class="moon-sun">
          <i class="bx bx-moon icons moon"></i>
          <i class="bx bx-sun icons sun"></i>
        </div>
        <span class="mode-text text">Dark Mode</span>
        <div class="toggle-switch">
          <span class="switch"></span>
          <script src="./scripts/script.js"></script>
        </div>
      </li>
    </div>
  </div>
</nav>

    <div class="main-content">
        <h2>List of Students</h2>
        <a class="btn btn-primary" href="createStudent.php" role="button">New Student</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>USN</th>
                    <th>Fname</th>
                    <th>Mname</th>
                    <th>Lname</th>
                    <th>DOB</th>
                    <th>Sem</th>
                    <th>Gender</th>
                    <th>Phone_no</th>
                    <th>Email</th>
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
                $sql ="SELECT * FROM students";
                $result =$connection->query($sql);

                if(!$result){
                    die("Invalid query:" .$connection->error);
                }

                while($row = $result->fetch_assoc()){
                    $usn = $row['usn'];
                    $fname = $row['fname'];
                    $mname = $row['mname'];
                    $lname = $row['lname'];
                    $dob = $row['dob'];
                    $sem= $row['sem'];
                    $gender= $row['gender'];
                    $phone_no = $row['phone_no'];
                    $email = $row['email'];
                    echo '
                    <tr>
                    <td>'.$usn.'</td>
                    <td>'.$fname.'</td>
                    <td>'.$mname.'</td>
                    <td>'.$lname.'</td>
                    <td>'.$dob.'</td>
                    <td>'.$sem.'</td>
                    <td>'.$gender.'</td>
                    <td>'.$phone_no.'</td>
                    <td>'.$email.'</td>
                    <td>
                    <a class="btn btn-primary btn-sm" href="editStudent.php?usn='.$usn.'">Edit</a>
                    <a class="btn btn-danger btn-sm" href="deleteStudent.php?usn='.$usn.'">Delete</a>

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