<?php
/*
This file contain Data Base connection And configuaration

*/

define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','login');

// try connecting database

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

//check conn

if($conn == false)
{
    echo "Error: Cannot connect to Server.....";
}
else{
    //echo "sucess";
}
?>