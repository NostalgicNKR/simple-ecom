<?php 
require_once("../controller/profileController.php");
require_once("../controller/flashController.php"); 
$bankDetails = explode(",",$sellerData['bank_details']);
$titleOfPage = "Update Bank Details";
?>

<div class="container p-5 mb-10 scrollarea">

    <div class="row g-5">	
	<div class="card p-3">
		 <div class="card-body">
		 <h3 class="card-title mb-3">Bank Details</h3>
		<form action="../controller/profileController.php" method="POST" class="row g-3" onsubmit="return validateBankDetails();">
		  <div class="col-md-6">
			<label for="bank-no" class="form-label">Bank Account No</label>
			<input type="number" name="bank-no" class="form-control" value="<?= $bankDetails[0] ?>" id="bank-no">
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>
		  <div class="col-md-6">
			<label for="bank-full-name" class="form-label">Full Name</label>
			<input type="text" name="bank-full-name" class="form-control" value="<?=  $sellerData['full_name'] ?>" id="bank-full-name">
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>
		  <div class="col-12">
			<label for="bank-ifsc-code" class="form-label">IFSC Code</label>
			<input type="text" class="form-control" name="bank-ifsc" value="<?= isset($bankDetails[1]) ? $bankDetails[1] : '' ?>" id="bank-ifsc-code">
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>

		  <div class="col-md-12">
			<label for="gstin" class="form-label">GSTIN</label>
			<input type="text" name="gstin" class="form-control" value="<?= $sellerData['gstin'] ?>" id="gstin">
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>
		  

		  <div class="col-12">
			<button type="submit" name="updateBankDetails" class="btn btn-primary">Update</button>
		  </div>
		</form>
		</div>
		</div>
	</div>
</div>