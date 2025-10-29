<?php
declare (strict_types=1);



class AddJobModel extends Dbh{
  protected $title;
  protected $location;
  protected $applicants;
  protected $description;
  protected $salary;
  protected $userId;

  // creating the class variables
  public function __construct(string $title, string $location, int $applicants, string $description,string $salary, int $userId)
  {
    $this->title = $title;
    $this->location = $location;
    $this->applicants = $applicants;
    $this->description = $description;
    $this->salary = $salary;
    $this->userId= $userId;
  }

  // this function will find all jobs available

  protected function findJobs(){
    // Here you can add code to save the user data to a database
    $query = "SELECT * FROM jobs WHERE employer_id = :userId";  
    // Prepare statement  calling the connect method from Dbh class
    $stmt = parent::connect()->prepare($query);

    // Bind parameters
    
    $stmt->bindParam(':userId', $this->userId);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    return $result;


    $stmt=null;
  }

    protected function getApplicantsForEmployer() {
  try {
    $pdo = parent::connect();

    $query = "SELECT 
        applications.id AS application_id,
        users.id AS applicant_id,
        users.username AS applicant_name,
        users.email AS applicant_email,
        jobs.id AS job_id,
        jobs.title AS job_title,
        applications.cover_letter AS cover_letter,
        applications.application_date AS applied_at
      FROM applications
      INNER JOIN jobs  ON applications.job_id = jobs.id
      INNER JOIN users  ON applications.applicant_id = users.id
      WHERE jobs.employer_id = :employer_id AND applications.status = 'pending'
      ORDER BY applications.application_date DESC;
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':employer_id', $this->userId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

  } catch (PDOException $e) {
    die("Error fetching applicants for employer: " . $e->getMessage());
  }
}
 


  // this will add jobs to the database

  protected function addAJob(){
    // Here you can add code to save the user data to a database
    $query = "INSERT INTO jobs (title, location, applicants, description, salary, employer_id) VALUES (:title, :location, :applicants, :description, :salary, :userId)";  
    // Prepare statement  calling the connect method from Dbh class
    $stmt = parent::connect()->prepare($query);

    // Bind parameters
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':location', $this->location);
    $stmt->bindParam(':applicants', $this->applicants);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':salary', $this->salary);
    
    $stmt->bindParam(':userId', $this->userId);
    if($stmt->execute()){
      header("Location: ../Employer/dashboard.php?jobAdded=success");

      $stmt=null;
      
      exit();
    }else{
      return "Error: Could not add a new product.";
    }
  }

  // this will update jobs in the database 
  protected function updateJobs($job_id){
    $query = "UPDATE jobs SET title= :title, location= :location, applicants= :applicants, description= :description, salary= :salary WHERE id= :jobId";  
    // Prepare statement  calling the connect method from Dbh class
    $stmt = parent::connect()->prepare($query);

    // Bind parameters
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':location', $this->location);
    $stmt->bindParam(':applicants', $this->applicants);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':salary', $this->salary);
    
    $stmt->bindParam(':jobId', $job_id);
    if($stmt->execute()){
      header("Location: ../Employer/dashboard.php?JobUpdated=success");

      $stmt=null;
      
      exit();
    }else{
      return "Error: Could Not Update A Job.";
    }
  }

  // this will delete a specific job
  protected function deleteJobs($job_id){
    $query = "DELETE FROM jobs WHERE id= :jobId";  
    // Prepare statement  calling the connect method from Dbh class
    $stmt = parent::connect()->prepare($query);

    // Bind parameters
    
    $stmt->bindParam(':jobId', $job_id);
    if($stmt->execute()){
      header("Location: ../Employer/dashboard.php?JobDeleted=success");

      $stmt=null;
      
      exit();
    }else{
      return "Error: Could Not Delete A Job.";
    }
  }

  protected function acceptApplicantModel($applicantId){
    $pdo = parent::connect();
    $query = "UPDATE applications SET applications.status = 'accepted' WHERE applications.id = :applicationId;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":applicationId", $applicantId);
   if($stmt->execute()){
      header("Location: ../Employer/dashboard.php?ApplicantAccepted=success");

      $stmt=null;
      
      exit();
    }else{
      return "Error: Could Not Accept An Application.";
    }
  }

  protected function rejectApplicant($applicantId){
    $pdo = parent::connect();
    $query = "UPDATE applications SET applications.status = 'rejected' WHERE applications.id = :applicationId;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":applicationId", $applicantId);
   if($stmt->execute()){
      header("Location: ../Employer/dashboard.php?ApplicantRejected=success");

      $stmt=null;
      
      exit();
    }else{
      return "Error: Could Not Accept An Application.";
    }
  }
}