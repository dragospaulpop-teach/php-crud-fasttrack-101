<?php

include_once 'config.php';
// check if session is already started
if (!isset($_SESSION)) {
  session_start();
}

if (!empty($_POST)) {
  $username = $_POST['username'] ?? null;
  $email = $_POST['email'] ?? null;
  $password = $_POST['password'] ?? null;
  $id = $_POST['id'] ?? null;

  if (empty($username) || empty($email) || empty($password)) {
    // set a session message
    $_SESSION['message'] = 'Please fill in all fields.';
  } else {
    if ($id) {
      $query = "UPDATE users SET `username` = '$username', `email` = '$email', `password` = password('$password') WHERE id = $id";
      $result = mysqli_query($connection, $query);
    } else {
      // set a session message
      $_SESSION['message'] = 'No id selected for update.';
    }

    //clear session vars
    if (isset($_SESSION['id'])) {
      unset($_SESSION['id']);
      unset($_SESSION['username']);
      unset($_SESSION['email']);
    }
  }
}

if (!empty($_GET['editId'])) {
  $query = 'SELECT * FROM users WHERE id = ' . $_GET['editId'];
  $result = mysqli_query($connection, $query);

  if ($result) {
    $row = mysqli_fetch_assoc($result);

    $id = $row['id'];
    $username = $row['username'];
    $email = $row['email'];

    // store in session vars
    $_SESSION['id'] = $id;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
  }
}

header('Location: index.php');

?>