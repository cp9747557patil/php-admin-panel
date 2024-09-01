<?php

include('connection.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
     <head>
    <!-- Other meta tags and links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
</head>

    <style>
        body {
            display: flex;
        }

        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background-color: #343a40;
            min-height: 100vh;
            color: #fff;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
        }

        .sidebar .nav-item {
            padding: 10px;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .nav-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .caret {
             transition: transform 0.3s;  
             font-size: 24px; /* Increase the size as needed */
            line-height: 1;
            display: inline-block;
          }
        .caret.collapse {
            transform: rotate(90deg);
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2 class="text-center py-4">Admin Dashboard</h2>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#studentMenu" role="button" aria-expanded="false"
                    aria-controls="studentMenu">
                 <i class="fa fa-folder"></i>
                    STUDENTS<span class="caret">&#9662;</span>
                </a>
                <div class="collapse" id="studentMenu">
                    <ul class="nav flex-column ml-3">
                        <li class="nav-item">
                            <a class="nav-link" href="add-student.php">Add Student</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view-student.php">View Student</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <div class="content">
        <h3>Welcome to Admin Dashboard</h3>

    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#studentMenu').on('show.bs.collapse', function () {
                $(this).prev().find('.caret').css('transform', 'rotate(180deg)');
            }).on('hide.bs.collapse', function () {
                $(this).prev().find('.caret').css('transform', 'rotate(90deg)');
            });
        });
    </script>
</body>

</html>