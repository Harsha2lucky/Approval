<?php
    if(isset($_SESSION['role'])){
        switch($_SESSION['role']){
            case 'student':{
                $id = $_SESSION['id'];
                $sql = "SELECT status FROM student_record WHERE student_ID = ${id}";
                $result = $conn->query($sql);
                $data = $result->fetch_assoc();
                $status = $data['status'];
                if($status)
                    header("Location: ../student/");
                break;
            }
            case 'faculty':{
                header("Location: ../faculty/");
                break;
            }
        }
    }
?>