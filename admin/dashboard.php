<?php


include 'header.php';

$product_query = "SELECT * FROM products";
$product_result = mysqli_query($conn, $product_query);
$product_rows = mysqli_fetch_all($product_result, MYSQLI_ASSOC);


$user_query = "SELECT * FROM users";
$user_result = mysqli_query($conn, $user_query);
$user_rows = mysqli_fetch_all($user_result, MYSQLI_ASSOC);

$order_query = "SELECT * FROM orders";
$order_result = mysqli_query($conn, $order_query);
$order_rows = mysqli_fetch_all($order_result, MYSQLI_ASSOC);

?>


<div class="dashboard my-5">
    <div class="container">
        <div class="title-wrapper d-flex align-items-center justify-content-between border-bottom pb-3 ">
            <h4>Dashboard</h4>
        </div>

        <?php if ($current_user['role'] == 'admin'): ?>
            <div class="row">
                <div class="col-md-3 py-4">
                    <a href="<?php echo $base_url . "/admin/pages/product-list.php"; ?>"
                        class="card p-4 border-0 shadow bg-primary">
                        <div class="row">
                            <div class="col-8 px-2 py-0">
                                <i class="bi bi-cart icon"></i>
                                <h6 class="text-white">Total Products</h6>
                                <h2 class="text-white">
                                    <?php echo count($product_rows); ?>
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 py-4">
                    <a href="<?php echo $base_url . "/admin/pages/user-list.php"; ?>"
                        class="card p-4 border-0 shadow bg-success">
                        <div class="row">
                            <div class="col-8 px-2 py-0">
                                <i class="bi bi-person icon"></i>
                                <h6 class="text-white">Total Users</h6>
                                <h2 class="text-white">
                                    <?php echo count($user_rows); ?>
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 py-4">
                    <a href="<?php echo $base_url . "/admin/pages/order-list.php"; ?>"
                        class="card p-4 border-0 shadow bg-secondary">
                        <div class="row">
                            <div class="col-8 px-2 py-0">
                                <i class="bi bi-cart icon"></i>
                                <h6 class="text-white">Total orders</h6>
                                <h2 class="text-white">
                                    <?php echo count($order_rows); ?>
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>

            </div>

        <?php elseif ($current_user['role'] == 'customer'):
            $query = "SELECT * FROM bid_products WHERE `user_id` = $current_user_id";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

            if ($rows):
                $bid_products = $rows[0]['bid_products'];

                $bidProductsArray = unserialize($bid_products);
            endif;
            ?>

            <div class="row">
                <div class="col-md-3 py-4">
                    <a href="<?php echo $base_url . "/admin/pages/bid-products.php"; ?>"
                        class="card p-4 border-0 shadow bg-primary">
                        <div class="row">
                            <div class="col-8 px-2 py-0">
                                <i class="bi bi-cart icon"></i>
                                <h6 class="text-white">Bid Products</h6>
                                <h2 class="text-white">
                                    <?php echo isset($bidProductsArray) ? count($bidProductsArray) : '0'; ?>
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        <?php elseif ($current_user['role'] == 'seller'):
            $query = "SELECT * FROM products WHERE created_by=$current_user_id";
            $result = mysqli_query($conn, $query);
            $product_rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

            ?>

            <div class="row">
                <div class="col-md-3 py-4">
                    <a href="<?php echo $base_url . "/admin/pages/product-list.php"; ?>"
                        class="card p-4 border-0 shadow bg-primary">
                        <div class="row">
                            <div class="col-8 px-2 py-0">
                                <i class="bi bi-cart icon"></i>
                                <h6 class="text-white">My Products</h6>
                                <h2 class="text-white">
                                    <?php echo count($product_rows); ?>
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>


        <?php endif; ?>

    </div>

    <?php include 'footer.php';