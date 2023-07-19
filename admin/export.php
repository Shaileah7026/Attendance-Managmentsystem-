<!DOCTYPE html>
<html>
<head>
    <title>Table Export</title>
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

    <div class="container">
        <h1>Tables</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Table Name</th>
                    <th>Export</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require('../connect.php');
                $q = "SHOW TABLES";
                $result = $conn->query($q);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_array()) {
                        $tableName = $row[0];
                        $exportURL = "http://localhost/phpmyadmin/index.php?route=/table/export&db=$database&table=$tableName&single_table=true";

                        echo '<tr>';
                        echo '<td>' . $tableName . '</td>';
                        echo '<td><a class="btn btn-primary" href="' . $exportURL . '">Export</a></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="2">No tables found in the database.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
