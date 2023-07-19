<?php
require('../connect.php');

if (isset($_POST['delete'])) {
    $er = $_POST['delete_phone'];
    $delete_query = "DELETE FROM studentinfo WHERE `enrollment no` = '$er'";
    $conn->query($delete_query);
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
        echo '<table class="table table-striped table-hover">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Enrollment No.</th>';
        echo '<th scope="col">Name</th>';
        echo '<th scope="col">Batch</th>';
        echo '<th scope="col">Action</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($data = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $data['enrollment no'] . '</td>';
            echo '<td>' . $data['name'] . '</td>';
            echo '<td>' . $data['batch'] . '</td>';
            echo '<td>
                <form method="post" action="">
                    <input type="hidden" name="delete_phone" value="' . $data['enrollment no'] . '">
                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                </form>
            </td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo "<p>No results found.</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Attendance Management System</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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

<div class="col-md-10 offset-md-1">
    <h1>All Students</h1>

    <form method="post" action="">
        <div class="form-group">
            <label for="filter_batch">Batch:</label>
            <input type="text" class="form-control" id="filter_batch" name="filter_batch">
        </div>
        <div class="form-group">
            <label for="filter_enrollment">Enrollment No:</label>
            <input type="text" class="form-control" id="filter_enrollment" name="filter_enrollment">
        </div>
        <div class="form-group">
            <label for="filter_name">Name:</label>
            <input type="text" class="form-control" id="filter_name" name="filter_name">
        </div>
        <br>
        <button type="submit" name="filter" class="btn btn-primary offset-md-">Filter</button>
    </form>

    <?php
    if (isset($_POST['filter'])) {
        $srbatch = $_POST['filter_batch'];
        $srenrollment = $_POST['filter_enrollment'];
        $srname = $_POST['filter_name'];

        filterstd($srbatch, $srenrollment, $srname);
    } else {
        // Retrieve all student records
        $query = "SELECT * FROM studentinfo";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            echo '<table class="table table-striped table-hover">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col">Enrollment No.</th>';
            echo '<th scope="col">Name</th>';
            echo '<th scope="col">Batch</th>';
            echo '<th scope="col">Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($data = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $data['enrollment no'] . '</td>';
                echo '<td>' . $data['name'] . '</td>';
                echo '<td>' . $data['batch'] . '</td>';
                echo '<td>
                        <form method="post" action="">
                            <input type="hidden" name="delete_phone" value="' . $data['enrollment no'] . '">
                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                        </form>
                      </td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo "<p>No results found.</p>";
        }
    }
    ?>
</div>
</body>
</html>
