<?php
error_reporting(0);
include("header.php");
require_once "connect.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$err = "";

$error = array();

?>

<?php


//echo $password_err;

if($_POST["signup_submit"])//$_SERVER['REQUEST_METHOD'] == "POST" && $_POST["signup_submit"]);
{   //echo "posted";
    //username is empty
    $add1 = $_POST['inputAddress'];
    $city = $_POST['inputCity'];
    $zip = $_POST['inputZip'];
    $flag = 0;

    if($add1 =="" or $city =="" or $zip =="")
    {
      array_push($error, "Please fill all the required fields.");
      $flag=1;
    }

    if(!preg_match("/^[a-zA-Z ]*$/",$city))
    {
      array_push($error, "City should be in letters.");
      $flag=1;
    }

    if(is_numeric($zip)!=1 or strlen($zip)!='6')
    {
      array_push($error, "Invalid Pincode.");
      array_push($error, ($zip));
      array_push($error, is_numeric($zip));
      $flag=1;
    }

    if($flag==0)
    {

    if(empty(trim($_POST['username'])))
    {
        $username_err = "Username cannot be empty....";
        array_push($error, $username_err);
    }
    else
    {   //echo "pass1";
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn,$sql);
        if($stmt)
        {   //echo "pass2";
            mysqli_stmt_bind_param($stmt,"s",$param_username);

            //set param_username
            $param_username = trim($_POST['username']);

            //try executing stmt
            
            if(mysqli_stmt_execute($stmt))
            {   //echo "pass3";
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {   //echo "pass4";
                    $username_err = "This username is already taken.";
                    array_push($error,$username_err);

                }
                else
                {   //echo "pass5";
                    $username = trim($_POST['username']);
                }
            }
            else
            {   //echo "pass6";
                echo "Something went wrong..";
            }
        }
    }
    mysqli_stmt_close($stmt);


    // check for password

    if(empty(trim($_POST['password'])))
    {   //echo "pass7";
    $password_err = "Password cannot be blank.";
    array_push($error,$password_err);
    //echo $password_err;
    //header("location:register.php");
    }
    elseif(strlen(trim($_POST['password'])) < 5)
    {   //echo "pass8";
    $password_err = "Password Cannot be of less then 5 Characters.";
    array_push($error,$password_err);
    }
    else
    {   //echo "pass9";
        $password = trim($_POST['password']);

    }

    //check for confirm password
    if(trim($_POST['password']) != trim($_POST['confirm_password']))
    {   //echo "pass10";
        $confirm_password_err = "Password should have to match.";
        array_push($error,$confirm_password_err);
    }

    // if there is no error 

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
    {   //echo "pass11";
        $sql = "INSERT INTO users (username, password) VALUES(?,?)";
        $stmt = mysqli_prepare($conn,$sql);
        if($stmt)
        {   //echo "pass12";
            mysqli_stmt_bind_param($stmt,"ss",$param_username,$param_password);
            // setting parameters
            $param_username = $username;
            $param_password = password_hash($password,PASSWORD_DEFAULT);

            //  try to execute the query 

            if(mysqli_stmt_execute($stmt))
            {   //echo "pass13";
                header("location: login.php");
                echo "registered successfully";
            }
            else
            {  // echo "pass14";
                $err = "Something went wrong ...cannot redirect ....";
            }
        }
        mysqli_stmt_close($stmt);

    }
    else
    { /*  
      $username_err="";
      $password_err="";
      $err ="Please fill all the values correctly....";*/
    }
    mysqli_close($conn);
}
}

?>



<div class="container mt-4">
<h3>Please Register Here...... </h3>
<hr>
<?php
      if(!empty($err)){ 
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>".$err."<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
      }
      ?>

<?php 
if(count($error)!=0)
{ 
echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>";
echo "<h5>"."Error"."</h5>";
for($x=0; $x <count($error); $x++)
{
    echo $x+1;
    echo ".  ";
    echo $error[$x];
    echo "<br>";

}
echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>"."&times;"."</span></button></div>"; 
}
?>

<form action="" method="post">
  <div class="form-row">
    <div class="form-group col-md-6" required>
      <label for="inputEmail4">Username</label>
      <input type="text" name="username" value="<?php echo $username; ?>" class="form-control" id="inputEmail4" required>
      <!--<?php
     /* if(!empty($username_err)){ 
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>".$username_err."<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
      }*/
      ?>-->
    </div>
    <div class="form-group col-md-6" required>
      <label for="inputPassword4">Password</label>
      <input type="password" name="password"  class="form-control" id="inputPassword4" required>
     <!-- <?php
      /*if(!empty($password_err)){ 
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>".$password_err."<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
      }*/
      ?>-->
    </div>
    <div class="form-group col-md-6" required>
      <label for="inputPassword4">Confirm Password</label>
      <input type="password" name="confirm_password"  class="form-control" id="inputPassword" required>
      <!--<?php
     /* if(!empty($confirm_password_err)){ 
       echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>".$confirm_password_err."<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
      }*/
      ?>-->
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="1234 Main St" required="">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity" name="inputCity" required>
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Pincode</label>
      <input type="text" class="form-control" id="inputZip" name="inputZip" required>
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <input type="submit" name="signup_submit" class="btn btn-dark">
</form>


</div>
