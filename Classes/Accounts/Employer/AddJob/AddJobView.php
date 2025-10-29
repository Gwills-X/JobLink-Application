<?php

class AddJobView{
  public function showJobs(){
    if(isset($_SESSION["all_jobs"])){
      $jobs = $_SESSION["all_jobs"];


      return $jobs;
      unset($_SESSION["all_jobs"]);
    }else{
      return null;
    }
  }
}