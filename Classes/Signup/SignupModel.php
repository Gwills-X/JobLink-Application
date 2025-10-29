<?php
declare (strict_types=1);
class SignupModel extends Dbh{
  protected $username;
  protected $email;
  protected $pwd;
  protected $account;

  public function __construct(string $username, string $email, string $pwd, string $account)
  {
    $this->username = $username;
    $this->email = $email;
    $this->pwd = $pwd;
    $this->account = $account;
  }

  // get all jobs from the jobs table in the database

  protected function getAllJobs(){
    $query = "SELECT * FROM jobs";  
    // Prepare statement  calling the connect method from Dbh class
    $stmt = parent::connect()->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  protected function usernameExist(){
    $query = "SELECT * FROM users WHERE username = :username";  
    // Prepare statement  calling the connect method from Dbh class
    $stmt = parent::connect()->prepare($query);
    // Bind parameters
    $stmt->bindParam(':username', $this->username);
    $stmt->execute();
    if($stmt->rowCount() > 0){
      return true;
    }else{
      return false;
    }
  }
  protected function emailExist(){
    $query = "SELECT * FROM users WHERE email = :email";  
    // Prepare statement  calling the connect method from Dbh class
    $stmt = parent::connect()->prepare($query);
    // Bind parameters
    $stmt->bindParam(':email', $this->email);
    $stmt->execute();
    if($stmt->rowCount() > 0){
      return true;
    }else{
      return false;
    }
  }
  protected function signup(){
    // Here you can add code to save the user data to a database
    $query = "INSERT INTO users (username, email, pwd, account) VALUES (:username, :email, :pwd, :account)";  
    // Prepare statement  calling the connect method from Dbh class
    $stmt = parent::connect()->prepare($query);
    // hash the password before storing
    $hashedPwd = password_hash($this->pwd, PASSWORD_DEFAULT);

    // Bind parameters
    $stmt->bindParam(':username', $this->username);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':pwd', $hashedPwd);
    $stmt->bindParam(':account', $this->account);
    if($stmt->execute()){
      header("Location: ../signup.login.php?signup=success");

      $stmt=null;
      
      exit();
    }else{
      return "Error: Could not complete signup.";
    }
  }
}