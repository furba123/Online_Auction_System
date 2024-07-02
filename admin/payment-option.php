

<!-- payment option -->
<div class="modal fade payment-modal" id="paymentModal-<?php echo $product['id']; ?>" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment Option</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">

                    <div class=" d-flex ">
                        <label for="product_name" class="form-label label me-3">Product Name: </label>
                        <input  type="text" name="product_name" class="form-control disabled " id="product_name"
                            value="<?php echo $product['product_name']; ?>">

                    </div>

                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

                    <div class="d-flex ">
                        <label for="product_price" class="form-label label me-3">Amount to Pay: </label>
                        <input  type="text" name="product_price" class="form-control disabled "
                            id="product_price" value="Rs. <?php echo $product['highest_bid'] ?>">

                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" value="Cash on Delivery" name="payment_option" id="cod" checked>
                        <label class="form-check-label" for="cod">
                            Cash on delivery (COD)
                        </label>
                    </div>

                    <div class="form-check my-3">
                        <input class="form-check-input" type="radio" value="QR Scan " name="payment_option" id="qr_scan" >
                        <label class="form-check-label" for="qr_scan">
                            QR Scan
                        </label>
                        <div class="qr-code">
                            <img style="width:100%;height:100%!important;max-width: 400px" src="../../img/qr.jpg"
                                alt="">
                        </div>
                    </div>


                    <div class="form-texts mb-3">
                        <label for="order_note" class="form-label me-3">Order Note (optional): </label>
                        <textarea name="order_note" class="form-control " rows="5" id="order_note"></textarea>

                    </div>

                    <button type="submit" name="place_order" class="btn btn-success w-100 ">Place Order</button>


                </form>
            </div>

        </div>
    </div>
</div>
