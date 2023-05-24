<?php
require_once("../controller/productController.php");
$titleOfPage = "Edit: ".$product["name"];
if(!isset($product)) { 
	echo "<script>window.location.href = '../404.php';</script>";
}
?>

<div class="container p-5 mb-10 scrollarea">

    <div class="row g-5">	
	<div class="card p-3">
		 <div class="card-body">
		 <h3 class="card-title mb-3">Edit product listing</h3>
		<form action="../controller/productController.php" method="POST" class="row g-3" onsubmit="return validateProductDetails();" enctype="multipart/form-data">

		<input type="text" name="product-id" value="<?= $product["id"] ?>" hidden>
		  <div class="col-md-12">
			<label for="product-name" class="form-label">Name</label>
			<input type="text" name="product-name" value="<?= $product["name"] ?>" class="form-control" id="product-name" required>
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>
		  <div class="col-md-6">
			<label for="product-category" class="form-label">Category</label>
			<select id="product-category" name="product-category" class="form-control" required>
				<?php for($i = 0; $i < count($categories); $i++) { ?>
				<option value="<?= $i ?>" <?= ($product['category'] == $i) ?  'selected' : ''; ?>><?= $categories[$i] ?></option>
				<?php } ?>
			</select>

		  </div>
		 <div class="col-md-6">
			<label for="product-status" class="form-label">Availability</label>
			<select id="product-status" name="product-status" class="form-control" required>
				<?php for($i = 0; $i < count($productStatus); $i++) { ?>
				<option value="<?= $i ?>" <?= ($product['product_status'] == $i) ?  'selected' : ''; ?>><?= $productStatus[$i] ?></option>
				<?php } ?>
			</select>
		  </div>
		  
		  <div class="col-12">
			<label for="product-description" class="form-label">Description</label>
			<textarea class="form-control" name="product-description" id="product-description" rows="10" minlength="50" required><?= $product["description"] ?></textarea>
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>
		  <div class="col-md-6">
			<label for="product-price" class="form-label">Original Price (in Rupees)</label>
			<input type="number" name="product-price" value="<?= $product["original_price"] ?>" class="form-control" min="1" id="product-price" required>
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>
		  <div class="col-md-6">
			<label for="product-discount-price" class="form-label">Discounted Price (in Rupees)</label>
			<input type="number" name="product-discount-price" value="<?= $product["discounted_price"] ?>" class="form-control" id="product-discount-price" required>
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>
		  <div class="col-md-12">
			<label for="product-image" class="form-label">Product Image</label>
			<input type="file" name="product-image" class="form-control" id="product-image">
			
			<input name="old_image" type="text" value="<?=$product["image_url"]?>" hidden>
			<a class="" href="../uploads/images/<?= $product["image_url"] ?>" target="_blank">View Image: <?= $product["image_url"] ?></a>
		  </div>
	
		
		  <div class="col-12">
			<button type="submit" name="update-profile" class="btn btn-primary">Update</button>
		  </div>
		</form>
		</div>
		</div>
	</div>
</div>