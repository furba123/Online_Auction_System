<?php include '../header.php';
if ($current_user['role'] == 'customer') : header("Location: " . '../');
endif;
$product_update = false;
if (isset($_GET['id'])) {
    $product_update = true;

    $product_id =  $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM products where `id` = '$product_id' ");

    $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

    if (!empty($rows)) {

        foreach ($rows as $row) {
            $product_name = $row['product_name'];
            $product_image = $row['product_image'];
            
            $product_bid = $row['starting_bid'];
            $auction_time = $row['auction_time'];
            $product_description = $row['product_description'];
        }
    }
};



if (isset($_POST['submit_update'])) :

    $product_name = $_POST['product_name'];
  
    $product_bid = $_POST['starting_bid_amt'];
    $auction_time = $_POST['auction_time'];
    $product_description = $_POST['product_description'];
    $product_description = htmlspecialchars($product_description, ENT_QUOTES, 'UTF-8');
 

    if ($current_user['role'] == 'seller'):
        $created_by = $current_user_id;
    else:
        $selectQuery = mysqli_query($conn, "SELECT created_by FROM products WHERE id=$product_id");
        $previous_created_by_row = mysqli_fetch_assoc($selectQuery);
        $previous_created_by = $previous_created_by_row['created_by'];
        if ($previous_created_by == null):
            $created_by = $current_user_id;
        else:
            $created_by = $previous_created_by;
        endif;    
    endif;

    // Image code
    $image_insert_successful = false;

    $statusMsg = '';

    $targetDir = "../uploads/";
    $fileName = basename($_FILES["product_image"]["name"]);

    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (!empty($_FILES["product_image"]["name"])) {
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowTypes)) {

            // Upload file to server
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFilePath)) {

                $image_insert_successful = true;
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
    } else {
        $fileName = $row['product_image'];
    }

    $query = mysqli_query($conn, "UPDATE products SET product_name='$product_name',  starting_bid='$product_bid', auction_time='$auction_time', product_description='$product_description', product_image='$fileName', created_by='$created_by' WHERE id=$product_id");

    if ($query) { ?>
        <div class="container">
            <div class="alert alert-success mt-3">
                Product updated successfully. <br>
                <?php echo $statusMsg;  ?>
            </div>
        </div>
    <?php } else {
        $errorMessage = mysqli_error($conn);
        print_r($errorMessage);

        echo "Error updating product.";
    }
// header("Location: product-form.php");
// exit();
endif;


// ADD PRODUCT
if (isset($_POST['submit'])) {

    $product_name = $_POST['product_name'];
    $auction_time = $_POST['auction_time'];
    
    $product_bid = $_POST['starting_bid_amt'];
    $product_description = $_POST['product_description'];
    $product_description = htmlspecialchars($product_description, ENT_QUOTES, 'UTF-8');


    $created_by = null;
    if ($current_user['role'] == 'seller'):
        $created_by = $current_user_id;    
    endif;    

    // Image code
    $image_insert_successful = false;

    $statusMsg = '';

    // File upload path
    $targetDir = "../uploads/";
    $fileName = basename($_FILES["product_image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (isset($_POST["submit"]) && !empty($_FILES["product_image"]["name"])) {
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowTypes)) {

            // Upload file to server
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFilePath)) {

                $image_insert_successful = true;
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }

    // Display status message
    echo $statusMsg;

    // Image code ends here

    $query = mysqli_query($conn, "INSERT INTO products (`product_name`, `starting_bid`, `auction_time`, `product_description`, `product_image`, `created_by`) VALUES ('$product_name', '$product_bid', '$auction_time', '$product_description', '$fileName', '$created_by')");

    if ($query) { ?>
        <div class="container">
            <div class="alert alert-success mt-3">
                Product added successfully.
            </div>
        </div>
<?php } elseif ($image_insert_successful == false) {
        echo "Error uploading image";
    } else {
        $errorMessage = mysqli_error($conn);
        print_r($errorMessage);
        echo "Error creating product.";
    }
}

?>

<?php if (isset($_SESSION["error_msg"])): ?>
<div class="container">
    <div class="alert alert-danger mt-3">
        <?php echo $_SESSION["error_msg"];  ?>
    </div>
</div>
<?php unset($_SESSION["error_msg"]); endif; ?>

<div class="product-form my-5">
    <div class="container">
        <div class="title-wrapper d-flex align-items-center justify-content-between border-bottom pb-3 ">
            <h4>Product Form</h4>
            <a href="<?php echo $base_url; ?>/admin/pages/product-list.php" class="btn btn-primary">Go Back To Product
                List</a>
        </div>
        <form class="p-2 mb-5 p-md-5 border" enctype="multipart/form-data" method="POST">
            <label for="Product_Image" class="form-label d-block">Product Image</label>
            <?php if ($product_update) { ?>
                <img style="width: 200px;  max-height: 200px;object-fit: contain;" width="200" height="200" src="<?php echo $base_url . '/admin/uploads/' . $product_image; ?>" class="img-thumbnail mb-3" alt="...">
            <?php } ?>
            <input type="file" name="product_image" <?php echo $product_update ? '' : 'required' ?> class="form-control mb-3" id="product_image">

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product name</label>
                        <input type="text" name="product_name" required class="form-control mb-3" id="product_name" value="<?php echo $product_update ? $product_name : ''; ?>">

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="auction_time" class="form-label">Auction Time</label>
                        <input type="datetime-local" name="auction_time" required class="form-control mb-3" id="auction_time" value="<?php echo $product_update ? $auction_time : ''; ?>">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <!-- <div class="mb-3">
                        <label for="product_Price" class="form-label">Product Price</label>
                        <input type="number" name="product_price" required class="form-control  mb-3" id="product_price " value="<?php echo $product_update ? $product_price : ''; ?>">

                    </div> -->


                    <div class="mb-3">
                        <label for="starting_bid_amt" class="form-label">Starting BID Amount</label>
                        <input type="number" min="0" name="starting_bid_amt" required class="form-control  mb-3" id="starting_bid_amt " value="<?php echo $product_update ? $product_bid : ''; ?>">

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="product_description" class="form-label">Product Description</label>
                        <textarea rows="7" class="form-control mb-3" name="product_description" required id="product_description"><?php echo $product_update ? $product_description : ''; ?></textarea>
                    </div>
                </div>
            </div>

            <?php if ($product_update) : ?>
                <button type="submit" name="submit_update" class="btn btn-success">Update Product</button>
            <?php else : ?>
                <button type="submit" name="submit" class="btn btn-success">Add Product</button>
            <?php endif; ?>
        </form>
    </div>
</div>

<?php include '../footer.php'; ?>