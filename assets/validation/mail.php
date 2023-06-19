<?php
require 'connect.php';

$email = $_POST['email'];
$pattern = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/i';

if (preg_match($pattern, $email))
 {
    $sql = 'INSERT INTO poulette (email) VALUES (?)';
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$email]);
} else {
    echo 'Please add a valid email adress.';
}

?>