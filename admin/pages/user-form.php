<?php include '../header.php';

if (isset($_GET['id']) ):
    if ($current_user_id != $_GET['id'] && $current_user['role'] != 'admin'):
        header("Location: " . '../');
    endif;
endif;

if (!isset($_GET['id']) && $current_user['role'] != 'admin'):
 
    header("Location: " . '../');
 
endif;

$user_update = false;
if (isset($_GET['id'])) {
    $user_update = true;

    $user_id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM users where `id` = '$user_id' ");

    $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

    if (!empty($rows)) {

        foreach ($rows as $row) {
            $user_firstname = $row['first_name'];
            $user_lastname = $row['last_name'];
            $user_phoneno = $row['phone_number'];
            $user_address = $row['address'];
            $user_email = $row['email_address'];
            $user_password = $row['password'];
            $user_role = $row['role'];
        }
    }
}
;

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email_address'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    

    $hash = password_hash(
        $password,
        PASSWORD_DEFAULT
    );


    $query = "SELECT * FROM users WHERE email_address = '$email'";

    $QueryResult = mysqli_query($conn, $query);

    $check = mysqli_fetch_array($QueryResult);

    if (!$check) {

        $query = mysqli_query($conn, "INSERT INTO users (`first_name`, `last_name`, `phone_number`, `address`, `email_address`, `password`, `role`) VALUES ('$first_name', '$last_name', '$phone', '$address', '$email','$hash', '$role')");

        if ($query) { ?>

            <div class="container">
                <div class="alert alert-success mt-3">
                    User registered successfully.
                </div>
            </div>
        <?php } else { ?>

            <div class="container">
                <div class="alert alert-danger mt-3">
                    Error creating user.
                </div>
            </div>
        <?php }
    } else { ?>

        <div class="container">
            <div class="alert alert-danger mt-3">
                User already exists.
            </div>
        </div>
    <?php }
}

if (isset($_POST['submit_update'])):

    $user_firstname = $_POST['first_name'];
    $user_lastname = $_POST['last_name'];
    $user_phoneno = $_POST['phone'];
    $user_address = $_POST['address'];
    $password = $_POST['password'];
    if (isset($_POST['role'])):
        $role = $_POST['role'];
    else:
        $role = $current_user['role'];
    endif;

    $hash = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    $query = mysqli_query($conn, "UPDATE users SET first_name='$user_firstname', last_name='$user_lastname', phone_number='$user_phoneno', address='$user_address', password='$hash', role='$role' WHERE id=$user_id");

    if ($query) { ?>
        <div class="container">
            <div class="alert alert-success mt-3">
                user updated successfully.
            </div>
        </div>
    <?php } else {
        $errorMessage = mysqli_error($conn);
        print_r($errorMessage);

        echo "Error updating user.";
    }
    // header("Location: user-form.php");
// exit();
endif;


?>

<div class="user-form my-5">
    <div class="container">
        <div class="title-wrapper d-flex align-items-center justify-content-between border-bottom pb-3 ">
            <h4>User Form</h4>
            <?php if ($current_user['role'] == 'admin'): ?>
                <a href="<?php echo $base_url; ?>/admin/pages/user-list.php" class="btn btn-primary">Go Back To User
                    List</a>
                <?php

            endif; ?>
            <?php if ($current_user['role'] == 'customer'): ?>
                <a href="<?php echo $base_url; ?>/admin/pages/profile.php" class="btn btn-primary">Go Back To profile
                </a>
                <?php

            endif; ?>

        </div>
        <form class="p-2 p-md-5 mb-5 border" enctype="multipart/form-data" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First name</label>
                        <input type="text" value="<?php echo $user_update ? $user_firstname : ''; ?>" name="first_name"
                            required class="form-control" id="first_name">

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last name</label>
                        <input type="text" value="<?php echo $user_update ? $user_lastname : ''; ?>" name="last_name"
                            required class="form-control" id="last_name">

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone number</label>
                        <input type="number" value="<?php echo $user_update ? $user_phoneno : ''; ?>" name="phone"
                            maxlength="10" required class="form-control" id="phone">

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" value="<?php echo $user_update ? $user_address : ''; ?>" name="address"
                            required class="form-control" id="address">

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="Useremailaddress" class="form-label">Email address</label>
                        <input type="email" <?php echo $user_update ? 'disabled' : ' name="email_address"' ?>
                            value="<?php echo $user_update ? $user_email : ''; ?>" required class="form-control"
                            id="useremailaddress">

                    </div>
                </div>

                <?php if ($user_update):
                    $user_role = $user_role;
                else:
                    $user_role = 'unset';
                endif;
                ?>
                <?php if ($current_user['role'] == 'admin'): ?>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="Useremailaddress" class="form-label">Role</label>

                            <select required class="form-control" name="role">
                                <option value="">Please select user role</option>
                                <option <?php echo $user_role == 'admin' ? 'selected' : '' ?> value="admin">Admin</option>
                                <!-- <option <?php // echo $user_role == 'seller' ? 'selected' : '' ?> value="seller">Seller</option> -->
                                <option <?php echo $user_role == 'customer' ? 'selected' : '' ?> value="customer">Customer
                                </option>
                            </select>

                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="userpassword" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" value="" name="password" required class="form-control"
                                id="userpassword">
                            <i class="bi bi-eye-slash togglePassword"></i>
                        </div>
                    </div>
                </div>

            </div>


            <?php if ($user_update): ?>
                <button type="submit" name="submit_update" class="btn btn-success">Update</button>
            <?php else: ?>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <?php endif; ?>
        </form>
    </div>


    <?php include '../footer.php'; ?>