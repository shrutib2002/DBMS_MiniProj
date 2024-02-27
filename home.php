<?php

$servername = "localhost";
$username = "root";
$password ="";
$database = "student_management";


$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

$sql = "SELECT COUNT(*) AS student_count FROM students";
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $student_count = $row['student_count'];
} else {
  $student_count = 0;
}

$sql = "SELECT COUNT(*) AS professor_count FROM professor";
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $professor_count = $row['professor_count'];
} else {
  $professor_count = 0;
}

$sql = "SELECT COUNT(*) AS course_count FROM courses";
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $course_count = $row['course_count'];
} else {
  $course_count = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./styles/Hstyle.css" />
    <style>
  /* CSS styles */
  .container {
    display: flex;
    justify-content: space-between;
    transition: all 0.5s ease-in-out; /* Adding transition to the container */
  }
  .box {
    width: calc(30% - 20px); /* Adjusting the width to account for margin */
    padding: 20px;
    border: 2px solid white;
    border-radius: 50px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    transition: all 1s ease-in-out;
    background-color:#f0ead2; /* Adding transition to the boxes */
  }
  .box:hover {
    transform: scale(1.05); /* Scaling up the box on hover */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Adding a stronger shadow on hover */
  }
  .box h2 {
    text-align: center;
    margin-bottom: 10px;
    transition: color 0.3s ease-in-out; /* Adding transition to the heading color */
  }
  .box p {
    transition: color 0.3s ease-in-out; /* Adding transition to the paragraph color */
  }
</style>
    <title>Dashboard</title>
  </head>
  <body style="background-color: #E9EDC9" class="body">
<div id="sidebar" style="  background: linear-gradient(to bottom,#CCD5AE,#D4A373)
">
      <header></header>
      <ul>
      <li>
              <a href="home.php">
              <i class="fa-solid fa-house"></i>
                  <span>Home</span>
              </a>
          </li>
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
      <!-- Main content goes here -->
      <div style="height:200px"></div>
      <div class="container">
  <div class="box">
    <h2><i class="fa-solid fa-users"></i></h2>
    <h2>Students: <?php echo $student_count; ?></h2>
  </div>
  <div class="box">
 <h2> <i class="fa-solid fa-chalkboard-user"></i></h2>
 <h2>Professors: <?php echo $professor_count; ?></h2>
  </div>
  <div class="box">
    <h2> <i class="fa-solid fa-book-open-reader"></i></h2>
    <h2>Courses: <?php echo $course_count; ?></h2>
  </div>
</div>
  </div>
  
  </body>
</html>
