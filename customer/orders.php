<?php $titleOfPage = "My Orders"; ?>
  <div class="container-fluid scrollarea mb-10 pb-5">
    <div class="row">
	
	<?php if(count($ordersData) > 0) { 
	foreach($ordersData as $order) { 
	?>
        <div class="col-sm-3 mt-3">
            <div class="card card-effect" style="width: 18rem;">
			  <a href="<?= $base_url ?>customer?page=product-details.php&product=<?= $order["product_id"] ?>" class="text-decoration-none text-black"><img class="card-img-top" src="../uploads/images/<?= $order["product_image"] ?>" width="300px" height="180px" alt="Card image cap"></a>
			  <div class="card-body">
				<a href="<?= $base_url ?>customer?page=product-details.php&product=<?= $order["product_id"] ?>" class="text-decoration-none text-black"><h5 class="card-title"><?= $order["product_name"] ?></h5></a>
			  </div>
			  <ul class="list-group list-group-flush">
				<li class="list-group-item">Order No: <?= $order['order_id'] ?></li>
				<li class="list-group-item">Status: <?= $orderStatus[$order['order_status']] ?></li>
				<li class="list-group-item"><?= $paymentType[$order['payment_type']] ?> : &#8377; <?=  formatCurrencyINR($order['total_amount']) ?>/-</li>
			  </ul>
			  <div class="card-body">
				<a href="?page=manage-order.php&unique-order-id=<?= $order['id'] ?>" class="card-link text-decoration-none">View Order</a>
			  </div>
			</div>
        </div>
	<?php } 
	} else { ?>
	<div class="col-sm-12" style="margin-top:200px;">
		<center><p class="mt-10 display-6">Start shopping and place your first order!</p></center>
	</div>
	<?php } ?>
    </div>
	 
	</div>