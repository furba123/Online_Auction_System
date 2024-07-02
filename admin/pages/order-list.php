<?php include '../header.php';
if (isset($_GET['s'])) {
    $searchTerm = $_GET['s'];
    $sql = "SELECT * FROM orders WHERE customer_name LIKE '%$searchTerm%' OR payment_method LIKE '%$searchTerm%' OR amount LIKE '%$searchTerm%' OR product_name LIKE '%$searchTerm%'";

    $result = mysqli_query($conn, $sql);
    $search_results = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
if ($current_user['role'] == 'customer'):
    header("Location: " . '../');
endif;

$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    $query = mysqli_query($conn, "DELETE FROM orders where `order_id` = '$order_id' ");

    if ($query) {

        $_SESSION['status_msg'] = "Order deleted successfully.";
    } else {
        $_SESSION['status_msg'] = "Error deleting Order";
    }
    ;

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
;

if (isset($_SESSION['status_msg'])): ?>
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

    <?php $query = "SELECT * FROM orders";
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
                <h4>Order List</h4>
                <form class="form">
                    <div class="input-group  search-wrapper">
                        <input name="s" type="text" <?php echo isset($_GET['s']) && $_GET['s'] != '' ? 'value  = ' . $_GET['s'] . ' ' : '' ?> class="form-control " placeholder="Search..">
                        <i class="icon bi bi-search"></i>
                    </div>
                </form>

            </div>
            <?php if ($rows): ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($rows as $row) {

                            $product_id = $row['product_id'];
                            $query = "SELECT * FROM products where id = $product_id";
                            $result = mysqli_query($conn, $query);
                            $product = mysqli_fetch_assoc($result);

                            ?>
                            <tr>
                                <td>
                                    <?php echo '#' . $row['order_id']; ?>
                                </td>
                                <td>
                                    <?php echo $row['customer_name'] ?>
                                </td>
                                <td>
                                    <?php echo $product['product_name'] ?>
                                </td>
                                <td>
                                    <?php echo $row['amount'] ?>
                                </td>

                                <td>
                                    <?php echo $row['payment_method'] ?>
                                </td>

                                <td style="white-space:nowrap">

                                    <a data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"
                                        href="?id=<?php echo $row['order_id'] ?>"
                                        class="btn btn-outline-danger modal-trigger">Delete</a>
                                </td>

                            </tr>
                            <?php $i++;
                        } ?>
                    </tbody>
                </table>
            <?php else:

                if (isset($_GET['s'])):
                    ?>

                    <h3 class="text-center text-muted">Orders not found.</h3>


                <?php else: ?>

                    <h5 class="text-center my-5">No Orders found.</h5>
                <?php endif; endif; ?>

        </div>
    </div>
</main>
<?php include '../footer.php'; ?>