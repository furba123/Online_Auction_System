<?php
$dbname = "auction";
$host = "localhost";
$username = "root";
$password  = "";
$conn = mysqli_connect($host, $username, $password, $dbname) or die("Connection Failed");

// Change path according to your htdocs
$file_path = '/pragya';

$urlPath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
$base_url = $urlPath . $file_path;

date_default_timezone_set('Asia/Kathmandu');

// When uploaded to server{}
// $base_url = $urlPath;

// Functions

// GET CURRENT USER

function get_the_user($data){
    global $conn;
    if (isset($_SESSION["current_user_id"])):
        $current_user_id = $_SESSION["current_user_id"];
    endif;   
    $query = "SELECT * FROM users where `id` = '$current_user_id' ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $user_data = $row[$data];

    return $user_data;

}


// UPDATE CURRENT USER
function update_the_user($fn, $ln, $phone, $address){
    global $conn;
    if (isset($_SESSION["current_user_id"])):
        $current_user_id = $_SESSION["current_user_id"];
    endif;  

    $query = mysqli_query($conn, "UPDATE users SET first_name='$fn', last_name='$ln', phone_number='$phone', address='$address'WHERE id=$current_user_id");
 
    if ($query):
        echo 'Profile updated successfully.';
    else:    
        echo 'Error updating profile.';
    endif;

}

