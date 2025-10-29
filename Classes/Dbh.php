<?php

class Dbh {
  private $host = "localhost";
  private $password ="";
  private $username = "root";
  private $dbname= "job_listing";

  protected function connect(){
    try{
      $dsn = "mysql:host=".$this->host.";dbname=".$this->dbname;
      $pdo = new PDO($dsn, $this->username, $this->password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    }catch (PDOException $e){
      echo "Connection failed: ".$e->getMessage();
    }
  }
}