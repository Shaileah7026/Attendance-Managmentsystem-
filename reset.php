<?php
include('connect.php');
if (isset($_POST['reset'])) {
    $email = $_POST['email'];
    $newPassword = $_POST['new_password'];
    $username = $_POST['username'];

    if (empty($email) || empty($newPassword) || empty($username)) {
        $error = "Email, username, and new password are required.";
    } else {
       
        $query = $conn->query("SELECT * FROM teacherinfo WHERE email = '$email' AND username = '$username'");
        $row = $query->num_rows;
        if ($row == 0) {
            $error = "Invalid email or username.";
        } else {
           
            $query = $conn->query("UPDATE teacherinfo SET password = '$newPassword' WHERE email = '$email' AND username = '$username'");
            if ($query) {
                $success_msg = "Password updated successfully!";
            } else {
                $error = "Failed to update password: " . mysqli_error($conn);
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Your Password</title>
</head>
<body>
    <header>
        <div class="navbar text-center">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <h1>Attendance Management System</h1>
            <a href="index.php">Login</a>
        </div>
    </header>
    <br><br><br>
        <div class="content col-md-8 offset-md-2">
        <?php
                if (isset($error)) {
                    echo '<div class="content"><p>' . $error . '</p></div>';
                } elseif (isset($success_msg)) {
                    echo '<div class="content"><p>' . $success_msg . '</p></div>';
                }
                ?>
            <div class="row">
                <form method="post" class="form-horizontal">
                    <h3>Recover your password</h3>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" class="form-control"  placeholder="Your username" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control"  placeholder="Your email" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">New Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="new_password" class="form-control" placeholder="Your new password" required>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary m-3 col-md-2 offset-md-5" value="Go" name="reset" />
                </form>
                <br>
              
            </div>
        </div>
</body>
</html>
