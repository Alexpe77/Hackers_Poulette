<?php
require 'views/connect.php';

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

$email = '';
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

if(!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    // echo ("$email is a valid address");
    return $email;
} else {
    echo ("$email is not a valid email address");
}

?>