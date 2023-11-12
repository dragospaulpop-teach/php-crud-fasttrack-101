<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home page</title>

	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		th {
			background-color: #4CAF50;
			color: white;
		}

		h1 {
			text-align: center;
		}

		h2 {
			text-align: center;
		}

		form {
			text-align: center;
			margin: 20px 20vw;
			border-radius: 5px;
			background-color: #f2f2f2;
			padding: 20px;
		}

		input {
			padding: 10px;
			border: none;
			border-radius: 5px;
			font-size: 16px;
			margin-right: 10px;
		}

		input[type="submit"] {
			padding: 10px;
			border: none;
			border-radius: 5px;
			font-size: 16px;
			cursor: pointer;
			background-color: #4CAF50;
			color: white;
		}

		input[type="submit"]:hover {
			background-color: #3e8e41;
		}

		.form-group {
			margin-bottom: 20px;
			text-align: center;
			display: flex;
		}

		.form-group div {
			flex: 1 1 50%;
			align-self: center;
		}

		.form-group div:first-child {
			text-align: right;
			padding-right: 10px;
		}

		.form-group div:last-child {
			text-align: left;
			padding-left: 10px;
		}

		a {
			text-decoration: none;
			color: #4CAF50;
		}

		a.delete {
			color: red;
		}

		a.delete:hover {
			text-decoration: underline;
		}

		a.edit {
			color: blue;
		}

		a.edit:hover {
			text-decoration: underline;
		}

	</style>
</head>
<body>
	<h1>Hell and welcome to my homepage</h1>
	<h2>Here are the users in my database</h2>
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
	<?php
		try {
			$connection = mysqli_connect('localhost', 'root', '', 'myapp', 3306);

			if ($connection) {

				if (!empty($_POST)) {
					$username = $_POST['username'] ?? null;
					$email = $_POST['email'] ?? null;
					$password = $_POST['password'] ?? null;
					$id = $_POST['id'] ?? null;

					if (empty($username) || empty($email) || empty($password)) {
						throw new Exception('Please fill in all fields.');
					}

					if (!$id) {
						$query = "INSERT INTO users (`username`, `email`, `password`) VALUES ('$username', '$email', password('$password'))";
					} else {
						$query = "UPDATE users SET `username` = '$username', `email` = '$email', `password` = password('$password') WHERE id = $id";
					}

					$result = mysqli_query($connection, $query);
				}

				if (!empty($_GET['deleteId'])) {
					$query = 'DELETE FROM users WHERE id = ' . $_GET['deleteId'];
					$result = mysqli_query($connection, $query);
				}

				if (!empty($_GET['editId'])) {
					$query = 'SELECT * FROM users WHERE id = ' . $_GET['editId'];
					$result = mysqli_query($connection, $query);

					if ($result) {
						$row = mysqli_fetch_assoc($result);
						$id = $row['id'];
						$username = $row['username'];
						$email = $row['email'];
					}
				}

				$query = 'SELECT * FROM users';
				$result = mysqli_query($connection, $query);

				if ($result) {
					while ($row = mysqli_fetch_assoc($result)) {
						echo '<tr>';
						echo '<td>' . $row['id'] . '</td>';
						echo '<td>' . $row['username'] . '</td>';
						echo '<td>' . $row['email'] . '</td>';
						echo '<td> <a class="delete" href="?deleteId=' . $row['id'] . '">&#9249;</a> <a class="edit" href="?editId=' . $row['id'] . '">&#9998;</a> </td>';
						echo '</tr>';
					}
				} else {
					echo 'Error querying table.';
				}
			} else {
				echo 'Error connecting to database.';
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}

	?>
		</tbody>
	</table>

	<div style="margin-top: 20px">
		<form method="post">
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
					<input type="submit" value="Add user">
				</div>
			</div>
		</form>
	</div>
</body>
</html>
