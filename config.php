<?php
ini_set("session.use_only_cookies", 1);
ini_set("session.use_strict_mode", 1);

session_set_cookie_params([
  'lifetime' => 1800,
  'domain' => 'localhost',
  'path' => '/',
  'secure' => false, // must be false on localhost
  'httponly' => true,
]);

session_start();

if (!isset($_SESSION["last_regenerated"])) {
  regenerate_id();
} else {
  $interval = 60 * 30;
  if (time() - $_SESSION["last_regenerated"] >= $interval) {
    regenerate_id();
  }
}

function regenerate_id() {
  session_regenerate_id(true);
  $_SESSION["last_regenerated"] = time();
}