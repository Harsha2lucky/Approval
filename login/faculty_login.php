<?php
    session_start();
    require_once('../server/connection.php');
    require_once("../header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container container-fluid">
        <div class="jumbotron">
            <h1 class="center">FACULTY Login</h1>
        </div>
        <nav>
            <span class="right">Student? <a href="./student_login.php">Login</a></span>
        </nav>
        <br><br>
        <div class="center-half">
            <form method="POST" action="#">
                <div class="form-group">
                    <label for="facultyID" class="left">FACULTY ID</label>
                    <input type="number" name="facultyID" class="form-control" id="facultyID" required>
                </div>
                <div class="form-group">
                    <label for="pwd" class="left">Password</label>
                    <input type="password" name="pwd" class="form-control" id="pwd" required>
                </div>
                <div class="right">
                    <input type="submit" name="login" value="Login" class="btn btn-outline-primary">
                </div>
            </form>
        </div>
        <div class="container text-center">
                <div class="row justify-content-center">
                   <footer id="sticky-footer" class="flex-shrink-0 py-3 text-black-50">
                      <div class="container text-center">
                           <small>Copyright &copy; Your Website</small>
                      </div>
                    </footer>
                </div>
            </div>
        <br><br><br>
        <?php
            if(isset($_POST['login'])){
                $id = $_POST['facultyID'];
                $pwd = $_POST['pwd'];
                $sql = "SELECT *  FROM faculty_record WHERE faculty_ID = ${id} AND faculty_PASSWORD = ${pwd}";
                $result = $conn->query($sql);
                $rows = $result->num_rows;
                if($rows == 1){
                    $_SESSION['logged_in'] = true;
                    $_SESSION['role'] = 'faculty';
                    $_SESSION['id'] = $id;
                    header("Location: ./../faculty/");
                } else {
                    echo '<div class="alert alert-danger center" role="alert">Faculty with this credentials wasn\'t found</div>';
                }
                $conn->close();
            }
        ?>
    </div>
</body>
</html>