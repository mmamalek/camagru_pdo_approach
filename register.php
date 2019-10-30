<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Register</title>
</head>
<body>
<h1>Sign Up</h1>
	<!-- Errors will come here -->
	<div>
	<form  action="confirm.php" method="POST">
		Username:<input type="text" placeholder="username" name="username" required/><br />
		Email:<input type="text" placeholder="email address" name="email" required/><br />
		Password:<input type="password" placeholder="password" name="passwd" required/><br />
		<!--<span>Confirm password:</span><input type="password" placeholder="confirm" name="confirm-passwd" required/><br />  -->
		<input type="submit" name="submit-signup" value="Register" />
	</form>
</body>
</html>