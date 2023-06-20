<?php

require 'connect.php';

if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
	$name = htmlspecialchars(trim($_POST['visitor_name']), ENT_QUOTES, 'UTF-8');
	$fname = htmlspecialchars(trim($_POST['visitor_fname']), ENT_QUOTES, 'UTF-8');
	$email = filter_var(trim($_POST['visitor_email']),FILTER_SANITIZE_EMAIL);
	// $file = $_POST['file'];
	$desc = htmlspecialchars(trim($_POST['visitor_message']), ENT_QUOTES, 'UTF-8');

	if (empty($name) || empty($fname) || empty($email) || empty($desc)) {
		echo 'Please add valid informations.';
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo 'Please insert a valid email address.';
	} else {

		$maxFileSize = 2 * 1024 *1024;
		if ($_FILES['file']['size'] > $maxFileSize) {
			echo 'File size exceeds the maximum allowed limit (2Mo).';
            exit;
		}
		
		$sql = 'INSERT INTO poulette (name, fname, email, description) VALUES (?,?,?,?)';
		$stmt = $bdd->prepare($sql);
		$stmt->bindParam($name, $fname, $email, $desc);
		$stmt->execute([$name, $fname, $email, $desc]);

		echo 'Data inserted successfully.';
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Hackers Poulette</title>
	<link rel="stylesheet" href="../css/style.css" media="screen" charset="utf-8">
	<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[url('../css/header.png')] flex flex-col items-center">
	<main>
		<h1 class="text-white text-4xl mb-11 mt-11 text-center">Contact support</h1>
		<div class="!z-5 relative flex flex-col rounded-[20px] max-w-[350px] md:max-w-[400px] bg-white bg-clip-border shadow-3xl
		shadow-shadow-500 flex flex-col w-full !p-6 3xl:p-![18px] bg-white undefined">
			<form action="./contact.php" method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label for="fname">Firstname</label>
					<input type="text" name="visitor_fname" placeholder="John" pattern=[A-Z\sa-z]{2,20} value="" minlength="2" required class="mt-2 flex h-12 w-full items-center justify-center rounded-xl border bg-white/0 p-3 text-sm outline-none border-gray-200">
				</div>
				<div class="mb-3">
					<label for="name">Name</label>
					<input type="text" name="visitor_name" placeholder="Doe" pattern=[A-Z\sa-z]{2,20} value="" minlength="2" required class="mt-2 flex h-12 w-full items-center justify-center rounded-xl border bg-white/0 p-3 text-sm outline-none border-gray-200">
				</div>

				<div class="mb-3">
					<label for="email">Email</label>
					<input type="text" name="visitor_email" placeholder="john.doe@email.com" value="" required class="mt-2 flex h-12 w-full items-center justify-center rounded-xl border bg-white/0 p-3 text-sm outline-none border-gray-200">
				</div>

				<div class="mb-3">
					<label for="file">File</label><br>
					<input type="file" name="file" value="" accept=".png, .jpg, .gif" class="cursor-pointer">
				</div>

				<div class="mb-3">
					<label for="description">Description</label><br>
					<textarea id="message" name="visitor_message" placeholder="Hello World" pattern=[A-Za-z0-9\s?!,;:]{2,1000} value="" required class="mt-2 flex h-28 w-full items-center justify-center rounded-xl border bg-white/0 p-3 text-sm outline-none border-gray-200">
				</textarea>
				</div>
					<button type="submit" name="submit" class="font-bold rounded-xl border bg-white/0 p-3 text-sm outline-none border-gray-200">Send</button>
				
			</form>
	</main>
</body>

</html>