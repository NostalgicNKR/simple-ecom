<?php if(!isset($orderedProduct)) { 
	echo "<script>window.location.href = '../404.php';</script>";
} 
$titleOfPage = "Manage: ".$orderedProduct['order_id'];
?>

<div class="container-fluid">

<div class="container">
  <!-- Title -->
  <div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Order Details of #<?= $orderedProduct['order_id'] ?></h2>
  </div>

  <!-- Main content -->
  <div class="row">
    <div class="col-lg-8">
      <!-- Details -->
      <div class="card mb-4">
        <div class="card-body">
          <div class="mb-3 d-flex justify-content-between">
            <div>
              <span class="me-3"><?= $orderedProduct['ordered_date'] ?></span>
              <span class="me-3">#<?= $orderedProduct['order_id'] ?></span>
              <span class="me-3"><?= $paymentType[$orderedProduct['payment_type']] ?></span>
              <span class="badge rounded-pill bg-info"><?= $orderStatus[$orderedProduct['order_status']] ?></span>
            </div>
          </div>
          <table class="table table-borderless">
            <tbody>
              <tr>
                <td>
                  <div class="d-flex mb-2">
                    <div class="flex-shrink-0">
                      <img src="../uploads/images/<?= $orderedProduct['product_image'] ?>" alt="" width="35" class="img-fluid">
                    </div>
                    <div class="flex-lg-grow-1 ms-3">
                      <h6 class="small mb-0"><a href="#" class="text-decoration-none"><?= $orderedProduct['product_name'] ?></a></h6>
                      <span class="small">Color: Black</span>
                    </div>
                  </div>
                </td>
                <td><?= $orderedProduct['quantity'] ?></td>
                <td class="text-end">&#8377; <?= formatCurrencyINR($orderedProduct['item_price']) ?></td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2">Subtotal</td>
                <td class="text-end">&#8377; <?= formatCurrencyINR($orderedProduct['total_amount']) ?></td>
              </tr>
              <tr class="fw-bold">
                <td colspan="2">TOTAL</td>
                <td class="text-end">&#8377; <?= formatCurrencyINR($orderedProduct['total_amount']) ?></td>
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
			  
			  <?php if($orderedProduct['payment_type'] == 0) { ?>
              <p><?= $orderedProduct['payment_details'] ?> <br>
              Total: &#8377; <?= formatCurrencyINR($orderedProduct['total_amount']) ?> <span class="badge bg-success rounded-pill">PAID</span></p>
			  <?php } else { ?>
			  <p>Total: &#8377; <?= formatCurrencyINR($orderedProduct['total_amount']) ?> <span class="badge bg-info rounded-pill">Pay on Delivery</span></p>
			  <?php } ?>
			  
            </div>
            <div class="col-lg-6">
              <h3 class="h6">Billing address</h3>
              <address>
				<strong><?= $orderedProduct['customer_name'] ?></strong><br>
				<?= str_replace("#", "<br>", $orderedProduct['shipping_address']) ?><br>
				<?= "Phone: ".$orderedProduct['phone_no'] ?>
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
		  <form action="../controller/sellerOrdersController.php" method="POST">
			<input type="text" value="<?= $orderedProduct['id'] ?>" name="id" hidden>
			<?php if($orderedProduct['order_status'] == 0) { ?>
				<input class="btn btn-outline-secondary" type="submit" name="shipped" value="Ship the Order">
				<input class="btn btn-outline-danger" type="submit" name="cancel" value="Cancel the Order">
			<?php } elseif($orderedProduct['order_status'] == 1) { ?>
				<input class="btn btn-outline-success" type="submit" name="Delivered" value="Mark as Delivered">
			<?php } ?>
			
		</form>
        </div>
      </div>
      <div class="card mb-4">
        <!-- Shipping information -->
        <div class="card-body">
		<?php if($orderedProduct['order_status'] == 1 || $orderedProduct['order_status'] == 2) { ?>
          <h3 class="h6">Shipping Information</h3>
          <strong>FedEx</strong>
          <span><a href="#" class="text-decoration-none">FF1234567890</a></span>
          <hr>
		<?php } ?>
          <h3 class="h6">Address</h3>
          <address>
            <strong><?= $orderedProduct['customer_name'] ?></strong><br>
            <?= str_replace("#", "<br>", $orderedProduct['shipping_address']) ?><br>
            <?= "Phone: ".$orderedProduct['phone_no'] ?>
          </address>
        </div>
      </div>
    </div>
  </div>
</div>
  </div>
  
  <!-- Modal -->
<div class="modal fade" id="changeStatusOfOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changeStatusOfOrderLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changeStatusOfOrderLabel">Change Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>
