<?php
	session_start();
    
    if (isset($_SESSION['login_trabajadores']))
         unset($_SESSION['login_trabajadores']);
    
    Header("Location: index.php");
?>