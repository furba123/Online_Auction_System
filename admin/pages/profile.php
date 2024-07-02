 <?php include '../header.php';
 
 $user_fn = get_the_user('first_name');
 $user_ln = get_the_user('last_name');
//  $user_image = get_the_user('first_name');
 $email = get_the_user('email_address');
 $address = get_the_user('address');
 $phone_number = get_the_user('phone_number');
 $role = get_the_user('role');
 
 ?>


 <div class="user-form my-5">
     <div class="container">
         <div class="title-wrapper d-flex align-items-center justify-content-between border-bottom 
              pb-3 mb-3">
             <h4>Profile</h4>
          <a href="user-form.php?id=<?php echo $current_user_id; ?>" class="btn btn-primary">Edit Profile </a>
          </div>

         <div class="row">
            <div class="col-md-3 py-3">
                   <div class="user-profile">
                    <img class="img-fluid" src="<?php echo $base_url . '/img/user-img.png' ?>" alt="">
                   </div>
            </div>

            <div class="col-md-6 py-3">
                    <table class="table table-striped ">
                        <tr>
                            <td scope="row">Full Name:</td>
                            <td class="text-capitalize"><?php echo $user_fn . ' ' . $user_ln; ?></td>
                        </tr>
                        <tr>
                            <td scope="row">Email Address:</td>
                            <td><?php echo $email ?></td>
                        </tr>
                        <tr>
                            <td scope="row">Address:</td>
                            <td class="text-capitalize"><?php echo $address ?></td>
                        </tr>
                        <tr>
                            <td scope="row">Phone Number:</td>
                            <td><?php echo $phone_number ?></td>
                        </tr>
                        <tr>
                            <td scope="row">Role:</td>
                            <td class="text-uppercase"><?php echo $role ?></td>
                        </tr>
                    </table>
            </div>
         </div>
         

     </div>
 </div>
 <?php include '../footer.php'; ?>