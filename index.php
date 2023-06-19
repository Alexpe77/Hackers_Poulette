<?php

require 'views/connect.php';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
	$name = $_POST['name'];
	$fname = $_POST['fname'];
	$email = $_POST['email'];
	$file = $_POST['file'];
	$desc = $_POST['desc'];

	if(isset($_POST)
		
	
	) {
		$sql = "INSERT INTO poulette (name, fname, email, file, desc) VALUES (?,?,?,?,?)";
		$stmt = $bdd->prepare($sql);
		$stmt->execute([$name, $fname, $email, $file, $desc]);

	} else {
		echo "Please add valid informations.";
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Hackers Poulette</title>
	<link rel="stylesheet" href="./assets/css/style.css" media="screen" charset="utf-8">
</head>
<body>
	<h1>Contact support</h1>
	<form action="index.php" method="post">
		<div>
			<label for="name">Name</label>
            <input type="text" name="visitor_name" placeholder="Doe" pattern=[A-Z\sa-z]{2,20} value="" required>
		</div>

		<div>
			<label for="fname">Firstname</label>
			<input type="text" name="visitor_fname" placeholder="John" pattern=[A-Z\sa-z]{2,20} value="" required>
		</div>

		<div>
			<label for="email">Email</label>
			<input type="text" name="email" placeholder="john.doe@email.com" value="" required>
		</div>
        <!-- File à définir -->
		<div>
			<label for="file">File</label>
			<input type="text" name="file" value="">
		</div>
        <!-- File à définir -->
        <div>
            <label for="description">Write your message here</label><br>
            <textarea id="message" name="visitor_message" placeholder="Hello World" pattern=[A-Za-z0-9\s?!,;:]{2,1000} value="" required></textarea>
        </div>

		<button type="submit" name="submit">Send</button>
	</form>
</body>
</html>