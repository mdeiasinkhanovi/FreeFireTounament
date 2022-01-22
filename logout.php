<?php 


session_start();

    include_once 'include/class.user.php';


    $user = new User();


    $user->logout();

    header("location:index.php");

?>