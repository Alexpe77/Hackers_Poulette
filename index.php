<?php

require 'assets/views/connect.php';

if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

	$name = htmlspecialchars(trim($_POST['visitor_name']), ENT_QUOTES, 'UTF-8');
	$fname = htmlspecialchars(trim($_POST['visitor_fname']), ENT_QUOTES, 'UTF-8');
	$email = filter_var(trim($_POST['visitor_email']), FILTER_SANITIZE_EMAIL);
	$desc = htmlspecialchars(trim($_POST['visitor_message']), ENT_QUOTES, 'UTF-8');
	$targetDirectory = '../uploads';
	$targetFile = $targetDirectory . basename($_FILES['file']['name']);

	if (empty($name) || empty($fname) || empty($email) || empty($desc)) {
		echo "<script language='JavaScript'>alert('Please add valid information.');</script>";
		exit;
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<script language='Javascript'>alert('Please insert a valid email address.');</script>";
		exit;
	} else {

		if (strlen($name) < 2 || strlen($name) > 255) {
			echo "<script language='Javascript'>alert('Please enter a name between 2 and 255 characters long.');</script>";
			exit;
		}

		if (isset($_FILES['file']) && $_FILES['file']['size'] > 0) {
			$maxFileSize = 2 * 1024 * 1024;
			$filename = $_FILES['file']['name'];
			$filetmp = $_FILES['file']['tmp_name'];
			$allowed_extensions = array('.jpg', '.gif', '.png');
			$extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

			if ($_FILES['file']['size'] > $maxFileSize) {
				echo "<script language='Javascript'>alert('File size exceeds the maximum allowed limit (2 MB).');</script>";
				exit;
			}

			if (in_array($extension, $allowed_extensions)) {

				if (move_uploaded_file($filetmp, $targetFile)) {
					echo "<script language='Javascript'>alert('File uploaded');</script>";
					exit;
				}
			}

			if (!move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
				echo "<script language='Javascript'>alert('Failed to upload the file.');</script>";
				exit;
			}
		} else {
			echo "<script language='Javascript'>alert('Please upload a file with the right extension (.jpg, .gif, .png)');</script>";
			exit;
		}
	}
	$sql = 'INSERT INTO poulette (name, fname, email, file_path, description) VALUES (?,?,?,?,?)';
	$stmt = $bdd->prepare($sql);
	$stmt->execute([$name, $fname, $email, $targetFile, $desc]);

	echo "<script language='Javascript'>alert('Message send successfully.');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Hackers Poulette</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="assets/validation/script.js" defer></script>
</head>
<body>
<body class="bg-[url('assets/img/header.png')] flex flex-col items-center">
	<main>
		<h1 class="text-white text-4xl mb-11 mt-11 text-center">Contact support</h1>
		<div class="!z-5 relative flex flex-col rounded-[20px] max-w-[350px] md:max-w-[400px] bg-white bg-clip-border shadow-3xl
		shadow-shadow-500 flex flex-col w-full !p-6 3xl:p-![18px] bg-white undefined">
			<form id="contactForm" action="index.php" method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label for="fname">Firstname</label>
					<input type="text" name="visitor_fname" id="visitor_fname" placeholder="John" pattern=[A-Z\sa-z]{2,20} value="" minlength="2" maxlength="255" required class="mt-2 flex h-12 w-full items-center justify-center rounded-xl border bg-white/0 p-3 text-sm outline-none border-gray-200">
				</div>
				<div class="mb-3">
					<label for="name">Name</label>
					<input type="text" name="visitor_name" id="visitor_name" placeholder="Doe" pattern=[A-Z\sa-z]{2,20} value="" minlength="2" maxlength="255" required class="mt-2 flex h-12 w-full items-center justify-center rounded-xl border bg-white/0 p-3 text-sm outline-none border-gray-200">
				</div>

				<div class="mb-3">
					<label for="email">Email</label>
					<input type="text" name="visitor_email" id="visitor_email" placeholder="john.doe@email.com" value="" maxlength="50" required class="mt-2 flex h-12 w-full items-center justify-center rounded-xl border bg-white/0 p-3 text-sm outline-none border-gray-200">
				</div>

				<div class="mb-3">
					<label for="file">File</label><br>
					<input type="file" name="file" value="" accept=".png, .jpg, .gif" class="cursor-pointer">
				</div>

				<div class="mb-3">
					<label for="description">Description</label><br>
					<textarea name="visitor_message" id="visitor_message" placeholder="Hello World" minlength="5" maxlength="1000" pattern=[A-Za-z0-9\s?!,;:]{2,1000} value="" required class="mt-2 flex h-28 w-full items-center justify-center rounded-xl border bg-white/0 p-3 text-sm outline-none border-gray-200">
				</textarea>
				</div>
				<button type="submit" name="submit" class="font-bold rounded-xl border bg-white/0 p-3 text-sm outline-none border-gray-200">Send</button>
			</form>
	</main>
</body>

</html>