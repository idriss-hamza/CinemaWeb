<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $mysqli->real_escape_string($_POST['username']);
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

  // Check if user exists
  $result = $mysqli->query("SELECT id FROM users WHERE username='$username'");
  if ($result->num_rows > 0) {
    die("Username already taken. <a href='signup.html'>Try again</a>");
  }

  $mysqli->query("INSERT INTO users (username, password) VALUES ('$username','$password')");
  $_SESSION['user_id'] = $mysqli->insert_id;
  header("Location: index.html");
  exit;
}
?>
