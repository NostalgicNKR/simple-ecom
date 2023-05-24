<?php 
require_once("../controller/buyerProfileController.php");
$titleOfPage = "Update Profile";
?>

<div class="container p-5 mb-10 scrollarea">

    <div class="row g-5">	
	<div class="card p-3">
		 <div class="card-body">
		 <h3 class="card-title mb-3">Update Profile</h3>
		<form action="../controller/buyerProfileController.php" method="POST" class="row g-3" name="profileUpdateForm" onsubmit="return validateBuyerProfile();">
		  <div class="col-md-6">
			<label for="inputEmail" class="form-label">Email</label>
			<input type="email" name="email" value="<?= $profileData['email'] ?>" class="form-control" id="email" readonly>
		  </div>
		  <div class="col-md-6">
			<label for="username" class="form-label">Username</label>
			<input type="text" name="username" value="<?= $profileData['username'] ?>" class="form-control" id="username">
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>
		  <?php $address = explode("#",$buyerData['shipping_address']); ?>
		  <div class="col-12">
			<label for="shipping-address" class="form-label">Address</label>
			<textarea class="form-control" name="shipping-address" id="shipping-address" placeholder="1234 Main St" rows="10"><?= $address[0] ?></textarea>
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
              <label for="zipcode" class="form-label">Zip</label>
              <input type="text" name="zip-code" value="<?= isset($address[2]) ? $address[2] : '' ?>" class="form-control" id="zipcode" placeholder="" required>
			  <p class="h6 validate-result text-danger d-none"></p>
            </div>
			
		  <div class="col-md-4">
			<label for="phone" class="form-label">Phone</label>
			<input type="number" name="phone-no" class="form-control" value="<?= $profileData['phone'] ?>" id="phone">
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>

		  <div class="col-12">
			<button type="submit" class="btn btn-primary">Update</button>
		  </div>
		</form>
		</div>
		</div>
	</div>
</div>
<script>validateBuyerProfile();</script>