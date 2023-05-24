<?php $titleOfPage = "My Cart" ?>

<div class="container px-3 my-5 scrollarea">
    <!-- Shopping cart table -->
    <div class="card">
        <div class="card-header">
            <h2>Shopping Cart</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
			<?php if(isset($cartList)) { 
			$totalAmount = 0;
			?>
              <table class="table table-bordered m-0">
                <thead>
                  <tr>
                    <!-- Set columns width -->
                    <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Price</th>
                    <th class="text-center py-3 px-4" style="width: 120px;">Quantity</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                    <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="float-none text-light"><i class="ino ion-md-trash"></i></a></th>
                  </tr>
                </thead>
                <tbody>
				
				<?php foreach ($cartList as $product) { ?>
                  <tr>
                    <td class="p-4">
                      <div class="d-flex align-items-center">
                        <img src="../uploads/images/<?= $product["image_url"] ?>" class="d-block me-4" width="40px" alt="">
                        <div>
                          <a href="<?= $base_url ?>customer?page=product-details.php&product=<?= $product["id"] ?>" class="text-decoration-none d-block text-dark"><?= $product["name"] ?></a>
                          <small>
                            <span class="text-muted">Color:</span>
                            <span class="align-text-bottom" style="background:#e81e2c;"></span> &nbsp;
                            <span class="text-muted">Size: </span> EU 37 &nbsp;
                            <span class="text-muted">Ships from: </span> China
                          </small>
                        </div>
                      </div>
                    </td>
					<?php
						//https://stackoverflow.com/a/54603979
						$amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,",  $product["discounted_price"]);
					?>
                    <td class="text-right align-middle p-6">&#8377; <?= $amount ?>/-</td>
                    <td class="align-middle p-">
					<form action="../controller/buyerController.php" method="POST">
						<input type="number" name="product_id" value="<?= $product['id'] ?>" hidden>
						<select name="quantity" class="form-control text-center" id="quantity" onchange="this.form.submit()">
						<?php for($x = 1; $x < 4; $x++) { ?>
							<option value="<?= $x ?>" <?= ($cartQuantity[$product['id']] == $x) ? 'selected' : ''; ?>><?= $x ?></option>
						<?php } ?>
						</select>
					</form>
						
					</td>
					<?php $productTotal = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,",  $product["discounted_price"]*$cartQuantity[$product['id']]); ?>
                    <td class="text-right font-weight-semibold align-middle p-8">&#8377;&nbsp;<?= $productTotal ?>/-</td>
                    <td class="text-center align-middle px-0"><a href="<?= basename($_SERVER['REQUEST_URI']) ?>&remove-from-cart=<?= $product["id"] ?>" class="text-decoration-none float-none text-danger">×</a></td>
                  </tr>
				  
				<?php 
				$totalAmount += ($product["discounted_price"]*$cartQuantity[$product['id']]);
				} //End of for loop
				$totalAmount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $totalAmount);
				?>
				
                </tbody>
              </table>
            </div>
            <!-- / Shopping cart table -->
        
            <div class="d-flex flex-wrap justify-content-end pb-4">
              <div class="d-flex">
                <div class="text-right mt-4 me-5">
                  <label class="text-muted font-weight-normal m-0">Total price</label>
                  <div class="text-large"><strong>&#8377; <?= $totalAmount ?></strong></div>
                </div>
              </div>
            </div>
        
            <div class="float-right">
              <button type="button" class="btn btn-lg btn-default md-btn-flat mt-2 me-3">Back to shopping</button>
              <a href="<?= strtok($_SERVER["REQUEST_URI"], '?') ?>?page=checkout.php" class="btn btn-lg btn-primary mt-2">Checkout</a>
            </div>
			<?php } else { ?> 
						<center><img src="../assets/img/empty-cart.png"></center>
				<?php } ?>
          </div>
      </div>
  </div>