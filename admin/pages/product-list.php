 <?php include '../header.php';
 if (isset($_GET['s'])){
    $searchTerm = $_GET['s'];

    if ($current_user['role'] == 'seller'):
        $sql = "SELECT * FROM products WHERE product_name LIKE '%$searchTerm%' AND created_by = '$current_user_id'";
    else:    
         $sql = "SELECT * FROM products WHERE product_name LIKE '%$searchTerm%'";
     endif;     

    $result = mysqli_query($conn, $sql);
    $search_results = mysqli_fetch_all($result, MYSQLI_ASSOC);
 }


    if ($current_user['role'] == 'customer') : header("Location: " . '../'); endif;

    $query = "SELECT * FROM products";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];
        $query = mysqli_query($conn, "DELETE FROM products where `ID` = '$product_id' ");

        if ($query) {
            session_start();
            $_SESSION['status_msg'] = "Product deleted successfully.";
        } else {
            $_SESSION['status_msg'] = "Error deleting product";
        };

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    };
    

    ?>

 <?php if (isset($_SESSION['status_msg'])) : ?>
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

      <?php 
      if ($current_user['role'] == 'seller'):
        $query = "SELECT * FROM products WHERE created_by=$current_user_id";
      else:
        $query = "SELECT * FROM products";
      endif; 

      $result = mysqli_query($conn, $query);

       if (isset($_GET['s'])):
        $rows = $search_results;
       else:
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        endif;

    
         ?>


   <div class="product-form my-5">
     <div class="container">
          <div class="title-wrapper d-flex align-items-center justify-content-between border-bottom 
              pb-3 mb-3">
             <h4>Product List</h4>
              <form class="form">
                 <div class="input-group  search-wrapper" >
                  <input name="s" type="text" <?php echo isset($_GET['s']) && $_GET['s'] != '' ? 'value  = '. $_GET['s'] .' ' : ''?> class="form-control " placeholder="Search..">
                  <i class="icon bi bi-search"></i>
                 </div>
             </form>
             <a href="<?php echo $base_url; ?>/admin/pages/product-form.php" class="btn btn-primary">Add New Product</a>
         </div>
        
         <?php if ($rows) : ?>
            <div class="table-responsive">
             <table class="table table-hover">
                 <thead>
                     <tr>
                         <th scope="col">Number</th>
                         <th scope="col">Product Image</th>
                         <th scope="col">Product Name</th>
                        <th scope="col"> Best Price</th>
                         <th scope="col">Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $i = 1;
                        foreach ($rows as $row) {
                            $imageURL = '../uploads/' . $row["product_image"];

                        ?>
                         <tr>
                             <th scope="row"><?php echo $i; ?></th>
                             <td>
                                 <img class="img-fluid img-thumbnail" width="100" src="<?php echo $imageURL; ?>" alt="">
                             </td>
                             <td><?php echo $row['product_name'] ?></td>
                             <td><?php echo $row['starting_bid'] ?></td>
                             <td style="white-space:nowrap"><a href="product-form.php?id=<?php echo $row['id'] ?>" class="btn btn-outline-secondary">Edit</a>
                                 <a data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" href="?id=<?php echo $row['id'] ?>" class="btn btn-outline-danger modal-trigger">Delete</a>
                             </td>
                         </tr>
                     <?php $i++;
                        } ?>


                 </tbody>
             </table>
            </div>
         <?php else :
            
            if (isset($_GET['s'])):
            ?>

            <h3 class="text-center text-muted">Product not found.</h3>


            <?php else: ?>

            <h5 class="text-center my-5">No products found. Please add products to list here.</h5>

             <?php endif; endif; ?>
     

        </div>
   </div>
</main>

 <?php include '../footer.php'; ?>