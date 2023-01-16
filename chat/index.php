<?php
    session_start();
    require_once("../server/connection.php");
    $myID = $_SESSION['id'];
    $stdID = $_GET['facultyID'];
    $facultyID = $_GET['stdID'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <h2>Chat Messages</h2>
    <div class="left"><a href="../" class='btn btn-primary'>Go Back</a></div><br><br>
    <?php
        $sql = "SELECT * FROM student_faculty_chat WHERE student_id = ${stdID} AND faculty_id = ${facultyID} ORDER BY student_faculty_chat.message_id ASC";
        $result = $conn->query($sql);
        $rows = $result->num_rows;
        if($rows>=1){
            while($data = $result->fetch_assoc()){
                $messageBody = $data['message_body'];
                $messageSender = $data['message_sender'];
                $currentRole;
                if($_SESSION['role'] === 'faculty'){
                    $currentRole = 'f';
                }else{
                    $currentRole = 's';
                }
                if($currentRole === $messageSender)
                    echo "<div class='container'><p class='right'>";
                else
                    echo"<div class='container darker'><p class='left'>";
                echo "${messageBody}</p></div>";
            }
        }
    ?>
    <form action="./index.php?facultyID=<?php echo $facultyID?>&stdID=<?php echo$stdID?>" method="post">
        <div class="form-group">
            <input type="text" name="message" class="form-control form-control-lg" required>
            <input type="submit" name='send' value="Send" class="btn btn-primary btn-lg right mt-3">
        </div>
    </form>
</body>
</html>

<?php
    if(isset($_POST['send'])){
        $role;
        if($_SESSION['role'] === 'faculty'){
            $role = 'f';
        }else{
            $role = 's';
        }
        $messageBody = $_POST['message'];
        $sql = "INSERT INTO student_faculty_chat (message_id, student_id, faculty_id, message_body, message_sender) VALUES (NULL, ${stdID}, ${facultyID}, ${messageBody},${role})";
        if($conn->query($sql) === false){
        echo '<div class="alert alert-danger" role="alert">
        Message wasn\'t sent
        </div>';
        }
    }
?>


