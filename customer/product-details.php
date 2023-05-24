<?php if(is_null($productDetail['company_name'])) {
	echo "<script>window.location.href = '../404.php';</script>";
} ?>
<?php $titleOfPage = $productDetail['name']; ?>

<div class="container mt-5 scrollarea">
	<div class="card">
		<div class="row">
			<div class="col-sm-5">
				<img src="../uploads/images/<?= $productDetail['image_url'] ?>" width="500">
			</div>
			<div class="col-sm-7">
				<div class="card-body p-5">
					<h3 class="title mb-3"><?= $productDetail['name'] ?></h3>

					<p> 
						<span class="h3 text-success">&#8377; <?= formatCurrencyINR($productDetail['discounted_price']) ?></span> 
						<span class="text-muted"><del>&#8377; <?= formatCurrencyINR($productDetail['original_price']) ?></del></span> 
					</p>
					<p class="h6">Category</p>
					<p><?= $categories[$productDetail['category']] ?></p>
					
					<p class="h5">Description</p>
					<p><?= $productDetail['description'] ?></p>

					
					<p class="h6">Seller</p>
					<p><?= $productDetail['company_name'] ?></p>
					<p class="h6">Seller Address</p>
					<p><?= str_replace("#", "<br>", $productDetail['company_address']) ?></p>

					<hr>
					<form action="../controller/buyerController.php" method="POST">
					<div class="row">	
						<div class="col-sm-7">
							  <p class="h6">Quantity: </p>
								<input type="text" name="product_id" value="<?= $productDetail['id'] ?>" hidden>
								<select class="form-control form-control-sm" name="quantity" style="width:70px;">
									<option value="1"> 1 </option>
									<option value="2"> 2 </option>
									<option value="3"> 3 </option>
								</select>
						</div> 

					</div>
					<hr>
					<?php if($productDetail['product_status'] == 0) { ?>
					<button href="#" name="add-to-cart" class="btn btn-primary"> Add to Cart & Buy </button>
					<?php } else { ?>
					<div class="alert alert-secondary" role="alert">
					 This item is currently out of stock!
					</div>
					<?php } ?>
					</form>
				</div> 
			</div> 
		</div> 
	</div>
</div>
