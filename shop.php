<?php include 'include/header.php'; 


if (isset($_GET['s'])){
    $searchTerm = $_GET['s'];
    $sql = "SELECT * FROM products WHERE product_name LIKE '%$searchTerm%'";

    $result = mysqli_query($conn, $sql);
    $search_results = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

?>

<div class="breadcrumbs">
    <a href="index.php">Home</a>
    <i class="bi bi-arrow-right"></i>
    <span>Shop</span>
</div>


<main class="pb-5">

    <?php $query = "SELECT * FROM products";
    $result = mysqli_query($conn, $query);

    if (isset($_GET['s'])):
        $rows = $search_results;
    else:
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    endif;

    
    ?>

    <div class="title">
        <h2>Welcome To Shop</h2>
    </div>
    
    <div class="container">
        <div class="d-flex justify-content-center">
        <form class="form">
            <div class="input-group  search-wrapper" >
                <input name="s" type="text" <?php echo isset($_GET['s']) && $_GET['s'] != '' ? 'value = '. $_GET['s'] .' ' : ''?> class="form-control " placeholder="Search..">
                <i class="icon bi bi-search"></i>
            </div>
        </form>
        </div>
        <div class="row">
            <?php if (!empty($rows)): foreach ($rows as $row) {
                $imageURL = 'admin/uploads/' . $row["product_image"];
                $starting_bid = $row['starting_bid'];
                $highest_bid = $row['highest_bid'];
                $bid_amount = number_format($starting_bid, 0, '.', ',');

                if ($starting_bid > 0 && $highest_bid < $starting_bid):
                    $best_price = $bid_amount;
                endif; 
                if ($highest_bid > $starting_bid) :
                    $best_price = number_format($highest_bid, 0, '.', ',');
                endif;    

            ?>
                <div class="col-md-4 py-5">
                    <div class="card">
                        <a href="shop-detail.php?id=<?php echo $row['id'] ?>"> <img src="<?php echo $imageURL; ?>" class="card-img-top" alt="..."></a>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['product_name'] ?></h5>
                              <div class="bid  d-flex align-items-center">
                                <h6 class="mb-2">Best Price: <b class="text-primary"><?php echo $best_price; ?></b></h6>
                                
                                   </div>
                                  <a href="shop-detail.php?id=<?php echo $row['id'] ?>" class="btn btn-primary py-2 w-100">View Details</a>
                        </div>
                    </div>
                </div>
            <?php
            }; else: ?>
            <div class="col-md-12 py-5">
                <h3 class="text-center text-muted">Product not found.</h2>
            </div>
            <?php endif; ?>

        </div>

    </div>


</main>




<?php include 'include/footer.php' ?>