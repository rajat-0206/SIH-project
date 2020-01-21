<?php
  include('header.php');
    error_reporting(0);
  session_start();
  //$_SESSION['loggedin'] = false;
  if(isset($_SESSION['username'])){
    header("location: welcome.php");
    exit;
  }
  require_once "connect.php";

  $username = $password = "";
  $err  = "";
  $username_err = $password_err = "";


  if($_POST["login_submit"])
  {
    if(empty(trim($_POST['username'])))
    {
      $err = "Please enter the username.....";
      $username_err = "Please enter the username.....";
    }
    elseif(empty(trim($_POST['password'])))
    {
      $err = "Please enter password......";
      $password_err = "Please enter password......";
    }
    else
    {
      $username = trim($_POST['username']);
      $password = trim($_POST['password']);
    }
  }
  if(empty($username_err) && empty($password_err))
  {
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"s",$param_username);
    $param_username = $username;
    // executing statement
    if(mysqli_stmt_execute($stmt))
    {
      mysqli_stmt_store_result($stmt);
      if(mysqli_stmt_num_rows($stmt) == 1)
      {
        mysqli_stmt_bind_result($stmt,$id,$username,$hashed_password);
        if(mysqli_stmt_fetch($stmt))
        {
          if(password_verify($password,$hashed_password))
          {
            // all good ,,allow user to login
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $id ;
            $_SESSION['loggedin'] = true;
            
            // redirect to welcome page
            header("location: welcome.php");


          }

          else{
            $err = "Wrong Password";
              }
        }
      }

      else{
        $err = "No User with that Username";
          }
    }
  }
?>
<!-- Section for Error display modal-->
  <?php 
if($err!="" and $username!="")
{ 
echo "<div class='alert alert-warning alert-dismissible fade show' role='alert' style='margin:15px;'>";
echo "<h5>"."Error"."</h5>";
echo $err;
echo "<br>";
echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>"."&times;"."</span></button></div>"; 
}
?>

  <!-- Section for Forgot Password modal-->

  <div id="forgetModal" style="display:none;">
<div class="modal" style="display:block;background-color: rgba(0,0,0,0.3); ">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Forgot Password</h4>
          <button type="button" class="close" data-dismiss="modal" onclick="closeforgetModal()">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
 <form name="forgot" action="" method="post">
      <input type="text" name="verfify_phone" class="form-control" placeholder="Enter Username" required autofocus><br>
      <input type="text" name="verfify_pass" class="form-control" placeholder="Enter New password" required><br>
      <input type="text" name="verfify_confirm" class="form-control" placeholder="Enter confirm Password" required><br>
      <input type="submit" name="submit_forgot" style="float: right;" value="Submit" class="btn btn-primary" onclick="forgotpassword()">
    </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="closeforgetModal()">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  </div>

<!-- Main Website Section -->


<div class="container mt-4">
  <h4>Please Login Here...... </h4>
  <hr>

  <form action="" method="post">
    <div class="form-group">
      <label for="exampleInputEmail1">Username</label>
      <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Enter Username" id="exampleInputEmail1" aria-describedby="emailHelp" required autofocus>
    </div>
    <!--<div class="text-danger"><?php echo $username_err; ?></div>-->
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="password" class="form-control" placeholder="Enter Password" id="exampleInputPassword1" required>
         <div class="form-group form-check mt-2">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label " for="exampleCheck1">Check me out</label>
      <label class="form-check-label" style="margin-bottom:6px; float:right;color: #456; cursor: pointer;" onclick="openforgotmodal()">Forgot Password</div>
    </label>
    </div>
 

    <input  type="submit" name="login_submit" class="btn btn-dark mt-2">
  </form>   
</div>

<script type="text/javascript">
  



forgetmodal = document.getElementById("forgetModal");

function openforgotmodal(){

  forgetmodal.style.display="block";
}



function closeforgetModal(){

  forgetmodal.style.display="none";
}

function forgotpassword(){
  
}
/*
if(err!="" )
{ if(ut!="")
{
  errmodal.style.display="block";
}
}
*/

</script>