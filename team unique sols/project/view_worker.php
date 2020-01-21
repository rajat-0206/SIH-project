<?php
    include("header1.php");
    include("connect.php");
    error_reporting(0);
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: welcome.php");
        exit;
    }
?>

<div class="container m-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="well-text"><h2 class="text-center">Admin ID : <?php echo $_SESSION['id'];?></h2></div>
            <div class="container m-4"><h3>List Of The Workers</h3>
                <div id="head" style="display: block;">
                <table class="table table-striped">
                    <thead class="table-dark">
                        
                            <th>Worker ID</th>
                            <th>Unique Id</th>
                            <th>Worker Name</th>
                            <th>Worker's Age</th>
                            <th>Mark Attendance</th>
                        
                    </thead>
                    <tbody id="response"></tbody>


                </table>  
                </div>  
            </div>
            <div class="container m-4" id="msg" style="display: block;"><center><h3><kbd>No Data to Display</kbd></h3></center></div>
            <form action="present.php" method="post">
                <input type="text" name="worker_id" hidden>
                <input type="submit" name="present_worker" hidden>
            </form>
            <a class="btn btn-secondary pull-right"  href="welcome.php"> Back </a>
        </div>
    </div>
</div>

<script>
headd = document.getElementById("head");

message = document.getElementById("msg");


<?php 
$temp = $_SESSION['id'];
$sql = "SELECT * from workers WHERE admin_id='$temp' ";

$res = mysqli_query($conn,$sql);
$row = mysqli_num_rows($res);
?>

var req = "<?php echo $row; ?>";

if(req=="0")
{ 
headd.style.display="none";
message.style.display="block";
}

else{
    headd.style.display="block";
    message.style.display="none";
}
</script>


<script>
window.onload = function(){
    $.ajax({
        url: 'displayajax.php',
        type: 'post',
        success:function(responsedata){
            $('#response').html(responsedata);
            //console.log(JSON.stringify(responsedata));
        }
    });
};

</script>
<script>
    function markattendance(){
        alert("attendance");
    }
</script>

