<?php
require_once "../../../config.php";
if($_SERVER['REQUEST_METHOD']==="POST"){
  $jobTitle = $_POST['title'];
  $location = $_POST['location'];
  $applicants= $_POST["applicants"];
  $description = $_POST['description'];
  $salary   = $_POST['salary'];
  $userId= $_SESSION["userid"];

  try{
    require_once "../../../Classes/Dbh.php";
    require_once "../../../Classes/Accounts/Employer/AddJob/AddJobModel.php";
    require_once "../../../Classes/Accounts/Employer/AddJob/AddJobControl.php";

    $employer = new AddJobControl($jobTitle, $location, $applicants,$description,$salary, $userId);

    
    $employer->addNewJob();
    

    

    header("Location: ./dashboard.php?job=added");
    die();

  }catch(PDOException $e){
    die("Error occured while connecting to database: ".$e->getMessage());
  }
}else{
  header("Location: addJob.php");
  die();
}