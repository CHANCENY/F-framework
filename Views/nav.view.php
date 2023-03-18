<?php @session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php \Assest\Assest::loadStyleSheets('assets/bootstrap/css'); ?>
    <title id="titlepage"></title>
</head>
<div class="w-100 bg-dark text-white p-4 d-flex">
    <div class="float-end w-75">
        <ul class="d-inline-flex align-items-end w-75 align-content-lg-stretch">
            <li class="list-unstyled ps-xxl-5"><a href="home-page" class="text-decoration-none text-white">Home</a></li>
            <li class="list-unstyled ps-5"><a href="about" class="text-decoration-none text-white">About</a></li>
            <li class="list-unstyled ps-5"><a href="contact" class="text-decoration-none text-white">Contact</a></li>
        </ul>
    </div>
</div>

