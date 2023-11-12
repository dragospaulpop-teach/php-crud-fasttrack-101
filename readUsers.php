<?php

include_once 'config.php';

$query = 'SELECT * FROM users';
$result = mysqli_query($connection, $query);

if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['username'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td> <a class="delete" href="deleteUser.php?deleteId=' . $row['id'] . '">&#9249;</a> <a class="edit" href="editUser.php?editId=' . $row['id'] . '">&#9998;</a> </td>';
    echo '</tr>';
  }
} else {
  echo 'Error querying table.';
}

?>