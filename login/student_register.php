<?php
    session_start();
    require_once('../server/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container container-fluid">
        <div class="jumbotron">
            <h1 class="center">STUDENT Register</h1>
        </div>
        <nav>
            <span class="right">FACULTY? <a href="./faculty_login.php">Login</a></span>
        </nav>
        <br><br>
        <div class="center-half">
            <form method="post" action="#">
                <div class="form-group">
                    <label for="studentFName" class="left">Student First Name</label>
                    <input type="text" name="studentFName" class="form-control" id="studentFName" required>
                </div>
                <div class="form-group">
                    <label for="studentLName" class="left">Student Last Name</label>
                    <input type="text" name="studentLName" class="form-control" id="studentLName" required>
                </div>
                <div class="form-group">
                    <label for="studentEmail" class="left">Student Email</label>
                    <input type="email" name="studentEmail" class="form-control" id="studentEmail" required>
                </div>
                <div class="form-group">
                    <label for="pwd" class="left">Password</label>
                    <input type="password" name="pwd" class="form-control" id="pwd" required>
                </div>
                <div class="left">
                    <a href="./student_login.php" class="btn btn-outline-secondary">Sign In</a>
                </div>
                <div class="right">
                    <input type="submit" name='register' value="Sign Up" class="btn btn-outline-primary">
                </div>
            </form>
        </div>
        <div class="container text-center">
                <div class="row justify-content-center">
                   <footer id="sticky-footer" class="flex-shrink-0 py-3 text-black-50">
                      <div class="container text-center">
                           <small>Copyright &copy; BATCH-1A</small>
                      </div>
                    </footer>
                </div>
         </div>
        <br><br><br>
        <?php
            if(isset($_POST['register'])){
                $fName = $_POST['studentFName'];
                $lName = $_POST['studentLName'];
                $email = $_POST['studentEmail'];
                $pwd = $_POST['pwd'];
                $sql = "INSERT INTO student_record (student_ID, student_EMAIL, student_FIRST_NAME, student_LAST_NAME, student_PASSWORD) VALUES (NULL, '${email}', '${fName}', '${lName}', '${pwd}')";
                if ($conn->query($sql) === TRUE) {
                    $last_id = $conn->insert_id;
                    $_SESSION['logged_in'] = true;
                    $_SESSION['role'] = 'student';
                    $_SESSION['fname'] = $fName;
                    $_SESSION['lname'] = $lName;
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $last_id;
                    echo '<div class="alert alert-success center" role="alert">Account Created Successfully, Your ID is: '.$_SESSION['id'].'</div>';
                    echo '<div class="alert alert-success center" role="alert">Your Application is Now waiting for Approval by FACULTY</div>';
                } else {
                    echo '<div class="alert alert-danger center" role="alert" >'. $conn->error .'</div>';
                }
                $conn->close();
            }
        ?>
    </div>
</body>
</html>
