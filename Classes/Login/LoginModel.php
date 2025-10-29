<?php
declare (strict_types=1);

class LoginModel extends Dbh{
  protected $username;
  protected $pwd;
  public function __construct(string $username, string $pwd)
  {
    $this->username= $username;
    $this->pwd=$pwd;
  }
public function usernameAvailable(){
    $query = "SELECT * FROM users WHERE username = :username";  
    // Prepare statement  calling the connect method from Dbh class
    $stmt = parent::connect()->prepare($query);
    // Bind parameters
    $stmt->bindParam(':username', $this->username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0){
      return $result;
    }else{
      return false;
    }
  }

  protected function findJobs($job_id){
    // Here you can add code to save the user data to a database
    $query = "SELECT * FROM jobs WHERE employer_id = :userId";  
    // Prepare statement  calling the connect method from Dbh class
    $stmt = parent::connect()->prepare($query);

    // Bind parameters
    
    $stmt->bindParam(':userId', $job_id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    return $result;


    $stmt=null;
  }
}