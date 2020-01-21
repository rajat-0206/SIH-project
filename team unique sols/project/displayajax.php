<?php
include("connect.php");
session_start();
if(!isset($_SESSION['username'])){
    header("location: welcome.php");
    exit;
}

$sql = "SELECT * from workers"; 
$res = mysqli_query($conn,$sql);

if(mysqli_num_rows($res) > 0){
    while($result = mysqli_fetch_array($res)){
        if($result['admin_id'] == $_SESSION['id'] )
        { $worker_id = $result['worker_id']; 
          date_default_timezone_set('Asia/Kolkata');
          $Currentdate = date( 'Y-m-d', time () );
          $query = "SELECT * FROM attendance WHERE worker_id='$worker_id' AND markdate = '$Currentdate'";
          $rst = mysqli_query($conn,$query);
          $rst = mysqli_fetch_assoc($rst);
        ?>
        
        <tr>
            <td> <?php echo $result['u_id']?> </td>
            <td> <?php echo $worker_id ?> </td>
            <td> <?php echo $result['name']?> </td>
            <td> <?php echo $result['age']?> </td>
            <?php 
                if(!$rst['markdate']){
            ?>
            <td><div class="container">
                    

                    <div class="d-flex justify-content-left">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal<?php echo $worker_id;?>" id="<?php echo $worker_id;?>" onclick="markattendance()">Mark Present</button>
                        <form action="absent.php" method="post">
                            <input type="text" value="<?php echo $worker_id;?>" name="absent_worker" hidden>
                            <button type="submit" class="btn btn-danger "  name="absent_submit"  style="margin-left:10px">Mark Absent</button>
                        </form>
                        
                    </div>

                    

                    <!-- The Modal -->
                    <div class="modal" id="myModal<?php echo $worker_id;?>">
                    <div class="modal-dialog">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h6 class="modal-title" class="justify-content-right">Worker UID <?php echo $worker_id;?> </h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <?php echo $result['name']; ?>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="addRecord()">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-left:5px">Close</button>
                    </div>

                    </div>
                    </div>
                    </div>


                </div>
            </td>
            <?php }
            else{
                ?>
                <td><kbd>Attendance Marked</kbd></td>
                <?php
            }
            ?>
            
        </tr>
    
    
<?php    
    }
}
}
?>
<script>
 function markAbsent(admin_id,worker_id){
    alert("absent"+admin_id+" "+worker_id);
    var xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        let data = this.responseText;
        if(data == "A"){
            alert(`Worker ID ${worker_id} is Marked Absent`);
        }
        else if(data == "Not Marked"){
            alert("Not Marked");
        }
        else if(data == "Invalid"){
            alert("Invalid Request");
        }
    };
    xhttp.open("GET?worker_id="+worker_id+"&admin_id="+admin_id, "absent.php");
    //xhttp.setRequestHeader("Content-type","text");
    //xhttp.send("worker_id="+worker_id+"&admin_id="+admin_id);
 }
 function markattendance(){
     alert("attendance");
 }
</script>

    

<script >
  	// function markAbsent(worker_id){
  	// 	//var worker_id = worker_id;
  	// 	var admin_id = <?php echo $result['admin_id']; ?>;
  		
    //     alert(admin_id+" "+worker_id);
  	// 	// $.post({
  	// 	// 	url:"absent.php",
  	// 	// 	type:'post',
  	// 	// 	data: { 
    //     //         worker_id : worker_id,
  	// 	// 		admin_id : admin_id
  	// 	// 	 }
  	// 	// 	 success:function(data){
    //     //         if(data == "A"){
    //     //             alert(`Worker ID ${worker_id} is Marked Absent`);
    //     //         }
  	// 	// 	 	else if(data == "Not Marked"){
    //     //             alert("Not Marked");
    //     //         }
    //     //         else if(data == "Invalid"){
    //     //             alert("Invalid Request");
    //     //         }
  	// 	// 	 }

  	// 	// });
    //     // $.post(
    //     //     "absent.php",
    //     //     { 
    //     //         worker_id : worker_id,
    //     //         admin_id : admin_id 
    //     //     },
    //     //     function(data) {
                   
    //     //    }
    //     // );

        // var xhttp = new XMLHttpRequest();
        // xhttp.onload = function() {
        //     let data = this.responseText;
        //     if(data == "A"){
        //         alert(`Worker ID ${worker_id} is Marked Absent`);
        //     }
        //     else if(data == "Not Marked"){
        //         alert("Not Marked");
        //     }
        //     else if(data == "Invalid"){
        //         alert("Invalid Request");
        //     }
        // };
        // xhttp.open("POST", "absent.php");
        // xhttp.setRequestHeader("Content-type","text");
        // xhttp.send(`worker_id=${worker_id}&admin_id=${admin_id}`);
    // }	
  </script>
