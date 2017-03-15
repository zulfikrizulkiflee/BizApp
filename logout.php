<?php
   session_start();
   
   if(session_destroy()) {
//      header("Location: index.php");
       header("Location: ". $_SESSION['current_page']);
   }
?>