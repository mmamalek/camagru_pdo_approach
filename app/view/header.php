<?php
session_start();
$login = (empty($_SESSION["user_id"]) ? "login" : "logout");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
    <link rel="stylesheet" href="/public/css/main.css">
</head>
<body>
    <div class="header">
        <h1>Camagru</h1>
        <ul id="nav">
            <li><a href="/home">Gallery</a></li>
            <li><a href="/images/webcam">Camera</a></li>
            <?php echo (($login == "logout") ? '<li><a href="/home/myalbum">My Album</a></li>' : '' ); ?>
            <?php echo (($login == "logout") ? '<li><a href="/user/profile">profile</a></li>' : '' ); ?>
            <?php echo (($login == "login") ? '<li><a href="/user/register">register</a></li>' : '' ); ?>
            <li><?php echo "<a href='/user/$login' >$login </a>"; ?></li>
        </ul>
    </div>
    <div class="contents">