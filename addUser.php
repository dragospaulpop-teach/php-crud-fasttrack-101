<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!empty($_POST)) {
  include_once 'config.php';

  $username = $_POST['username'] ?? null;
  $email = $_POST['email'] ?? null;
  $password = $_POST['password'] ?? null;
  $id = $_POST['id'] ?? null;

  if (empty($username) || empty($email) || empty($password)) {
    // set a session message
    $_SESSION['message'] = 'Please fill in all fields.';
  } else {
    $query = "INSERT INTO users (`username`, `email`, `password`) VALUES ('$username', '$email', password('$password'))";

    try {
      $result = mysqli_query($connection, $query);
    } catch (Exception $e) {
      $_SESSION['message'] = $e->getMessage();
    }
  }

}

header('Location: index.php');
?>