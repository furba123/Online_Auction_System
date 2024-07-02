<?php

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false) {

    header("Location: ../");
    exit();
}

// Check if the logout button is clicked
if (isset($_POST['logoutBtn'])) {
    // Clear all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to login page or any other desired location
    header("Location: ../");
    exit();
};


include __DIR__ . '/../db/conection.php';

$current_user_id = $_SESSION["current_user_id"];

$query = "SELECT * FROM users WHERE id = '$current_user_id'";
$QueryResult = mysqli_query($conn, $query);
$current_user = mysqli_fetch_assoc($QueryResult);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo $base_url ?>/admin/admin-style.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="navbar logo ">
                <a href="<?php echo $base_url; ?>"><img width="250" src="<?php echo $base_url; ?>/img/logo.png" alt=" "></a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link me-3 active" aria-current="page" href="<?php echo $base_url . "/admin/dashboard.php"; ?>">Dashboard</a>
                    <?php if ($current_user['role'] == 'admin') : ?>
                        <a class="nav-link me-3 active" aria-current="page" href="<?php echo $base_url . "/admin/pages/product-list.php"; ?>">Products</a>
                        <a class="nav-link me-3 active" aria-current="page" href="<?php echo $base_url . "/admin/pages/user-list.php"; ?>">Users</a>
                         <a class="nav-link me-3 active" aria-current="page" href="<?php echo $base_url . "/admin/pages/messages.php"; ?>">Messages</a>
                    <?php else : ?>
                        <a class="nav-link me-3 active" aria-current="page" href="<?php echo $base_url . "/shop.php"; ?>">Shop</a>
                    <?php endif; ?>
                    <a class="nav-link me-3 active" href="<?php echo $base_url . "/admin/pages/profile.php"; ?>">Profile</a>
                       <form method="POST">
                        <button type="submit" name="logoutBtn" class="btn btn-secondary">Log out</button>
                    </form>
                </div>
            </div>
        </div>

    </nav>