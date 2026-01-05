<?php

function getConnexion():object
{
    $pdo = new PDO('mysql:host=...;port=...;dbname=...;charset=utf8', 'username', 'mdp');
    
    return $pdo;
}