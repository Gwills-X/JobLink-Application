<?php
declare (strict_types=1);

class SignupControl extends SignupModel {
  private $error = [];

  public function __construct(string $username, string $email, string $pwd, string $account) {
    parent::__construct($username, $email, $pwd, $account);
  }

  public function showAllJobs(){
    return parent::getAllJobs();
  }
  
  private function emptyInput(): bool {
    return !(
      empty($this->username) || 
      empty($this->email) || 
      empty($this->pwd) || 
      empty($this->account)
    );
  }

  private function invalidEmail(): bool {
    return filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false;
  }

  private function emailTaken(){
    if(parent::emailExist()){
      return true;
    }else{
      return false;
    }
  }
  private function userNameTaken(){
    if(parent::usernameExist()){
      return true;
    }else{
      return false;
    }
  }

  public function signup1() {
    if (!$this->emptyInput()) {
      $this->error['emptyinput'] = "Please fill in all fields.";
    } elseif (!$this->invalidEmail()) {
      $this->error['invalidemail'] = "Please enter a valid email.";
    } elseif ($this->emailTaken()) {
      $this->error['emailtaken'] = "This email is already registered.";
    }elseif ($this->userNameTaken()) {
      $this->error['usernameTaken'] = "This Username is already registered.";
    }

    require_once "../config.php";
    if (!empty($this->error)) {
      $_SESSION['signup_errors'] = $this->error;
      header("Location: ../signup.login.php");
      exit();
    }

    return parent::signup();
  }
}