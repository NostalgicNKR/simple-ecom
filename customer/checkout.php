<?php $titleOfPage = "Checkout" ?>

<div class="container p-5 mb-10 scrollarea">
    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Your cart</span>
          <span class="badge bg-primary rounded-pill"><?= $itemsCount[1] ?></span>
        </h4>
        <ul class="list-group mb-3">
		<?php if(isset($cartList)) { 
		$totalAmount = 0;
		$orderedProducts = array();
			foreach ($cartList as $product) { 
			$amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,",  ($product["discounted_price"]*$cartQuantity[$product['id']]));
			$totalAmount += ($product["discounted_price"]*$cartQuantity[$product['id']]);
			
			$eachProduct = array("product_id" => $product['id'],"product_name"=> $product['name'], "product_image" => $product['image_url'], "discounted_price" => $product["discounted_price"], "product_quantity" => $cartQuantity[$product['id']]);
			
			?>
			
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0"><?= $product["name"] ?></h6>
              <small class="text-muted">Category: <?= $categories[$product["category"]] ?> | Qty: <?= $cartQuantity[$product['id']] ?></small>
            </div>
            <span class="text-muted">&#8377; <?= $amount ?>/-</span>
          </li>
		<?php 
		array_push($orderedProducts, $eachProduct);
		} } ?>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (INR)</span>
			<?php $totalAmountFormatted = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,",  $totalAmount); ?>
            <strong>&#8377;<?= $totalAmountFormatted ?>/-</strong>
          </li>
        </ul>
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Shipping address</h4>
        <form action="../controller/checkoutController.php" method="POST" onsubmit="return validateBuyerProfile();">
          <div class="row g-3">

            <div class="col-12">
              <label for="username" class="form-label">Full Name</label>
              <div class="has-validation">
                <input type="text" class="form-control" id="username" name="username" value="<?= $profileDataForCheckout['username'] ?>" placeholder="Full Name" required>
				<p class="h6 validate-result text-danger d-none"></p>
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">Address</label>
              <textarea class="form-control" name="shipping-address" id="shipping-address" placeholder="1234 Main St" rows="7" required><?= $address[0] ?></textarea>
              <p class="h6 validate-result text-danger d-none"></p>
            </div>

            <div class="col-md-4">
              <label for="state" class="form-label">State</label>
              <select class="form-select" name="state" id="state" required>
			  <?php foreach($indianStates as $scode => $stateName) { ?>
                <option value="<?= $scode ?>" <?= isset($address[2]) ? (($address[1] == $scode) ? 'selected' : '') : ''; ?>><?= $stateName ?></option>
			  <?php } ?>
              </select>
              
            </div>

            <div class="col-md-4">
              <label for="zip" class="form-label">Zip</label>
              <input type="text" name="zip-code" value="<?= isset($address[2]) ? $address[2] : '' ?>" class="form-control" id="zipcode" placeholder="" required>
              <p class="h6 validate-result text-danger d-none"></p>
            </div>
			
			<div class="col-md-4">
              <label for="zip" class="form-label">Phone</label>
              <input type="text" name="phone-no" value="<?= $profileDataForCheckout['phone'] ?>" class="form-control" id="phone" required>
              <p class="h6 validate-result text-danger d-none"></p>
            </div>
          </div>
          <hr class="my-4">

          <h4 class="mb-3">Payment</h4>

          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="payment-method" value="0" type="radio" class="form-check-input" onclick="showUPIBOX();" required>
              <label class="form-check-label" for="credit">Prepaid</label>
            </div>
            <div class="form-check">
              <input id="debit" name="payment-method" value="1" type="radio" class="form-check-input"  onclick="hideUPIBOX();" required>
              <label class="form-check-label" for="debit">Pay on delivery</label>
            </div>
          </div>

          <div class="row gy-3 " id="upi-box" style="display: none;">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">UPI ID</label>
              <input type="text" name="upi-id" class="form-control" id="upi-id" placeholder="12345@bank">
              <small class="text-muted">Enter Full UPI ID</small>
              <div class="invalid-feedback">
                Name on card is required
              </div>
            </div>

         
          </div>

          <hr class="my-4">
			<input type="text" name="product_data" value="<?php echo htmlspecialchars(serialize($orderedProducts)) ?>" hidden>
          <button class="w-100 btn btn-primary btn-lg" type="submit" name="completePayment">Continue to checkout</button>
        </form>
      </div>
    </div>
</div>
<script>
function showUPIBOX() {
	document.getElementById("upi-box").style.display = "block";
	console.log("clicked show");
}

function hideUPIBOX() {
	document.getElementById("upi-box").style.display = "none";
}
</script>