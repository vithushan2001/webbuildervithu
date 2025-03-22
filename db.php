<?php
$db_server="localhost";
$db_user="root";
$db_pass="root";
$db_database="webbuilder";
$conn="";

$conn=mysqli_connect($db_server,
                     $db_user, 
                     $db_pass,
                     $db_database);


//  if($conn){
//    echo"database is connected";
//  }
// else{
//     echo"database is not connected";
// }                     
?>