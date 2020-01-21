<?php

include("connect.php");
session_start();
if(!isset($_SESSION['username'])){
    header("location: welcome.php");
    exit;
}
//extract($_POST);
$a = "A";
//if(isset($_POST['worker_id']) && isset($_POST['admin_id']) )
if(isset($_POST['absent_submit']))
{
    $workerid = $_POST['absent_worker'];
    $adminid = $_SESSION['id'];
    // $adminid = $_POST['admin_id'];
    $query = " INSERT INTO attendance (worker_id, admin_id,status) VALUES ( '$workerid',  '$adminid','$a') ";
    if(mysqli_query($conn,$query)){
        header("location: view_worker.php");
    }
    else{
        echo "Absent marking Failed";
    }
    // if($result['status'])
    // {echo "A";}
    // else{
    //     echo "Not Marked";
    // }
}
// else
// {
//     echo "Invalid";
//}
?>