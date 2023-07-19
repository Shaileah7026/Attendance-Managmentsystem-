<?php
require('../connect.php');

if (isset($_POST['sr_btn'])) {
    $srbatch = $_POST['sr_batch'];
    $srenrollment = $_POST['sr_enrollment'];
    $srname = $_POST['sr_name'];
}

function createTable($tableName, $conn)
{
    $createQuery = "CREATE TABLE IF NOT EXISTS `$tableName` (enrollment_no VARCHAR(30) NOT NULL, status VARCHAR(10) NOT NULL, PRIMARY KEY(enrollment_no))";
    if ($conn->query($createQuery)) {
        $_SESSION['table_created'] = true;
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

function insertAttendanceRecords($tableName, $attendus, $conn)
{
    foreach ($attendus as $enrollment => $status) {
        $enrollment = mysqli_real_escape_string($conn, $enrollment);
        $status = mysqli_real_escape_string($conn, $status);

        $query = "INSERT INTO `$tableName` (enrollment_no, status) VALUES ('$enrollment', '$status')";

        if (!$conn->query($query)) {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }
}

$attendus = isset($_POST['attendus']) ? $_POST['attendus'] : array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
    $time = isset($_POST['time']) ? $_POST['time'] : '';

    if (!empty($subject)) {
        $date = date('Y-m-d');
        $subjectTime = str_replace(' ', '_', $subject . '_' . $time);
        $tableName = $subjectTime . '_' . time() . '_' . $date;

      
        $tableExistsQuery = "SHOW TABLES LIKE '$tableName'";
        $tableExistsResult = $conn->query($tableExistsQuery);

        if ($tableExistsResult->num_rows === 0) {
            createTable($tableName, $conn);
        }

        insertAttendanceRecords($tableName, $attendus, $conn);
    }
}

function filterstd($srbatch, $srenrollment, $srname)
{
    global $conn;

    $query = "SELECT * FROM studentinfo WHERE 1";

    if (!empty($srbatch)) {
        $query .= " AND LOWER(batch) LIKE LOWER('%$srbatch%')";
    }

    if (!empty($srenrollment)) {
        $query .= " AND `enrollment no` = '$srenrollment'";
    }

    if (!empty($srname)) {
        $query .= " AND LOWER(name) LIKE LOWER('%$srname%')";
    }

    $result = $conn->query($query . " ORDER BY `enrollment no` ASC");

    if ($result && $result->num_rows > 0) {
        echo '<form method="post" action="">';
        echo '<table class="table table-striped table-hover">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Enrollment No.</th>';
        echo '<th scope="col">Name</th>';
        echo '<th scope="col">Batch</th>';
        echo '<th scope="col">Status</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($data = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $data['enrollment no'] . '</td>';
            echo '<td>' . $data['name'] . '</td>';
            echo '<td>' . $data['batch'] . '</td>';
            echo '<td>';
            echo '<label class="radio-inline"><input class="m-2" type="radio" name="attendus[' . $data['enrollment no'] . ']" value="present">Present</label>';
            echo '<label class="radio-inline"><input class="m-2" type="radio" name="attendus[' . $data['enrollment no'] . ']" value="absent">Absent</label>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '<div class="form-group">';
        echo '<input type="submit" name="submit_attendance" class="btn btn-primary" style="border-radius:0%" value="Submit Attendance">';
        echo '</div>';
        echo '</form>';
    } else {
        echo "<p>No results found.</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Fill Attendance</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }

        .table-container {
            margin-top: 20px;
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
    </nav> <br> <br> <br>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>Attendance Management System</h1>
                <h1>Date: <?php echo date('d-m-Y'); ?></h1>
                <br><br>
                <form action="" method="post">
                <br>
                <h3>Filter Students</h3>
                <br>
                <div class="form-group">
                    <label>Batch</label>
                    <input type="text" name="sr_batch" class="form-control">
                </div>
                <div class="form-group">
                    <label>Enrollment Number</label>
                    <input type="text" name="sr_enrollment" class="form-control">
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="sr_name" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="sr_btn" class="btn btn-danger m-2" style="border-radius:0%" value="Search">
                </div>
            </form>
            <h3>Enter Lecture Details</h3>
                <br>
                <form method="post" action="">
                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="subject" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Time</label>
                    <select name="time" class="form-control" required>
                        <option>10:00 - 11:00</option>
                        <option>11:00 - 12:00</option>
                        <option>12:40 - 1:40</option>
                        <option>1:40 - 2:40</option>
                        <option>2:50 - 3:50</option>
                        <option>3:50 - 4:50</option>
                    </select>
                </div>
                
                <br>
                <div class="table-container">
                    <?php
                    if (isset($_POST['sr_btn'])) {
                        filterstd($srbatch, $srenrollment, $srname);
                    } else {
                        echo "<p>No results found.</p>";
                    }
                    ?>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
