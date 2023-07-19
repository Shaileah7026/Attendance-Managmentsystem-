<?php

require('connect.php');

if (isset($_POST['signup'])) {
    if (empty($_POST['email'])) {
        $error_msg = "Email can't be empty.";
    } elseif (empty($_POST['uname'])) {
        $error_msg = "Username can't be empty.";
    } elseif (empty($_POST['pass'])) {
        $error_msg = "Password can't be empty.";
    } elseif (empty($_POST['phone'])) {
        $error_msg = "Phone number can't be empty.";
    } else {

        require('connect.php');
        $query = "INSERT INTO teacherinfo (username, password, email, phone) VALUES ('" . $_POST['uname'] . "', '" . $_POST['pass'] . "', '" . $_POST['email'] . "', '" . $_POST['phone'] . "')";

        if ($conn->query($query)) {
            $success_msg = "Signup Successfully!";
        } else {
            $error_msg = "Error executing query: " . $mysqli->error;
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
<title>Sing Up</title> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<header>

  <h1 class="text-center">Attendance Management System</h1>

</header>
<br><br>
<h1 class="text-center">Signup</h1>
<br>
<div class="content">

  <div class="row">
    <?php
    if(isset($success_msg)) echo $success_msg;
    if(isset($error_msg)) echo $error_msg;
     ?>
    <form method="post" class="form-horizontal col-md-10 offset-md-3">

    <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Username</label>
          <div class="col-sm-7">
            <input type="text" name="uname"  class="form-control" id="input1" placeholder="Choose Username" required/>
          </div>
      </div>


      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-7">
            <input type="email" name="email"  class="form-control" id="input1" placeholder="Your Email" required/>
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Password</label>
          <div class="col-sm-7">
            <input type="password" name="pass"  class="form-control" id="input1" placeholder="Enter Password" required/>
          </div>
      </div>
      
      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Phone Number</label>
          <div class="col-sm-7">
            <input type="number" name="phone"  class="form-control" id="input1" placeholder="Phone Number" required/>
          </div>
      </div>

      <input type="submit" style="border-radius:0%" class="btn btn-primary col-md-2 m-3" value="Signup" name="signup" />
      <br>
      <p><strong>Already have an account? <a href="index.php">Login</a> here.</strong></p>
    </form>
  </div>

</div>


</body>
</html>
