<?php
	session_start();
    
    if (isset($_SESSION['login']))
         unset($_SESSION['login']);
    
    Header("Location: index.php");
?>
