<?php
	// check if session is already started
	if (!isset($_SESSION)) {
		session_start();
	}

	// get session vars
	$message = $_SESSION['message'] ?? null;
	// clear session vars
	unset($_SESSION['message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Users CRUD Demo</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Hell and welcome to my homepage</h1>
	<h2>Here are the users in my database</h2>

	<?php if (!empty($message)): ?>
		<div class="message">
			<?php echo $message ?? ''; ?>
		</div>
	<?php endif ?>

	<table border="1">
		<thead>
			<tr>
				<th>ID</th>
				<th>Username</th>
				<th>Email</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php include_once 'readUsers.php' ?>
		</tbody>
	</table>

	<?php include_once 'userForm.php' ?>
</body>
</html>
