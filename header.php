<?php require 'connect.php' ?> 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> myCave </title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <div id="logo">
                <img src="assets/img/logo.png" alt="">
            </div>
            <ul id="ul-nav">
                <li> <a href="index.php">ACCUEIL</a>  </li>
                <li> <a href="stock.php">STOCK</a> </li>
                <li> <a href="#footer">CONTACT</a>  </li>
                <?php if(empty($_SESSION)) : ?>
                <li> <a href="connexion.php#form_connect">CONNEXION</a> </li>
                <?php else : ?>
                <li> <a href="disconnect.php">DECONNEXION </a> </li>
                <?php endif; ?>

            </ul>
        </nav>

        <div id="header">
                <?php if(empty($_SESSION)) : ?>
                <?php else : ?>
                    <p> Connecté en tant qu'admin </p>
                <?php endif; ?>
            <h1> BIENVENUE <br> <span id="title2"> SUR <img src="assets/img/logo-large.png" alt="" id="logo-img"> </span> </h1>
            <img src="assets/img/pexels-photo-1410138.jpeg" alt="" width="100%" id="header-img">
        </div>
    </header>