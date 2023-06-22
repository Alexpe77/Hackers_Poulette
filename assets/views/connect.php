<?php

try {

    $host = 'localhost';
    $dbname = 'id20943308_becode';
    $user = 'id20943308_alexp';
    $pwd = 'NypenseMemeP@s7';
    $hash = password_hash($pwd, PASSWORD_DEFAULT);

    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user , $pwd, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);
    
} catch (Exception $e) {
    die('Connection failed ' . $e->getMessage());
    exit;
}

?>