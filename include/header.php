<?php 
session_start();

include __DIR__ . '/../db/conection.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav>
        <div class="navigation">

            <nav class="navbar navbar-expand-lg navbar-dark w-100">
                <div class="logo navbar-brand">
                    <a href="index.php"><img src="img/logo.png" alt=" "></a>
                </div>

                <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarNav">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item m-2 active">
                            <a class="nav-link" href="index.php">Home </a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <?php 
                        if (isset($_SESSION["loggedin"])) : ?>
                            <li class="nav-item m-2"><a class="nav-link" href="admin">
                                    <i class="bi bi-person"></i>
                                    <?php 
                                        if (function_exists('get_the_user')):
                                      echo 'Hi ' . get_the_user("first_name") . ' ' . get_the_user("last_name"); 
                                        endif;
                                    ?></a></li>
                        <?php else : ?>
                            <li class="nav-item m-2"><a class="nav-link" data-bs-toggle="modal" data-bs-target="#loginModal" href="#">
                                    <i class="bi bi-person"></i>
                                    Register / Login</a></li>
                        <?php endif ?>
                    </ul>
                </div>
            </nav>

        </div>

    </nav>