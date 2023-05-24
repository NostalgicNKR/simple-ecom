<?php $titleOfPage = "Add a Product"; ?>

<div class="container p-5 mb-10 scrollarea">

    <div class="row g-5">	
	<div class="card p-3">
		 <div class="card-body">
		 <h3 class="card-title mb-3">Add a product</h3>
		<form action="../controller/productController.php" method="POST" class="row g-3" onsubmit="return validateProductDetails();" enctype='multipart/form-data'>
		  <div class="col-md-12">
			<label for="product-name" class="form-label">Name</label>
			<input type="text" name="product-name" class="form-control" id="product-name" required>
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>
		  <div class="col-md-12">
			<label for="product-category" class="form-label">Category</label>
			<select id="product-category" name="product-category" class="form-control" required>
				<?php for($i = 0; $i < count($categories); $i++) { ?>
				<option value="<?= $i ?>"><?= $categories[$i] ?></option>
				<?php } ?>
			</select>
		  </div>
		  
		  <div class="col-12">
			<label for="product-description" class="form-label">Description</label>
			<textarea class="form-control" name="product-description" id="product-description" rows="10" minlength="50" required></textarea>
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>
		  <div class="col-md-6">
			<label for="product-price" class="form-label">Original Price (in Rupees)</label>
			<input type="number" name="product-price" class="form-control" id="product-price" min="1" required>
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>
		  <div class="col-md-6">
			<label for="product-discount-price" class="form-label">Discounted Price (in Rupees)</label>
			<input type="number" name="product-discount-price" class="form-control" id="product-discount-price" min="1" required>
			<p class="h6 validate-result text-danger d-none"></p>
		  </div>
		  <div class="col-md-12">
			<label for="product-image" class="form-label">Product Image</label>
			<input type="file" accept="image/*" name="product-image" class="form-control" id="product-image" required>
		  </div>

		  <div class="col-12">
			<button type="submit" name="uploadfile" class="btn btn-primary">Add</button>
		  </div>
		</form>
		</div>
		</div>
	</div>
</div>