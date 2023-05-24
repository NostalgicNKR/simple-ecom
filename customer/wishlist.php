 <?php 
require_once("../controller/buyerController.php");
require_once("../controller/flashController.php"); 
$titleOfPage = "My Wishlist";
?>
 
  
  
  <div class="container px-3 my-5 scrollarea">
    <div class="row">
	    <div class="card-header">
            <h2>My Wishlist</h2>
        </div>
	<?php if(isset($wishlist)) {
	foreach ($wishlist as $product) { ?>
        <div class="col-sm-3 mt-3">
            <div class="card card-effect" style="width: 18rem;">
			  <a href="<?= $base_url ?>customer?page=product-details.php&product=<?= $product["id"] ?>" class="text-decoration-none text-black"><img class="card-img-top" src="../uploads/images/<?= $product["image_url"] ?>" width="300px" height="180px" alt="Card image cap"></a>
			  <div class="card-body">
				<a href="<?= $base_url ?>customer?page=product-details.php&product=<?= $product["id"] ?>" class="text-decoration-none text-black"><h5 class="card-title"><?= substr($product["name"], 0, 40)."..." ?></h5></a>
				<p class="card-text"><?= substr($product["description"], 0, 30)."..." ?></p>
				<div class="row">
				<?php
					//https://stackoverflow.com/a/54603979
					$amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,",  $product["discounted_price"]);
					$orgAmount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,",  $product["original_price"]); 
				?>
					<div class="col-sm-6 mb-0 text-start">
					<?php if($product['product_status'] == 0) { ?>
							<p style="font-size:12px;"><span class="h5 text-success">&#8377; <?= $amount ?>/-</span><br><span class="text-muted"><del>&#8377;<?= $orgAmount ?></del></span><p>
					<?php } else { ?>
							<p style="font-size:15px;" class="text-muted">Out of stock<p>
					<?php } ?>
					</div>
					
					<div class="col-sm-6 text-end">
					<?php if($product['product_status'] == 0) { ?>
						<a href="<?= strtok($_SERVER["REQUEST_URI"], '?') ?>?add-to-cart=<?= $product["id"] ?>" class="btn btn-outline-primary"><i class="fa-solid fa-cart-shopping"></i></a>
					<?php } ?>
					<a href="<?= basename($_SERVER['REQUEST_URI']) ?>&remove-from-wishlist=<?= $product["id"] ?>" class="btn btn-outline-danger"><i class="fa-solid fa-xmark"></i></a>
					</div>
				</div>
				
				
			  </div>
			</div>
        </div>
	<?php } 
	} else { ?> 
			<center><p class="display-6">Your Wishlist is empty</p></center>
	<?php } ?>
    </div>
	 
	</div>