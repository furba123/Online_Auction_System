    <?php include "conection.php";

    if (isset($_POST['submit'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $email = $_POST['email_address'];
        $password = $_POST['password'];

        $hash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );


        $query = "SELECT * FROM users WHERE email_address = '$email'";

        $QueryResult = mysqli_query($conn, $query);

        $checkuserexists = mysqli_fetch_array($QueryResult);

        if (!$checkuserexists){
           
            $query = mysqli_query($conn, "INSERT INTO users (`first_name`, `last_name`, `phone_number`, `address`, `email_address`, `password`, `role`) VALUES ('$first_name', '$last_name', '$phone', '$address', '$email','$hash','customer')");

            if ($query) {
                // echo "User registered successfully.";
                $query = "SELECT id FROM users WHERE email_address = '$email'";
                $QueryResult = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($QueryResult);

                $current_user_id = $row['id'];

                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["current_user_id"] = $current_user_id;
                header("Location: ../admin");
                exit();
            } else {
                echo "Error creating user.";
            }

        } else {
            echo '<script>localStorage.setItem("register_error", "User already exists.");</script>';
            echo '<script>window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
            exit();
        }
        
    }
    ?>  
