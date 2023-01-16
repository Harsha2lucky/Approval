<?php
    ob_start();
    session_start();
    require_once('../server/connection.php');
    $stID = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Proposal</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <h3 class="center">
                Propose a Project
            </h3>
        </div>
        <section class="form">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <input type="text" name="title" class="form-control col-5" placeholder="Project Title" required>
                    &emsp;&emsp;&emsp;&emsp;
                    <input type="number" name="batch" class="form-control col-6" placeholder="Project Batch" required >
                </div>
                <div class="form-group row">
                    <input type="text" name="course" class="form-control col-5" placeholder="Project Course" required>
                    &emsp;&emsp;&emsp;&emsp;
                    <input type="text" readonly class="form-control col-6" placeholder="Your Student ID is: <?php echo $stID?>">
                </div>
                <div class="form-group row">
                    <select name="year" class="form-control col-3">
                        <option value="2020">2022</option>
                        <option value="2019">2021</option>
                        <option value="2018">2020</option>
                        <option value="2017">2019</option>
                    </select>
                    &emsp;&emsp;&emsp;&emsp;&emsp;  
                </div>
                <div class="form-group row">
                    <label for="faculty" class="col-1 col-form-label">FACULTY</label>
                    <select name="faculty" class="col-5 form-control">
                        <?php
                            $sql = "SELECT faculty_ID , faculty_FIRST_NAME , faculty_LAST_NAME FROM faculty_record";
                            $result = $conn->query($sql);
                            $rows = $result->num_rows;
                            if($rows >= 1){
                                while($data = $result->fetch_assoc()){
                                    $id = $data['faculty_ID'];
                                    $name = $data['faculty_FIRST_NAME'] . " " . $data['faculty_LAST_NAME'];
                                    echo "<option value='${id}'>${name}</option>";
                                }
                            }
                        ?>  
                    </select>
                    &emsp;&emsp;&emsp;
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <input type="submit" name="propose" value="Propose" class="btn btn-outline-primary right">
            </form>
        </section>
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
</body>
</html>

<?php
        if(isset($_POST['propose'])){
            $title= $_POST['title'];
            $batch= $_POST['batch'];
            $course= $_POST['course'];
            $year= $_POST['year'];
            $faculty = $_POST['faculty'];
            $document = '';
            $file = $_FILES['fileToUpload'];
            $fileName = $file['name'];
            $fileTempName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = $file['type'];
            $fileExt = explode('.',$fileName);
            $fileActulaExtension = strtolower(end($fileExt));
            $allowed = array('jpg','jpeg','png','pdf','html','css','csv','docx');
            if(in_array($fileActulaExtension,$allowed)){
                if($fileError === 0){
                    if($fileSize < 5000000){
                        $fileNameNew = uniqid('',true) . '.' . $fileActulaExtension;
                        $fileDestination = '../server/uploads/'.$fileNameNew;
                        move_uploaded_file($fileTempName,$fileDestination);
                        $document = $fileDestination;
                        $sql = "INSERT INTO project_record (project_ID, student_ID, faculty_ID, project_TITLE, project_YEAR, project_PROFESSOR, project_BATCH, project_COURSE, project_COMMENT, project_STATUS, project_file) VALUES (NULL, ${stID}, ${faculty}, ${title}, ${year}, NULL, ${batch}, ${course}, NULL, 0, ${document})";
                        if($conn->query($sql) === true){
                            header("Location: ./");
                        }else{
                            echo '<div class="alert alert-danger center" role="alert" >'. $conn->error .'</div>';
                        }
                    }else
                        echo "Don't upload GIGANTIC FILEs";
                }
            }else
                echo "This type is not accepted, please use either pdf,txt or doc";
        }
        ob_end_flush();
?>