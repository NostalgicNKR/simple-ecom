<?php $titleOfPage = $productDetail['name']; ?>

<div class="container mt-5 scrollarea">
	<div class="card">
		<div class="row">
			<div class="col-sm-5">
				<img src="../uploads/images/<?= $productDetail['image_url'] ?>" width="500" style="max-height: 500px;">
			</div>
			<div class="col-sm-7">
				<div class="card-body p-5">
					<h3 class="title mb-3"><?= $productDetail['name'] ?></h3>

					<p> 
						<span class="h3 text-success">&#8377; <?= formatCurrencyINR($productDetail['discounted_price']) ?></span> 
						<span class="text-muted"><del>&#8377; <?= formatCurrencyINR($productDetail['original_price']) ?></del></span> 
					</p>

					<p class="h5">Description</p>
					<p><?= $productDetail['description'] ?></p>

					<p class="h6">Category</p>
					<p><?= $categories[$productDetail['category']] ?></p>
					<p class="h6">Seller</p>
					<p>Your Company Name</p>
					<p class="h6">Seller Address</p>
					<p>Your Company address</p>

					<hr>
					<div class="alert alert-secondary" role="alert">
					 This is how your product will be visible to buyers
					</div>
		
				</div> 
			</div> 
		</div> 
	</div>
</div>
