<?php 
declare (strict_types=1);

if($_SERVER["REQUEST_METHOD"]==="POST"){
  $username = $_POST["username"];
  $password = $_POST["pwd"];

  try{
    require_once "../Classes/Dbh.php";
    require_once "../Classes/Login/LoginModel.php";
    require_once "../Classes/Login/LoginControl.php";

    $login = new LoginControl($username, $password);
    $login->loginUser();
    

  }catch(PDOException $e){
    die("Error occured while connecting to database: ".$e->getMessage());
  }
}else{
  header("Location: ../signup.login.php");
  die();
}