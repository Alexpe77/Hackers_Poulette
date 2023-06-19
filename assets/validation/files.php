<?php

require 'views/connect.php';

$filename = $_FILES['file'];
$allowed_extensions = array('.jpg', '.jpeg', '.png');
$extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

if (in_array($extension, $allowed_extensions)) {
    $sql = 'INSERT INTO poulette (file) VALUES (?)';
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$file]);
} else {
    echo 'Please upload a file with the right extension (.jpg , .jpeg, .png)';
}


?>