<!DOCTYPE html>
<html lang="en">
<head>
    <title>Attendance Management System</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Attendance Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="students.php">Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="attendance.php">Attendance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addstudent.php">Add Student</a>
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
  
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="jumbotron text-center">
                <h2>Welcome, <strong style="color:red"><?php session_start(); echo $_SESSION['uname']; ?></strong></h2>
                <p>Manage your attendance with ease!</p>
                <p>Explore the features of our Attendance Management System and keep track of your attendance records.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="offset-md-2 col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h3 class="card-title">Students</h3>
                    <p class="card-text">View, add, and manage student information.</p>
                    <a href="students.php" class="btn btn-primary">Go to Students</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h3 class="card-title">Attendance</h3>
                    <p class="card-text">Track and manage attendance records.</p>
                    <a href="attendance.php" class="btn btn-primary">Go to Attendance</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
