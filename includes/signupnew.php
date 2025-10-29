<?php

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $account = $_POST['account'];
    
    try{
        require_once "../Classes/Dbh.php";
        require_once "../Classes/Signup/SignupModel.php";
        require_once "../Classes/Signup/SignupControl.php";
    
    

    $signup = new SignupControl($username, $email, $pwd, $account);
    $result = $signup->signup1();
    echo $result;
    }catch(PDOException $e){
        die("Error Message". $e->getMessage());
    }
    

    
}else{
    header("Location: ../signup.login.php");
    die();
}