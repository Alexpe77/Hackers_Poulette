<?php
session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=id20943308_becode;charset=utf8', 'id20943308_alexp', 'NypenseMemeP@s7', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);
    
} catch (Exception $e) {
    die('Connection failed ' . $e->getMessage());
    exit;
}

?>