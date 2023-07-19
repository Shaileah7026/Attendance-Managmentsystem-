<?php

include('connect.php');

if (isset($_POST['login'])) {
    
        if (empty($_POST['uname'])) {
            $error_msg = "Username is required!";
        }
        if (empty($_POST['password'])) {
            $error_msg = "Password is required!";
        }
        if($_POST['uname'] === 'admin' && $_POST['password'] === 'admin')
        {
            header('location: admin/index.php');
        }
        
        
        
        $row = 0;
        $query = "SELECT * FROM teacherinfo WHERE username = '" . $_POST['uname'] . "' AND password = '" . $_POST['password'] . "'";
        $result = $conn->query($query);
        $row = $result->num_rows;

        if ($row > 0) {
            session_start();
            $_SESSION['uname'] = $_POST['uname'];
            header('location: teacher/index.php');
        } else {
            $error_msg = "Username or password is wrong, try again!";
        }
}

?>



<!DOCTYPE html>
<html>
<head>

	<title>Login</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>

<body>
<header>
  <h1 class="text-center">Attendance Management System</h1>
</header>
<br><br><br>

<div class="container offset-md-4 col-md-10">
<h3>Login Panel</h3>
<br>

<?php
if(isset($error_msg))
{
	echo $error_msg;
}
?>

<div class="content">
	<div class="row">

		<form method="post" class="form-horizontal col-md-6 col-md-offset-3">
			<div class="form-group">
			    <label class="col-sm-3 control-label">Username</label>
			    <div class="col-sm-7">
			      <input type="text" name="uname"  class="form-control col-md-12"  placeholder="Your Username" />
			    </div>
			</div>

			<div class="form-group">
			    <label class="col-sm-3 control-label">Password</label>
			    <div class="col-sm-7">
			      <input type="password" name="password"  class="form-control col-md-12"  placeholder="Your Password" />
			    </div>
			</div>

			<input type="submit" class="btn btn-success col-md-6 m-3" style="border-radius:0%" value="Login" name="login" />
		</form>
	</div>
</div>

<p><strong><a href="reset.php" style="text-decoration:none;">Reset Password</a></strong></p>
<p><strong><a href="signup.php" style="text-decoration:none;">Create New Account</a></strong></p>
</div>

</body>
</html>