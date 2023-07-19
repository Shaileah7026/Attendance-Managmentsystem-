<?php
require('../connect.php');

if (isset($_POST['addstudent'])) {
    $result = $conn->query("INSERT INTO studentinfo (`enrollment no`, name, class, batch) VALUES ($_POST[er],'$_POST[name]','$_POST[class]','$_POST[batch]')");
    $success_msg = "Student added successfully.";
}

if (isset($_POST['addteacher'])) {
    $result = $conn->query("INSERT INTO teacherinfo (username, password, email, phone) VALUES ('".$_POST['uname']."', '".$_POST['password']."', '".$_POST['email']."', '".$_POST['phone']."')");
    $success_msg = "Teacher added successfully.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Attendance Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style type="text/css">
        .message {
            padding: 10px;
            font-size: 15px;
            font-style: bold;
            color: black;
        }
    </style>
</head>
<body>
<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Attendance Management System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar-collapse">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Add Teacher/Add Student</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="v-students.php">View Students</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="v-teachers.php">View Teachers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="export.php">Export</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br><br><br>
</header>

<div class="container">
    <div class="message">
        <?php if (isset($success_msg)) echo $success_msg;
        if (isset($error_msg)) echo $error_msg; ?>
    </div>

    <div class="content">
        <div class="row" id="student">
            <form method="post" class="form-horizontal col-md-8 offset-md-2">
                <h4>Add Student</h4>
                <div class="form-group row">
                    <label for="input1" class="col-sm-3 col-form-label">Enrollment no:</label>
                    <div class="col-sm-7">
                        <input type="text" name="er" class="form-control" placeholder="Student reg. no." required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="input1" class="col-sm-3 col-form-label">Name:</label>
                    <div class="col-sm-7">
                        <input type="text" name="name" class="form-control" placeholder="Student full name" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="input1" class="col-sm-3 col-form-label">Class:</label>
                    <div class="col-sm-7">
                        <input type="text" name="class" class="form-control" placeholder="Enter your class" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="input1" class="col-sm-3 col-form-label">Batch:</label>
                    <div class="col-sm-7">
                        <input type="text" name="batch" class="form-control" placeholder="Enter your Batch" required>
                    </div>
                </div>
                <br>
                <input type="submit" class="btn btn-primary col-md-3 offset-md-4" value="Add Student"
                       name="addstudent"/>
            </form>
        </div>

        <br><br><br>

        <div class="row" id="teacher">
            <form method="post" class="form-horizontal col-md-8 offset-md-2">
                <h4>Add Teacher</h4>

                <div class="form-group row">
                    <label for="input1" class="col-sm-3 col-form-label">User Name:</label>
                    <div class="col-sm-7">
                        <input type="text" name="uname" class="form-control" placeholder="Enter User Name" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="input1" class="col-sm-3 col-form-label">Password:</label>
                    <div class="col-sm-7">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password"
                               required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="input1" class="col-sm-3 col-form-label">Email:</label>
                    <div class="col-sm-7">
                        <input type="email" name="email" class="form-control" placeholder="Enter Your email" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="input1" class="col-sm-3 col-form-label">Phone:</label>
                    <div class="col-sm-7">
                        <input type="text" name="phone" class="form-control" placeholder="Enter Your Phone Number"
                               pattern="[0-9]{10}" minlength="10" maxlength="10" required>
                    </div>
                </div>
                <br>
                <input type="submit" class="btn btn-primary col-md-3 offset-md-4" value="Add Teacher"
                       name="addteacher"/>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
