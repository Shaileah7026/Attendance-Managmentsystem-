<?php
require('../connect.php');

    if (isset($_POST['delete'])) {
        $phone = $_POST['delete_phone'];
        $query = "DELETE FROM teacherinfo WHERE `phone` = '$phone'";
        $result = $conn->query($query);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Attendance Management System</title>
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
        <h1>All Teachers</h1>
        <div class="row">
            <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">User Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Retrieve all teacher records
                        $query = "SELECT * FROM teacherinfo";
                        $result = $conn->query($query);

                        if ($result && $result->num_rows > 0) {
                            while ($data = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $data['username'] . '</td>';
                                echo '<td>' . $data['email'] . '</td>';
                                echo '<td>' . $data['password'] . '</td>';
                                echo '<td>' . $data['phone'] . '</td>';
                                echo '<td><form method="post" action="">
                                    <input type="hidden" name="delete_phone" value="' . $data['phone'] . '">
                                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                </form></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo "<tr><td colspan='3'>No results found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>
