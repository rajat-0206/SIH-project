<?php
    include("header1.php");
    include("connect.php");
    error_reporting(0);
    

    if(!isset($_SESSION['loggedin']))
    {
        //echo "pass1";
        header("location:login.php");
    }

    $msg = "";
    $Worker_matched="";
    $up = isset($_POST['submit_worker']);
    if(isset($_POST['submit_worker']))
    {   //echo "pass11";

        $error=array();
        $workername = $_POST["name"];
        $workerid = $_POST["w_id"];
        $workerage = $_POST["worker_age"];

        if($workername =="" or $workerid=="" or $workerage="")
        {
            array_push($error, "Please fill all the required fields.");
        }

        else if(!preg_match("/^[a-zA-Z ]*$/", $workername))
        {
            array_push($error,"Name should be in letters.");
        }

        else if(!is_numeric($workerid))
        {
            array_push($error,"Worker Id should be numeric.");
        }

        else
        {
        $query = "SELECT * FROM workers WHERE worker_id='$_POST[w_id]'";
        $result = mysqli_query($conn,$query);
        $result = mysqli_fetch_assoc($result);
        if($result['name'])
        {
            //echo "pass12";
            $Worker_matched = "Worker with this ID already Exists!!!";
        }
        else
        {
            //$sqli = "SELECT id FROM users WHERE username = ?";
           // $id = mysqli_query($conn,$sqli);

            // Get image name
            $image1 = $_FILES['image1']['name'];
            $image2 = $_FILES['image2']['name'];
            $image3 = $_FILES['image3']['name'];
            $image4 = $_FILES['image4']['name'];
            $image5 = $_FILES['image5']['name'];
            $image6 = $_FILES['image6']['name'];
            $image7 = $_FILES['image7']['name'];
            $image8 = $_FILES['image8']['name'];
            $image9 = $_FILES['image9']['name'];
            $image10 = $_FILES['image10']['name'];
            // image file directory
            

            $image1 = $_POST['w_id'].'-1.' . pathinfo($_FILES['image1']['name'],PATHINFO_EXTENSION);
            $image2 = $_POST['w_id'].'-2.' . pathinfo($_FILES['image2']['name'],PATHINFO_EXTENSION);
            $image3 = $_POST['w_id'].'-3.' . pathinfo($_FILES['image3']['name'],PATHINFO_EXTENSION);
            $image4 = $_POST['w_id'].'-4.' . pathinfo($_FILES['image4']['name'],PATHINFO_EXTENSION);
            $image5 = $_POST['w_id'].'-5.' . pathinfo($_FILES['image5']['name'],PATHINFO_EXTENSION);
            $image6 = $_POST['w_id'].'-6.' . pathinfo($_FILES['image6']['name'],PATHINFO_EXTENSION);
            $image7 = $_POST['w_id'].'-7.' . pathinfo($_FILES['image7']['name'],PATHINFO_EXTENSION);
            $image8 = $_POST['w_id'].'-8.' . pathinfo($_FILES['image8']['name'],PATHINFO_EXTENSION);
            $image9 = $_POST['w_id'].'-9.' . pathinfo($_FILES['image9']['name'],PATHINFO_EXTENSION);
            $image10 = $_POST['w_id'].'-10.' . pathinfo($_FILES['image10']['name'],PATHINFO_EXTENSION);
            
            
            $target1 = "images/".basename($image1);
            $target2 = "images/".basename($image2);
            $target3 = "images/".basename($image3);
            $target4 = "images/".basename($image4);
            $target5 = "images/".basename($image5);
            $target6 = "images/".basename($image6);
            $target7 = "images/".basename($image7);
            $target8 = "images/".basename($image8);
            $target9 = "images/".basename($image9);
            $target10 = "images/".basename($image10);

            
           // echo "pass33";
            
            if (
                move_uploaded_file($_FILES['image1']['tmp_name'], $target1) &&
                move_uploaded_file($_FILES['image2']['tmp_name'], $target2) &&
                move_uploaded_file($_FILES['image3']['tmp_name'], $target3) &&
                move_uploaded_file($_FILES['image4']['tmp_name'], $target4) &&
                move_uploaded_file($_FILES['image5']['tmp_name'], $target5) &&
                move_uploaded_file($_FILES['image6']['tmp_name'], $target6) &&
                move_uploaded_file($_FILES['image7']['tmp_name'], $target7) &&
                move_uploaded_file($_FILES['image8']['tmp_name'], $target8) &&
                move_uploaded_file($_FILES['image9']['tmp_name'], $target9) &&
                move_uploaded_file($_FILES['image10']['tmp_name'], $target10)
            ){  
                $msg = 1;
                $sql = "INSERT INTO workers (worker_id,admin_id,name,age,image1,image2,image3,image4,image5,image6,image7,image8,image9,image10,script) VALUES('$_POST[w_id]','$_SESSION[id]','$_POST[name]','$_POST[worker_age]','$image1','$image2','$image3','$image4','$image5','$image6','$image7','$image8','$image9','$image10','$_POST[script]')";
                
                // execute query
                mysqli_query($conn, $sql);
                echo "Worker added Successfully";
            }
            else
            {
                $msg = 0;
                echo $Worker_matched;
            }

        }
    }
}

?>


<div class="panel panel-default">

    <a class="btn btn-danger pull-right"  href="welcome.php"> Back </a>
    

    <div class="container">
    
        
        <?php 
        $err="";
        if($msg == 1 && $up) {
            $errr = "Image Uploaded Sucessfully..";
        }
        elseif($msg == 0 && $up)
        {
            array_push($error,"Failed to upload image.");
        }

        if($errr){
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>".$errr."<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
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


    <div class="m-4">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">Worker Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $workername;?>"aria-describedby="emailHelp">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Worker Unique Id</label>
                <input type="text" class="form-control" name="w_id" id="w_id" aria-describedby="emailHelp"  >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Age </label>
                <input type="number" class="form-control" name="worker_age" id="worker_age">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Text Uploader</label>
                <textarea class="form-control" name="script" id="script" placeholder="Write Here..." rows="3" ></textarea>
            </div>




            <div class="form-group">
                <input type="hidden" name="size" value="1000000">
                <input type="file" name="image1">
            </div>
            <div class="form-group">
                <input type="hidden" name="size" value="1000000">
                <input type="file" name="image2">
            </div>
            <div class="form-group">
                <input type="hidden" name="size" value="1000000">
                <input type="file" name="image3">
            </div>
            <div class="form-group">
                <input type="hidden" name="size" value="1000000">
                <input type="file" name="image4">
            </div>
            <div class="form-group">
                <input type="hidden" name="size" value="1000000">
                <input type="file" name="image5">
            </div>
            <div class="form-group">
                <input type="hidden" name="size" value="1000000">
                <input type="file" name="image6">
            </div>
            <div class="form-group">
                <input type="hidden" name="size" value="1000000">
                <input type="file" name="image7">
            </div>
            <div class="form-group">
                <input type="hidden" name="size" value="1000000">
                <input type="file" name="image8">
            </div>
            <div class="form-group">
                <input type="hidden" name="size" value="1000000">
                <input type="file" name="image9">
            </div>
            <div class="form-group">
                <input type="hidden" name="size" value="1000000">
                <input type="file" name="image10">
            </div>






            <input type="submit" name="submit_worker" value="submit" class="btn btn-primary" required>
        </form>



    </div>

</div>