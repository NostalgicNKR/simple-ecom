<?php 
require_once("../controller/buyerProfileController.php");
require_once("../controller/flashController.php"); 
?>
<?php $titleOfPage = "Change Password" ?>

<div class="container p-5 mb-10 scrollarea">

    <div class="row g-5">	
	<div class="card p-3">
		 <div class="card-body">
		 <h3 class="card-title mb-3">Change Password</h3>
		<form action="../controller/buyerProfileController.php" method="POST" class="row g-3" onsubmit="return validateChangePassword();">
		  <div class="col-md-12">
			<label for="currentPassword" class="form-label">Current Password</label>
			<input type="password" name="currentPassword" class="form-control" id="currentPassword">
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>
		  <div class="col-md-6">
			<label for="newPassword" class="form-label">New Password</label>
			<input type="password" name="newPassword" class="form-control" id="newPassword">
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>
		  <div class="col-md-6">
			<label for="confirmPassword" class="form-label">Confirm Password</label>
			<input type="password" name="confirmPassword" class="form-control" id="confirmPassword">
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>
		  <div class="col-12">
			<button type="submit" name="changePassword" class="btn btn-primary">Update</button>
		  </div>
		</form>
		</div>
		</div>
	</div>
</div>