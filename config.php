<?php
  try {
    $connection = mysqli_connect('localhost', 'root', '', 'myapp');
  } catch (Exception $e) {
    echo $e->getMessage();
  }
?>