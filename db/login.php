<?php
include "conection.php";


if (isset($_POST['submit'])) {
    $email = $_POST['email_address'];
    $password = $_POST['password'];
}
;


$query = "SELECT password FROM users WHERE email_address = '$email'";
$QueryResult = mysqli_query($conn, $query);

$check = mysqli_fetch_array($QueryResult);

if ($check) {
    $hash = $check['password'];

    $psw_verify = password_verify($password, $hash);
    if ($psw_verify) {
        session_start();
        $query = "SELECT id FROM users WHERE email_address = '$email'";
        $QueryResult = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($QueryResult);

        $current_user_id = $row['id'];

        $_SESSION["loggedin"] = true;
        $_SESSION["current_user_id"] = $current_user_id;
        header("Location: ../admin");
        exit();
    } else {
        echo '<script>localStorage.setItem("login_error", "Login failed. Please check your password.");</script>';
        echo '<script>window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
        exit();
    }
} else {
    echo '<script>localStorage.setItem("login_error", " User not found.");</script>';
    echo '<script>window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
    exit();
}

// $query = "SELECT password FROM users WHERE email_address = '$email'";
// $QueryResult = mysqli_query($conn, $query);

// $check = mysqli_fetch_array($QueryResult);

// $hash = $check['password'];


// $psw_verify = password_verify($password, $hash);
// if ($psw_verify){
//     echo "login success";
// } else {
//     echo "failed";
// }

?>