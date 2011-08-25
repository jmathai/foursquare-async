<?php 
    setcookie("access_token", "", time()-(100*24*3600));
    header('location: index.php');
?>
