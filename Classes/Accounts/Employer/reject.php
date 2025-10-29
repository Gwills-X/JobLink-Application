<?php

if($_SERVER["REQUEST_METHOD"]==="POST"){
  $applicantId = $_POST["applicant_id"];

  try{
    
    require_once "../../Dbh.php";
    require_once "../Employer/AddJob/AddJobModel.php";
    require_once "../Employer/AddJob/AddJobControl.php";

   $rejectApplication = new AddJobControl("","",0,"","",0);

   $rejectApplication->reject($applicantId);

  }catch(PDOException $e){
    die("Error occured while connecting to database: ".$e->getMessage());
  }
}