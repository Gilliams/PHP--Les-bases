<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'auth.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Florian Andrieux">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>
        <?php if (isset($title)) : ?>
            <?= $title; ?>
        <?php else : ?>
            Mon site
        <?php endif ?>
    </title>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <a class="navbar-brand" href="#">Mon site</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <?= nav_menu('nav-link'); ?>
            </ul>
            <ul class="navbar-nav">
                <?php if (est_connecte()) : ?>
                    <li class="nav-item"><a href="/logout.php" class="nav-link">Se déconnecter</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <main role="main" class="container">