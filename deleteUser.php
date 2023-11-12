<?php
  include_once 'config.php';

  if (!empty($_GET['deleteId'])) {
    $query = 'DELETE FROM users WHERE id = ' . $_GET['deleteId'];
    $result = mysqli_query($connection, $query);
  }

  header('Location: index.php');
?>
