<?php
include '../header.php';
if (isset($_GET['s'])) {
    $searchTerm = $_GET['s'];
    $sql = "SELECT * FROM products WHERE product_name LIKE '%$searchTerm%'";

    $result = mysqli_query($conn, $sql);
    $search_results = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $search_products_id = [];

    foreach ($search_results as $product) {
        $product_id = $product['id'];

        $search_products_id[] = $product_id;
    }

};

if (isset($_POST['place_order'])) :

   $product_name = $_POST['product_name'];

    $amount = $_POST['product_price'];
    $payment_method = $_POST['payment_option'];
    $order_note = $_POST['order_note'];
    $order_note = htmlspecialchars($order_note, ENT_QUOTES, 'UTF-8');

    $customer_id = $current_user_id;

    $query = "SELECT * FROM users where id = $customer_id";
    $result = mysqli_query($conn, $query);
    $user_data = mysqli_fetch_assoc($result);


    $customer_name = $user_data['first_name'] . ' ' . $user_data['last_name'];

    $product_id = $_POST['product_id'];


    $query = mysqli_query($conn, "INSERT INTO orders (`customer_id`, `customer_name`, `product_id`,`product_name`, `amount`, `payment_method`, `order_note`) VALUES ('$customer_id', '$customer_name', '$product_id', '$product_name', '$amount', '$payment_method', '$order_note')");

    
     if ($query) {  ?>
        <div class="container">
            <div class="alert alert-success mt-3">
                Your order has been placed successfully.
            </div>
        </div>
<?php $order_placed = true; } else {
        $errorMessage = mysqli_error($conn);
        print_r($errorMessage);
        echo "Error creating order.";
    }

endif;


if ($current_user['role'] == 'customer'):

    $query = "SELECT * FROM bid_products WHERE `user_id` = $current_user_id";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    ?>
    <main class="pb-5">


        <div class="product-form my-5">
            <div class="container">
                <div class="title-wrapper d-flex align-items-center justify-content-between border-bottom 
              pb-3 mb-3">
                    <h4>Bid Products List</h4>
                    <form class="form">
                        <div class="input-group  search-wrapper">
                            <input name="s" type="text" <?php echo isset($_GET['s']) && $_GET['s'] != '' ? 'value  = ' . $_GET['s'] . ' ' : '' ?> class="form-control " placeholder="Search..">
                            <i class="icon bi bi-search"></i>
                        </div>
                    </form>
                </div>
                <?php if ($rows):

                    $bid_products = $rows[0]['bid_products'];

                    $bidProductsArray = unserialize($bid_products);

                    ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">SN</th>
                                    <th scope="col">Product Image</th>
                                    <th scope="col">Product Name</th>
                                    <th class="text-center" scope="col">Best Price</th>
                                    <th class="text-center" scope="col">Your Bid Amount</th>
                                    <th class="text-center" scope="col">Highest Bid Amount</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                $current_time = date("Y-m-d H:i:s");
                                foreach ($bidProductsArray as $product_id => $bid_price) {


                                    if (isset($_GET['s'])) {

                                        if (in_array($product_id, $search_products_id)) {
                                            $query = "SELECT * FROM products where id = $product_id";

                                        } else {
                                            continue;
                                        }

                                    } else {
                                        $query = "SELECT * FROM products where id = $product_id";
                                    }

                                    $result = mysqli_query($conn, $query);
                                    $product = mysqli_fetch_assoc($result);

                                    $imageURL = '../uploads/' . $product["product_image"];
                                    if ($product['id']):

                                        $auction_time = $product['auction_time'];

                                        ?>
                                        <tr>
                                            <th class="text-center" scope="row">
                                                <?php echo $i; ?>
                                            </th>
                                            <td>
                                                <img class="img-fluid img-thumbnail" width="100" src="<?php echo $imageURL; ?>" alt="">
                                            </td>
                                            <td>
                                                <?php echo $product['product_name'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $product['starting_bid'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $bid_price; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $product['highest_bid'] ?>
                                            </td>
                                            <td class="text-center" style="white-space:nowrap">
                                                <a href="<?php echo $base_url . '/shop-detail.php?id=' . $product['id'] ?>"
                                                    class="btn btn-outline-secondary  w-100">View Product</a>
                                                <?php if ($product['highest_bid'] == $bid_price && $auction_time < $current_time): ?>
                                                    <br>
                                                    <?php
                                                    $product_id = $product['id'];
                                                    $query = "SELECT * FROM orders WHERE `customer_id` = $current_user_id AND `product_id` = $product_id";
                                                    $result = mysqli_query($conn, $query);
                                                    $order_placed = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                                    if ($order_placed): ?>
                                                    <button type="button" disabled
                                                        class="btn disabled btn-success w-100 mt-2">Claimed </button>
                                                    <?php else :?>   
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#paymentModal-<?php echo $product['id']; ?>"
                                                        class="btn btn-outline-success w-100 mt-2">Claim Now</a>
                                                      <?php endif; ?>     
                                                <?php
                                                    
                                                include '../payment-option.php';
                                            endif; ?>
                                            </td>
                                        </tr>
                                        <?php $i++; endif;
                                        
                                } ?>


                            </tbody>
                        </table>
                    </div>
                <?php else:

                    if (isset($_GET['s'])):
                        ?>

                        <h3 class="text-center text-muted"> Not found any bid products.</h3>
                    <?php else: ?>

                        <h5 class="text-center my-5">You have not bid on any products. <br> <a class="btn btn-primary mt-3"
                                href="<?php echo $base_url ?>/shop.php">View Products</a></h5>

                    <?php endif; endif; ?>
            </div>
        </div>
    </main>

    <?php include '../footer.php'; else:

    header("Location: " . '../');

endif;

?>



