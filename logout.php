<?php

   session_start(); 
   $_SESSION['login_email']=' '; 
   $_SESSION['login_password']=' '; 
   session_destroy(); 
   header("Location: login.php"); // Redirecting To Home Page 

//session_start();//session is a way to store information (in variables) to be used across multiple pages.
//session_destroy();
//header("Location: login.php");//use for the redirection to some page
?>