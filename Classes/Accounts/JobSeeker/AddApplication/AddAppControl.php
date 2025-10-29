<?php

class AddAppControl extends AddAppModel{

  public function __construct(int $jobId,int $employer_id, int $applicantId, string $coverLetter)
  {
    parent::__construct($jobId, $employer_id, $applicantId, $coverLetter);
  }

  public function sendAllJobs(){
    return parent::getAllJobs();
  }

  public function sendAppliedJobs(){
    return parent::getAppliedJobs();
  }

  public function addNewApplication(){
    parent::addApplication();
  }
}