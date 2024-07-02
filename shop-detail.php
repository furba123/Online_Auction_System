<?php include 'include/header.php';
if (isset($_SESSION["current_user_id"])):
    $current_user_id = $_SESSION["current_user_id"];
endif;



if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM products where `id` = '$id' ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    // $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (!empty($row)) {

        $product_name = $row['product_name'];
        $product_image = $row['product_image'];
        $product_price = $row['product_price'];
        $product_bid = $row['starting_bid'];
        $auction_time = $row['auction_time'];
        $product_description = $row['product_description'];
        $starting_bid = $row['starting_bid'];
        $highest_bid = $row['highest_bid'];

    }
}


if (isset($_POST['submit_bid'])) {
    if (!empty($current_user_id )):
        $bid_amt = $_POST['bid_amt'];

        if ($bid_amt <= $starting_bid) {
            $bid_msg_err = 'Please enter bid amount more that starting bid amount.';
        } else {

            if ($bid_amt <= $row['highest_bid']) {
                $bid_msg_err = 'Please enter the highest bid amount. ';
            } else {
                
                $query = mysqli_query($conn, "UPDATE products SET highest_bid='$bid_amt', highest_bid_user_id='$current_user_id' WHERE id=$id");

                if ($query) :
                    
                    $highest_bid =  $bid_amt;

                    // Bid products table
                    $userQuery = mysqli_query($conn, "SELECT * FROM bid_products WHERE `user_id` = '$current_user_id'");
                    if ($userQuery) {
                        $userData = mysqli_fetch_assoc($userQuery);

                        if ($userData) {
                     
                            $bidProducts = unserialize($userData['bid_products']);

                            $bidProductId = $_GET['id'];
                            $bidPrice = $bid_amt;
                            $bidProducts[$bidProductId] = $bidPrice;

                            $serializedBidProducts = serialize($bidProducts);
                            $updateQuery = mysqli_query($conn, "UPDATE bid_products SET bid_products='$serializedBidProducts' WHERE user_id=$current_user_id");
                        } else {
                          
                            $bidProductId = $_GET['id'];
                            $bidPrice = $bid_amt;
                            $bidProducts = array($bidProductId => $bidPrice);

                            $serializedBidProducts = serialize($bidProducts);
                            $updateQuery = mysqli_query($conn, "INSERT INTO bid_products (`user_id`, `bid_products`) VALUES ('$current_user_id', '$serializedBidProducts')");
                        }

                      
                        if ($updateQuery) {

                            $bid_msg_success = 'Your bid has been placed successfully';
                        } else {
                             print_r("ERROR");
                        }
                    }; 

                else :
                    $bid_msg_err = 'Something went wrong';

                endif;
            }
        } 
    else: 
        $bid_msg_err = 'Please login to bid products.';
     endif;
}

if ($row) :
?>

    <div class="breadcrumbs">
        <a href="index.php">Home</a>
        <i class="bi bi-arrow-right"></i>
        <a href="shop.php">Shop</a>
        <i class="bi bi-arrow-right"></i>
        <span><?php echo $product_name; ?> </span>
    </div>


    <div class="detail-page pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 py-4">
                    <div class="product-image">
                        <img src="<?php echo $base_url . '/admin/uploads/' . $product_image ?>" class="card-img-top" alt="...">
                    </div>
                </div>
                <div class="col-md-6 py-4">
                    <div class="product-info">
                        <h2 class="mb-3"><?php echo $product_name; ?></h2>
                        

                        <div class="desc border-top border-bottom py-3 mt-3">
                            <h6>Description: </h6>
                            <p class='text-align-justify'><?php echo $product_description; ?></p>
                        </div>

                        <?php $current_time = date("Y-m-d H:i:s"); ?>

                        <div class="timer pt-3 d-flex align-items-center">
                            <?php if ($auction_time > $current_time): ?>
                                <h6 class="my-2 me-3"> This Auction Ends in:</h6>
                                <div class="text-danger" data-countdowntime="<?php echo $auction_time ?>" id="countdown-timer"></div>
                            <?php else: ?>
                                <h6 class="my-2 me-3 text-danger"> The Auction has ended.</h6>
                            <?php endif; ?>
                        </div>

                        <?php
                        
                        $bid_amount = number_format($starting_bid, 0, '.', ',');
                        if ($starting_bid > 0 && $highest_bid < $starting_bid) :
                        ?>

                            <div class="bid py-2 d-flex align-items-center">
                                <h6 class="my-2 me-3">Best Price:</h6>
                                <b class="text-primary">Rs. <?php echo $bid_amount ?></b>
                            </div>
                        <?php endif; ?>


                        <?php if ($highest_bid > $starting_bid) :
                        ?>

                            <div class="bid  d-flex align-items-center">
                                <h6 class="my-2 me-3">Best Price:</h6>
                                <b class="text-primary">Rs. <?php echo number_format($highest_bid, 0, '.', ',') ?></b>
                            </div>
                        <?php
                        endif; ?>

                        <?php
                        
                        if ($auction_time > $current_time):
                        ?>
                        <hr>
                        <div class="bid-amt pb-5">
                            <form enctype="multipart/form-data" method="POST">

                                <label class="label mb-2">BID AMOUNT:</label>
                                <div class="input-group">
                                    <input name="bid_amt" type="number" class="form-control" placeholder="Enter your bid amount">
                                    <button type="submit" name="submit_bid" class="btn btn-success">Submit A Bid</button>

                                </div>
                                <?php if (isset($bid_msg_err)) : ?>
                                    <div class="alert alert-danger mt-3">
                                        <?php echo $bid_msg_err; ?>
                                    </div>
                                <?php elseif (isset($bid_msg_success)) : ?>
                                    <div class="alert alert-success mt-3">
                                        <?php echo $bid_msg_success; ?>
                                    </div>

                                <?php endif; ?>
                            </form>
                        </div>
                        <?php else: 
                        
                            $query = "SELECT * FROM products where `highest_bid` = '$highest_bid' ";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            $highest_bid_user_id = $row['highest_bid_user_id'];


                            if ($highest_bid > $starting_bid && $highest_bid_user_id != null):
                            
                            
                            
                            $query = "SELECT * FROM users where `id` = '$highest_bid_user_id' ";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);

                            $user_fn = $row['first_name'];
                            $user_ln = $row['last_name'];

                            
                            
                              if(!empty($user_fn)) : 
                            ?>
                            
                            <div class="winner-wrap">
                                <img src="img/trophy.svg" class='img-fluid' alt="">
                                <h4 class="text-center">The Winner is: <br> <span ><?php echo $user_fn . ' ' . $user_ln; ?></span> </h4>
                            </div>

                     

                        <?php endif; endif; endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php endif;
include 'include/footer.php' ?>