<?php

error_reporting(0);
include('connection.php');

//insert query
$id = $_GET['editid'];
if($id==""){
if (isset($_POST['submit'])) {

    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $course = mysqli_real_escape_string($conn, $_POST['cname']);
    $imgname = $_FILES['image']['name'];
    $tmpname = $_FILES['image']['tmp_name'];
    $path = "uploads/" . $imgname;
    move_uploaded_file($tmpname, $path);


    $insert = "INSERT INTO ws_students(fname,lname,contact,email,course_name,photo) VALUES('$fname', '$lname', '$contact','$email','$course','$imgname')";
    $result = mysqli_query($conn, $insert);

    if ($result) {
        echo "Data inserted successfully..";
            header("Location:view-student.php");
    } else {
        echo "insert error" . mysqli_error($conn);
    }
  
}
}
else{

//update query
//$id = $_GET['editid'];
$select = "SELECT * FROM ws_students WHERE id='$id'";
$exe = mysqli_query($conn, $select);
$fetchdata = mysqli_fetch_assoc($exe);
    if (isset($_POST['submit'])) {
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $contact = mysqli_real_escape_string($conn, $_POST['contact']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $course = mysqli_real_escape_string($conn, $_POST['cname']);

        $imgname = $_FILES['image']['name'];
        if ($imgname!== "") {
            $tmpname = $_FILES['image']['tmp_name'];
            $path = "uploads/" . $imgname;
            move_uploaded_file($tmpname, $path);

            $update = "UPDATE ws_students SET fname='$fname', lname='$lname', contact='$contact', email='$email', course_name='$course', photo='$imgname' WHERE id='$id'";
        } else {
            $update = "UPDATE ws_students SET fname='$fname', lname='$lname', contact='$contact', email='$email', course_name='$course' WHERE id='$id'";

        }
            if (mysqli_query($conn, $update)) {
                echo "Data Updated successfully..";
            header("Location:view-student.php");
            } else {
                echo "Update error" . mysqli_error($conn);
            }
        }
    
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
   
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


    <style>
        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background-color: #343a40;
            min-height: 100vh;
            color: #fff;
            position: fixed;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
        }

        .sidebar .nav-item {
            padding: 10px;
        }

        .content {
            margin-left: 400px;
            margin-right: 250px;
            padding: 20px;
        }

        h3 {
            margin-top: 20px;
        }

        .form-container {
            border: 1px solid #fff;
            box-shadow: 0 2px 10px black;
            padding: 20px;
            background-color: #fff;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2 class="text-center py-4">Admin Dashboard</h2>
        <ul class="nav flex-column">
            <li class="nav-item">
                <i class="fa fa-folder"></i>
                <a class="nav-link" href="index.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add-student.php">Add Student</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="view-student.php">View Student</a>
            </li>
        </ul>
    </div>
    <div class="content">
        <h3>Add Student</h3>
        <div class="form-container">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fName">First Name</label>
                        <input type="text" class="form-control" name="fname" value="<?php echo $fetchdata['fname'] ?>"
                            placeholder="Enter first name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lName">Last Name</label>
                        <input type="text" class="form-control" name="lname" value="<?php echo $fetchdata['lname'] ?>"
                            placeholder="Enter last name" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="contact">Contact</label>
                        <input type="text" class="form-control" name="contact" value="<?php echo $fetchdata['contact'] ?>"
                            placeholder="Enter contact number" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email"
                            value="<?php echo $fetchdata['email'] ?>" placeholder="Enter email address" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="courses">Select Course</label>
                        <select class="form-control" name="cname">
                            <option value="">Select Course</option>
                            <option value="php" <?php if ($fetchdata['course_name'] == "php") { echo "selected";} ?>>PHP
                            </option>
                            <option value="java"<?php if ($fetchdata['course_name'] == "java") {echo "selected"; } ?>>JAVA</option>
                            <option value="python" <?php if ($fetchdata['course_name'] == "python") {echo "selected";} ?>>PYTHON</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="photo">Photo</label>
                        <input type="file" class="form-control" name="image">
                        <img src="uploads/<?php echo $fetchdata['photo']; ?>" width="70px" height="70px" alt="">
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>