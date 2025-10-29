<?php

if($_SERVER["REQUEST_METHOD"]==="POST"){
  $applicant_id = $_POST["applicant_id"];

  require_once "../../Dbh.php";
  require_once "../Employer/AddJob/AddJobModel.php";
  require_once "../Employer/AddJob/AddJobControl.php";

  $acceptApplicant = new AddJobControl("", "", 0, "", "", 0);
  $acceptApplicant->acceptApplicant($applicant_id);

}