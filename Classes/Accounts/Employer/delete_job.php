<?php
require_once "../../../config.php";

if($_SERVER["REQUEST_METHOD"]==="POST"){
  $job_id = $_POST["job_id"];
  $userId = $_SESSION["userid"];
  
  try{

    require_once "../../Dbh.php";
    require_once "../Employer/AddJob/AddJobModel.php";
    require_once "../Employer/AddJob/AddJobControl.php";

    $deleteJob= new AddJobControl("", "", 0, "", "", $userId);
    $deleteJob->delete($job_id);

    header("Location: ./dashboard.php");
  }catch(PDOException $e){
    die("Error".$e->getMessage());
  }
}else{
  header("Location: ../Employer/dashboard.php");
}