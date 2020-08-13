<?php
session_start();

if (!isset($_SESSION['loggedIN'])) {
    header('Location: login.php');
    exit();
}
?>
<a href="logout.php"> Log Out</a></br>
You are logged IN!
