<?php

class AddAppModel extends Dbh {
  protected $jobId;
  protected $applicantId;
  protected $employer_id;
  protected $coverLetter;

  public function __construct(int $jobId, int $employer_id, int $applicantId, string $coverLetter) {
    $this->jobId = $jobId;
    $this->employer_id = $employer_id;
    $this->applicantId = $applicantId;
    $this->coverLetter = $coverLetter;
  }

  // Fetch all jobs that still have open positions and haven't been applied for
  protected function getAllJobs() {
    $pdo = parent::connect();
    $query = "SELECT * FROM jobs WHERE applicants > 0 AND id NOT IN (SELECT job_id FROM applications WHERE applicant_id = :applicantId);";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':applicantId', $this->applicantId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  
  // Fetch jobs the user has applied for
  protected function getAppliedJobs(){
    try {
      $pdo = parent::connect();
      // Join applications with jobs to get detailed info about applied jobs 
    $query = "SELECT jobs.id AS job_id, jobs.title, jobs.description,
        jobs.location,
        jobs.salary,
        jobs.created_at AS job_posted_at,
        applications.cover_letter,
        applications.status,
        applications.application_date AS applied_at
      FROM applications
      INNER JOIN jobs ON applications.job_id = jobs.id
      WHERE applications.applicant_id = :applicantId
      ORDER BY applications.application_date DESC;";
      
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":applicantId", $this->applicantId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
      throw new Exception("Error while fetching applied jobs: " . $e->getMessage());
    }
  }

  // Add an application and decrease available job slots by 1
  protected function addApplication() {
    $pdo = parent::connect();

    try {
      // Begin transaction once
      $pdo->beginTransaction();

      // Step 1: Ensure there’s still room for applicants
      $check = $pdo->prepare("SELECT applicants FROM jobs WHERE id = :job_id FOR UPDATE");
      $check->bindParam(':job_id', $this->jobId, PDO::PARAM_INT);
      $check->execute();

      $job = $check->fetch(PDO::FETCH_ASSOC);
      if (!$job || $job['applicants'] <= 0) {
        throw new Exception("This job is no longer accepting applications.");
      }

      // Step 2: Insert application
      $insert = $pdo->prepare("INSERT INTO applications (job_id, employer_id, applicant_id, cover_letter)VALUES (:jobId, :employer_id, :applicantId, :coverLetter) ");
      $insert->bindParam(':jobId', $this->jobId, PDO::PARAM_INT);
      $insert->bindParam(':employer_id', $this->employer_id, PDO::PARAM_INT);
      $insert->bindParam(':applicantId', $this->applicantId, PDO::PARAM_INT);
      $insert->bindParam(':coverLetter', $this->coverLetter, PDO::PARAM_STR);
      $insert->execute();

      // Step 3: Decrease the applicants count safely
      $update = $pdo->prepare("UPDATE jobs SET applicants = applicants - 1 WHERE id = :job_id");
      $update->bindParam(':job_id', $this->jobId, PDO::PARAM_INT);
      $update->execute();

      // Commit everything
      $pdo->commit();

    } catch (Exception $e) {
      $pdo->rollBack();
      throw new Exception("Error while adding application: " . $e->getMessage());
    }
  }
}