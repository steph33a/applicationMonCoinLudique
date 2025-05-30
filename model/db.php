<?php
global $connexion_bd;
function connexionToBaseUtilisateurs(){
// config.php
$host = 'localhost';

$dbname = 'moncoinludique';
$user = 'root';
$password = '';
global $connexion_bd;
try {
    $connexion_bd= new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $connexion_bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // gérer les erreurs en lançant des exceptions PHP
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
return $connexion_bd;
}

$connexion_bd = connexionToBaseUtilisateurs();
function deconnexionToBaseUtilisateurs(){
    $connexion_bd = null;
}


