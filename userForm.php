<?php
  if (!isset($_SESSION)) {
    session_start();
  }

  // get session vars
  $id = $_SESSION['id'] ?? null;
  $username = $_SESSION['username'] ?? null;
  $email = $_SESSION['email'] ?? null;

  $action = $id ? 'editUser.php' : 'addUser.php';
  $label = $id ? 'Edit User' : 'Add User';
?>
<div style="margin-top: 20px">
  <form method="post" action="<?php echo $action; ?>">
    <h2>Add new user</h2>
    <!-- hidden id input -->
    <input type="hidden" name="id" value="<?= $id ?? '' ?>">
    <div class="form-group">
      <div>
        <label for="username">
          Username
        </label>
      </div>
      <div>
        <input type="text" name="username" id="username" value="<?= $username ?? '' ?>">
      </div>
    </div>
    <div class="form-group">
      <div>
        <label for="email">
          Email
        </label>
      </div>
      <div>
        <input type="email" name="email" id="email" value="<?= $email ?? '' ?>">
      </div>
    </div>
    <div class="form-group">
      <div>
        <label for="password">
          Password
        </label>
      </div>
      <div>
        <input type="password" name="password" id="password">
      </div>
    </div>
    <div class="form-group">
      <div></div>
      <div>
        <input type="submit" value="<?php echo $label; ?>">
      </div>
    </div>
  </form>
</div>