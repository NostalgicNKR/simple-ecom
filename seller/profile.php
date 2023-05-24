<?php 
require_once("../controller/profileController.php");
$titleOfPage = "Update Profile";
?>


<div class="container p-5 mb-10 scrollarea">

    <div class="row g-5">	
	<div class="card p-3">
		 <div class="card-body">
		 <h3 class="card-title mb-3">Update Profile</h3>
		<form action="../controller/profileController.php" method="POST" name="profileUpdateForm" class="row g-3" onsubmit="return validateSellerProfile();">
		 <div class="col-md-12">
			<label for="company-name" class="form-label">Company Name</label>
			<input type="text" name="company-name" value="<?= !empty($sellerData['company_name']) ? $sellerData['company_name'] : '' ?>" class="form-control" id="company-name" required>
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>
		  <div class="col-md-12">
			<label for="company-address" class="form-label">Company Address</label>
			<textarea name="company-address" class="form-control" id="company-address" required><?= $sellerData['company_address'] ?></textarea>
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>
		  <div class="col-md-12">
			<label for="inputEmail" class="form-label">Email</label>
			<input type="email" name="email" value="<?= $profileData["email"] ?>" class="form-control" id="email" readonly>
			
		  </div>
		  <div class="col-md-6">
			<label for="inputName" class="form-label">Username</label>
			<input type="text" name="username" value="<?= $profileData['username'] ?>" class="form-control" id="username" required>
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>
		  <div class="col-md-6">
			<label for="inputPhone" class="form-label">Phone</label>
			<input type="number" name="phone" value="<?= $profileData['phone']; ?>" class="form-control" id="phone" required>
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