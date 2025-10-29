<?php
declare (strict_types=1);

class AddJobControl extends AddJobModel{

  public function __construct(string $title, string $location, int $applicants, string $description,string $salary, int $userId)

  {
    parent::__construct($title, $location, $applicants, $description, $salary, $userId);
  }

  private function emptyInputs(){
    if(empty($this->title)|| empty($this->location)|| empty($this->applicants)|| empty($this->description)|| empty($this->salary) ){
      return true;
    }else{
      return false;
    }
  }

  public function getJobs(){
    return parent::findJobs();
  }

  public function getAllApplicants(){
    return parent::getApplicantsForEmployer();
  }
  

  public function addNewJob(){
    require_once "../../../config.php";
    if($this->emptyInputs()){
      header("Location: ../addJob.php");
      exit();
    }else{
      parent::addAJob();
      
    }
   
  }
  public function updateJob($jobId){
    parent::updateJobs($jobId);
  }
  public function delete($jobId){
    parent::deleteJobs($jobId);
  }
 
  public function acceptApplicant($applicantId){
    parent::acceptApplicantModel($applicantId);
  }

  public function reject($applicantId){
    parent::rejectApplicant($applicantId);
  }
}