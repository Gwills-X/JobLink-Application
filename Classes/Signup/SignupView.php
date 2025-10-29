<?php

class SignupView {

  public function showError(){
    if(isset($_SESSION['signup_errors'])){
      $errors= $_SESSION['signup_errors'];
      
      foreach($errors as $key=>$error){
        echo "<p key=".$key." class='text-[15px] font-semibold text-red-300 mb-6'>".$error."</p>";
      }
      unset($_SESSION['signup_errors']);
    }else{
      return null;
    };
  }
}