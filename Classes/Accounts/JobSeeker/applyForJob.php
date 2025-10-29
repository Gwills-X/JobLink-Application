<?php
require_once "../../../config.php";
if($_SERVER["REQUEST_METHOD"]==="POST"){
  $jobId = intval($_POST["job_id"]);
  $employerId = intval($_POST["employer_id"]);
  $applicantId = intval($_SESSION["userid"]);
  $coverLetter = trim($_POST["cover_letter"]);

  try{
    
    require_once "../../../Classes/Dbh.php";
    require_once "../../../Classes/Accounts/JobSeeker/AddApplication/AddAppModel.php";
    require_once "../../../Classes/Accounts/JobSeeker/AddApplication/AddAppControl.php";

    $application = new AddAppControl($jobId, $employerId, $applicantId, $coverLetter);

    $application->addNewApplication();

    header("Location: ../JobSeeker/dashboard.php?application=sent");
    die();

  }catch(PDOException $e){
    die("Error occured while connecting to database: ".$e->getMessage());
  }
}else{
  header("Location: ../JobSeeker/dashboard.php?application=sent");
    die();

}