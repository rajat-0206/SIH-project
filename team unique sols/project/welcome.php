<?php
    include("connect.php");
    include("header1.php");
    

    if(!isset($_SESSION['loggedin'])){
        //echo "pass1";
        header("location:login.php");
    }
    //echo "pass2";
    
    //$_SESSION['id'];
    
?>
<div class="container m-4">

<?php echo"<h2>  Hello!!! ".$_SESSION['username']." You Are Logged in now......</h2>" ?>
<div class="card border-dark mb-3" style="max-width: 18rem;">
  <div class="card-header">Header</div>
  <div class="card-body text-dark">
    <h5 class="card-title">Dark card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>    


</div>