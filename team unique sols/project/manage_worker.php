<?php

include("header1.php"); 
include("connect.php");
error_reporting(0);
if(!isset($_SESSION['loggedin'])){
    //echo "pass1";
    header("location:login.php");
}

$user = $_SESSION['id'];
$sql = "SELECT * from workers WHERE admin_id='$user' "; 
$res = mysqli_query($conn,$sql);
$rows=mysqli_num_rows($res);
?>


<div class="container m-4"><center><h3><p class="text-center">Manage Workers</p></h3></center>
    <div id="head" style="display: block;">           
    <table class="table table-striped" >
        <thead class="table-dark">
            
                <th>Unique Id</th>
                
                <th>Worker Name</th>
                <th>Worker Age</th>
                <th>Manage Worker</th>
            
        </thead>
        <tbody >
        <?php 
        if(mysqli_num_rows($res) > 0){
            while($result = mysqli_fetch_array($res)){
                
        ?>
        
        <tr>
            <td> <?php echo $result['worker_id']?> </td>
            
            <td> <?php echo $result['name']?> </td>
            <td> <?php echo $result['age']?> </td>
            <?php ?>
            <td>
                <div class="d-flex">
                <button id="delete_<?php echo $result['worker_id']?>" class="btn btn-danger" style="display:inline;" onclick="deleteWorker(<?php echo $result['worker_id']?>)" data-toggle="tooltip" data-placement="top" title="Delete WorkerID <?php echo $result['worker_id']?>">Delete Worker</button>
            <form action="viewajax.php" method="post">
                <input type="text" name="workerid" value="<?php echo $result['worker_id']?>" hidden>
                <button type="submit" class="btn btn-info" name="view" style="margin-left:10px;">View Worker</button>
            </form>
                </div>    
               

            </td>

        </tr>
        

        <?php 
            }
        }           
        ?>        


        </tbody>


    </table>
    </div> 
</div>
<div class="container m-4" id="msg" style="display: block;"><center><h3><kbd>No Data to Display</kbd></h3></center></div>

<script>
headd = document.getElementById("head");

message = document.getElementById("msg");
var req = "<?php echo $rows; ?>";

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
    function deleteWorker(worker_id){
        alert("pressed");
        var xhttp = new XMLHttpRequest();
        xhttp.onload = function(){  
            alert("Reply: "+this.responseText);
            location.reload();
        };
        xhttp.open("POST", "deleteajax.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`worker_id_delete=${worker_id}`);
    }

   /* function viewWorker(worker_id){
        alert("pressed");
        var xhttp = new XMLHttpRequest();
        xhttp.onload = function(){  
            alert("Reply: "+this.responseText);
            window.location.href = 'viewajax.php';
        };
        xhttp.open("POST", "viewajax.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`worker_id_view=${worker_id}`);
    }*/
</script>