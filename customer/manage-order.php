<?php $titleOfPage = "View Order: ".$viewOrderData['order_id'] ?>

<div class="container-fluid">

<?php if(!isset($viewOrderData)) { 
	echo "<script>window.location.href = '../404.php';</script>";
} ?>

<div class="container">
  <!-- Title -->
  <div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Order Details of #<?= $viewOrderData['order_id'] ?></h2>
  </div>

  <!-- Main content -->
  <div class="row">
    <div class="col-lg-8">
      <!-- Details -->
      <div class="card mb-4">
        <div class="card-body">
          <div class="mb-3 d-flex justify-content-between">
            <div>
              <span class="me-3"><?= $viewOrderData['ordered_date'] ?></span>
              <span class="me-3">#<?= $viewOrderData['order_id'] ?></span>
              <span class="me-3"><?= $paymentType[$viewOrderData['payment_type']] ?></span>
              <span class="badge rounded-pill bg-info"><?= $orderStatus[$viewOrderData['order_status']] ?></span>
            </div>
          </div>
          <table class="table table-borderless">
            <tbody>
              <tr>
                <td>
                  <div class="d-flex mb-2">
                    <div class="flex-shrink-0">
                      <img src="../uploads/images/<?= $viewOrderData['product_image'] ?>" alt="" width="35" class="img-fluid">
                    </div>
                    <div class="flex-lg-grow-1 ms-3">
                      <h6 class="small mb-0"><a href="<?= $base_url ?>customer?page=product-details.php&product=<?= $viewOrderData["product_id"] ?>" class="text-decoration-none"><?= $viewOrderData['product_name'] ?></a></h6>
                      <span class="small">Color: Black</span>
                    </div>
                  </div>
                </td>
                <td><?= $viewOrderData['quantity'] ?></td>
                <td class="text-end">&#8377; <?= formatCurrencyINR($viewOrderData['item_price']) ?></td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2">Subtotal</td>
                <td class="text-end">&#8377; <?= formatCurrencyINR($viewOrderData['total_amount']) ?></td>
              </tr>
              <tr>
                <td colspan="2">Shipping</td>
                <td class="text-end">Free</td>
              </tr>
              <tr class="fw-bold">
                <td colspan="2">TOTAL</td>
                <td class="text-end">&#8377; <?= formatCurrencyINR($viewOrderData['total_amount']) ?></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- Payment -->
      <div class="card mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
              <h3 class="h6">Payment Method</h3>
			  <?php if($viewOrderData['payment_type'] == 0) { ?>
              <p><?= $viewOrderData['payment_details'] ?> <br>
              Total: &#8377; <?= formatCurrencyINR($viewOrderData['total_amount']) ?> <span class="badge bg-success rounded-pill">PAID</span></p>
			  <?php } else { ?>
			  <p>Total: &#8377; <?= formatCurrencyINR($viewOrderData['total_amount']) ?> <span class="badge bg-info rounded-pill">Pay on Delivery</span></p>
			  <?php } ?>
            </div>
            <div class="col-lg-6">
              <h3 class="h6">Billing address</h3>
              <address>
                <strong><?= $viewOrderData['customer_name'] ?></strong><br>
				<?= str_replace("#", "<br>", $viewOrderData['shipping_address']) ?><br>
				<?= "Phone: ".$viewOrderData['phone_no'] ?>
              </address>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <!-- Customer Notes -->
      <div class="card mb-4">
        <div class="card-body">
          <h3 class="h6">Manage</h3>
		  		  <form action="../controller/ordersController.php" method="POST">
			<input type="text" value="<?= $viewOrderData['id'] ?>" name="id" hidden>
			<?php if($viewOrderData['order_status'] == 0 || $viewOrderData['order_status'] == 1) { ?>
				<input class="btn btn-outline-danger" type="submit" name="cancel" value="Cancel the Order">
			<?php } elseif($viewOrderData['order_status'] == 2) { ?>
				<input class="btn btn-warning" type="submit" name="return" value="Return">
			<?php } ?>
			
		</form>
        </div>
      </div>
      <div class="card mb-4">
        <!-- Shipping information -->
        <div class="card-body">
		<?php if($viewOrderData['order_status'] == 1 || $viewOrderData['order_status'] == 2) { ?>
          <h3 class="h6">Shipping Information</h3>
          <strong>FedEx</strong>
          <span><a href="#" class="text-decoration-none">FF1234567890</a></span>
          <hr>
		<?php } ?>
          <h3 class="h6">Address</h3>
          <address>
            <strong><?= $viewOrderData['customer_name'] ?></strong><br>
            <?= str_replace("#", "<br>", $viewOrderData['shipping_address']) ?><br>
            <?= "Phone: ".$viewOrderData['phone_no'] ?>
          </address>
        </div>
      </div>
    </div>
  </div>
</div>
  </div>