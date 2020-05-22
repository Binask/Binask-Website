<?php
include "../database.php";
include "docentcheck.php";
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Startpagina</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Quattrocento&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
    <body>
    <h1 class="titel">BiNaSk</h1>
    <nav class="navbar navbar-default">
        <ul class="nav navbar-nav">
            <li><a href="index.php">Bronnen</a></li>
            <li><a href="categorie.php">Categorieën</a></li>
            <li><a href="gebruiker.php">Gebruikers</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="../index.php">Terug naar website</a></li>
        </ul>
    </nav><?php
