<?php
    declare(strict_types=1);
    //! die folgendern 2 Zeilen in der Produktiv-Variante löschen!
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    
    require_once __DIR__ . '/../inc/db-connect.php';
    session_start();

    $path = ( !str_ends_with(dirname($_SERVER['SCRIPT_FILENAME']),'public') ) ? '../' : '' ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn Login</title>
    <link rel="stylesheet" href="<?= $path ?>../css/style.css">
</head>
<body>
    <?php include_once 'nav.php' ?>