<?php


function requireRole($role){
    if(!isset($_SESSION["account"])){
      header("Location: ../../signup.login.php?error=notloggedin");
      exit();
    }elseif($_SESSION["account"] !== $role){
      header("Location: ../../signup.login.php?error=unauthorized");
      exit();
    }

}