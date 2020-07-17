<?php
    session_start();
    
   $conn = new mysqli('localhost', 'root','', 'web_db'); 

   if($conn->connect_error)
   {
       die("Connection error");
   }
?>
