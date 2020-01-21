<?php
session_start();
$name = $_SESSION['username'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Attendace System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <style type="text/css">

    #special {
      display: none;
    }
    @media screen and ( max-width:991px)
    {
        #special {
          display: block;
        }
    }
  </style>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="m-4">
<h2><div class="well text-center"> WORKERS ATTENDANCE SYSTEM </div> </h2>
</div>
<hr>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="welcome.php">Team Unique Solutions</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link " href="welcome.php">Home<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link " href="add.php">Add Workers<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link " href="details.php">View Attendance<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link " href="view_worker.php">Mark Attendance<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link " href="manage_worker.php">Manage Worker<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" id="special" href="logout.php">Logout<span class="sr-only">(current)</span></a>
      <!--<a class="nav-link" href="logout.php">LOGOUT</a>-->


    </div>
    <div class="navbar-collapse collapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
            <a class="nav-link" href="#"> <img src="https://img.icons8.com/dusk/32/000000/admin-settings-male.png"> <?php echo "Welcome ". $_SESSION['username']?></a>
            
          </li>

          <li class="nav-item active">
            <a class="nav-link" href="logout.php">
              <button class="btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Logout"> 
                <img src="https://img.icons8.com/color/32/000000/logout-rounded--v1.png">
              </button>
            </a>
          </li>   
      </ul>
    </div>
  </div>
    
</nav>


</body>
</html>
