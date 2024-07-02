 <?php include '../header.php';
     if (isset($_GET['s'])){
    $searchTerm = $_GET['s'];
    $sql = "SELECT * FROM users WHERE first_name LIKE '%$searchTerm%' OR last_name LIKE '%$searchTerm%' OR email_address LIKE '%$searchTerm%' OR role LIKE '%$searchTerm%'";

    $result = mysqli_query($conn, $sql);
    $search_results = mysqli_fetch_all($result, MYSQLI_ASSOC);
 }
    if ($current_user['role'] == 'customer') : header("Location: " . '../');
    endif;

    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];
        $query = mysqli_query($conn, "DELETE FROM users where `ID` = '$user_id' ");

        if ($query) {

            $_SESSION['status_msg'] = "User deleted successfully.";
        } else {
            $_SESSION['status_msg'] = "Error deleting User";
        };

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    };

    if (isset($_SESSION['status_msg'])) : ?>
     <div class="container">
         <div class="alert alert-danger mt-3">
             <?php echo $_SESSION['status_msg']; ?>
         </div>
     </div>
 <?php
        unset($_SESSION['status_msg']);
    endif;
    ?>
 <main class="pb-5">

      <?php $query = "SELECT * FROM users";
      $result = mysqli_query($conn, $query);

       if (isset($_GET['s'])):
        $rows = $search_results;
       else:
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        endif;

    
         ?>
 <div class="user-form my-5">
     <div class="container">
         <div class="title-wrapper d-flex align-items-center justify-content-between border-bottom 
              pb-3 mb-3">
             <h4>User List</h4>
              <form class="form">
                 <div class="input-group  search-wrapper" >
                  <input name="s" type="text" <?php echo isset($_GET['s']) && $_GET['s'] != '' ? 'value  = '. $_GET['s'] .' ' : ''?> class="form-control " placeholder="Search..">
                  <i class="icon bi bi-search"></i>
                 </div>
             </form>
             <a href="<?php echo $base_url; ?>/admin/pages/user-form.php" class="btn btn-primary">Add New User</a>
         </div>
         <?php if ($rows) :  ?>
             <table class="table table-hover">
                 <thead>
                     <tr>
                         <th scope="col">Number</th>
                         <th scope="col">User Name</th>
                         <th scope="col">Email</th>
                         <th scope="col">User role</th>
                         <th scope="col">Address</th>
                         <th scope="col">Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $i = 1;
                        foreach ($rows as $row) {
                        ?>
                         <tr>
                             <th scope="row"><?php echo $i; ?></th>
                             <td><?php echo $row['first_name'] . ' ' . $row['last_name'] ?></td>
                             <td><?php echo $row['email_address'] ?></td>
                             <td><?php echo $row['role'] ?></td>
                             <td><?php echo $row['address'] ?></td>
                             <?php if ($_SESSION["current_user_id"] == $row['id']) : ?>
                                 <td style="white-space:nowrap"><a href="user-form.php?id=<?php echo $row['id'] ?>" class="btn btn-outline-secondary w-75">Edit Profile</a>
                                   
                                 </td>
                             <?php else : ?>
                                 <td style="white-space:nowrap"><a href="user-form.php?id=<?php echo $row['id'] ?>" class="btn btn-outline-secondary">Edit</a>
                                     
                                     <a data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" href="?id=<?php echo $row['id'] ?>" class="btn btn-outline-danger modal-trigger">Delete</a>
                                 </td>
                             <?php endif; ?>
                         </tr>
                     <?php $i++;
                        } ?>
                 </tbody>
             </table>
              <?php else :
            
            if (isset($_GET['s'])):
            ?>

            <h3 class="text-center text-muted">Users not found.</h3>


             <?php else : ?>

             <h5 class="text-center my-5">No users found.</h5>
         <?php endif; endif; ?>

     </div>
 </div>
</main> 
 <?php include '../footer.php'; ?>