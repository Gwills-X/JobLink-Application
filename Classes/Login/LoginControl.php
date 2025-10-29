<?php 
declare (strict_types=1);

class LoginControl extends LoginModel {

  public function __construct(string $username, string $pwd) {
    parent::__construct($username, $pwd);
  }

  private function emptyInput(): bool {
    return empty($this->username) || empty($this->pwd);
  }

  private function unknownUsername(): bool {
    return !parent::usernameAvailable();
  }

  private function passwordVerify() {
    $userData = parent::usernameAvailable();
    if (!$userData) return false;

    $hashedPwd = $userData['pwd'];
    return password_verify($this->pwd, $hashedPwd) ? $userData : false;
  }
  

  

  public function loginUser(): void {
    if ($this->emptyInput()) {
      header("Location: ../signup.login.php?error=emptyinput");
      exit();
    }

    if ($this->unknownUsername()) {
      header("Location: ../signup.login.php?error=unknownusername");
      exit();
    }

    $userData = $this->passwordVerify();
    if ($userData === false) {
      header("Location: ../signup.login.php?error=wrongpassword");
      exit();
    }
    

    //  Start session before using it
    require_once "../config.php";
    

    $_SESSION['userid'] = $userData['id'];
    $_SESSION['username'] = $userData['username'];
    $_SESSION['account'] = $userData['account'];

    //  Redirect by role
    if ($userData['account'] === 'employer') {
      
      header("Location: ../Classes/Accounts/Employer/dashboard.php");

    } else {
      header("Location: ../Classes/Accounts/JobSeeker/dashboard.php");
    }
    exit();
  }
}