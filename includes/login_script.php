<?php

	if (isset($_POST['login-button'])) {

		require 'db_connection.php'; // For Variable $conn

		$username =  $_POST['username'];
		$pwd = $_POST['password'];

		$sql = "SELECT * FROM users WHERE username = ? or password = ?;";
		$stmt = mysqli_stmt_init($conn);

		if (empty($username) || empty($pwd)) {

			header("Location: ../auth?error=emptyfields");
			exit();
		} 

		if (!mysqli_stmt_prepare($stmt, $sql)) {

			echo 'Failed SQL statement';
			exit();
		}
		else {

			mysqli_stmt_bind_param($stmt, "ss", $username, $pwd);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			if ($row = mysqli_fetch_assoc($result)) {

				if ( $row['username'] == $username and password_verify($pwd, $row['password']) and $row['isAdmin'] == 0) {

					session_start();
					$_SESSION['username'] = $row['username'];
					$_SESSION['isAdmin'] = 0;
					$_SESSION['useremail'] = $row['email'];
					$_SESSION['password'] = $row['password'];
					header("Location: ../user");
				}
				else if ( $row['username'] == $username and password_verify($pwd, $row['password']) and $row['isAdmin'] == 1) {
					$_SESSION['username'] = $row['username'];
					$_SESSION['isAdmin'] = 1;
					 echo " This person is in Database and it is Admin "; // new Header from administrator with session

				}
				else if ( $row['username'] == $username and !password_verify($pwd, $row['password']) ) {

					header("Location: ../auth?error=falsePassword");
					exit();
				}
				else if ( $row['username'] != $username and password_verify($pwd, $row['password']) ) {

					header("Location: ../auth?error=falseUsername");
					exit();
				}
			}			
			else {
				header("Location: ../auth?error=unSuccess-Login");
				exit();
			}
		}
	}
	else {
		header("Location: ../auth");
		exit();
	} 

?>