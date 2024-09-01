<?php

include('connection.php');
error_reporting(0);

//Filter Course
$where = '';
if (isset($_POST['search'])) {
    $course = $_POST['cname'];
    if ($course != "") {
        $where .= "and course_name='$course'";
    }

    $fname = $_POST['fname'];
    if ($fname != "") {
        $where .= "and fname Like '%$fname%'";
    }
}

//Delete Query
    $id = $_GET['deleteid'];
    if ($id!== "") {

    $seldata = "SELECT photo from ws_students where id='$id'";
    $exedata = mysqli_query($conn, $seldata);
    $fetchdata = mysqli_fetch_assoc($exedata);

    $imagepath = "uploads/" . $fetchdata['photo'];
    unlink($imagepath);
        
        $delete = "DELETE FROM ws_students WHERE id='$id'";
        mysqli_query($conn, $delete);

    }

//Multiple Delete use for image
//Method 1
if(isset($_POST['Delete'])){
$id = $_POST['del'];
$totalid = count($id);
    for ($i = 0; $i < $totalid; $i++) {
        $delid = $id[$i];
        $seldata = "SELECT photo from ws_students where id='$delid'";
        $exedata = mysqli_query($conn, $seldata);
        $fetchdata = mysqli_fetch_assoc($exedata);

        $imagepath = "uploads/" . $fetchdata['photo'];
        unlink($imagepath);
    }
}

//Method 2 best method
if(isset($_POST['Delete'])){
    $id = $_POST['del'];
    $ids = implode(",", $id);
    $deleteids = "DELETE FROM ws_students WHERE id IN($ids)";
    mysqli_query($conn,$deleteids);
}

//order by 1

// if(isset($_POST['setorder'])){
//     $fieldname=$_POST['fieldname'];
//     $ordertype= $_POST['selectorder'];

//     if($fieldname!="" && $ordertype!=""){
//     $order="ORDER BY $fieldname $ordertype";
//     }
// }


//Status Update
$sid = $_GET['statusid'];
$status = $_GET['status'];

if($sid!="" && $status!=""){
    $update = "UPDATE ws_students set status='$status' where id='$sid'";
    mysqli_query($conn, $update);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student</title>
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
            margin-left: 250px;
            padding: 20px;
        }
        th{
            background-color: lightgrey;
        }
        h3{
            margin-top: 20px;
        }
        table{
            margin-top: 30px;
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
        <h3 style="text-align:center">View Course :</h3>
        <form action="" method="POST">
            <center>
                 <b><label for="name">First Name :</label></b>
                 <input type="text" name="fname">
                <b><label for="courses">Select Course :</label></b>
                        <select name="cname">
                            <option value="">Select Course</option>
                            <option value="php">PHP</option>
                            <option value="java">JAVA</option>
                            <option value="python">PYTHON</option>
                        </select>
                   <input type="submit" value="Search" class="btn btn-danger" name="search">
            </center></form>
            <form action="" method="">
                <select name="fieldname" >
                    <option value="">Select Field</option>
                     <option value="id">STUDENT ID</option>
                      <option value="fname">STUDENT FNAME</option>
                       <option value="course_name">STUDENT COURSE</option>
                </select>
                <select name="selectorder">
                    <option value="">Select Order</option>
                    <option value="ASC">ASC</option>
                    <option value="DESC">DESC</option>
                </select>
                <input type="submit" name="setorder" value="Set Order">
            </form>
        <form action="" method="POST">
        <table class="table table-bordered table-striped ">
            <thead>
                <tr>
                    <th><input type="submit" class="btn btn-danger" name="Delete" value="Delete"></th>
                    <th>Sr.No</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Course Name</th>
                    <th>Photo</th>
                    <th>Reg Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $select = "SELECT * FROM ws_students WHERE 1=1 $where $order";
                $exe = mysqli_query($conn, $select);
                
                while($fetch=mysqli_fetch_assoc($exe)){

                
                ?>
                <tr>
                    <td><input type="checkbox" value="<?php echo $fetch['id']; ?>" name="del[]"></td>
                    <td><?php echo $fetch['id'];?></td>
                    <td><?php echo $fetch['fname']; ?></td>
                    <td><?php echo $fetch['lname']; ?></td>
                    <td><?php echo $fetch['contact']; ?></td>
                    <td><?php echo $fetch['email']; ?></td>
                    <td><?php echo $fetch['course_name']; ?></td>
                    <td><img src="uploads/<?php echo $fetch['photo']; ?>" width="70px" height="70px" alt=""></td>
                    <td><?php echo $fetch['regdate']; ?></td>
                    <td>
                        <?php 
                        if($fetch['status']==1){
                        
                        ?>
                     <a href="view-student.php?statusid=<?php echo $fetch['id']; ?>&status=0">
                    <button type="button" class="btn btn-success">Active</button></a>
                  </td>
                    <?php } else {
                            ?>
                    <a href="view-student.php?statusid=<?php echo $fetch['id']; ?>&status=1">
                    <button type="button" class="btn btn-danger">Deactive</button></a>
                </td>
                    <?php }?>

                    <td>
                         <a href="view-student.php?deleteid=<?php echo $fetch['id']; ?>">
                            <button type="button" class="btn btn-danger">Delete</button></a>
                        <a href="add-student.php?editid=<?php echo $fetch['id']; ?>">
                          <button type="button" class="btn btn-primary">Edit</button></a>
                    </td>
                  
                </tr>
                <?php } ?>
            
            </tbody>
        </table>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
