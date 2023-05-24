<?php
require_once("../controller/productController.php");
$titleOfPage = "My Products";
?>

<?php //var_dump($products); ?>
  <div class="container-fluid scrollarea mb-5">
    <div class="row">
	<div class="ms-2 mt-2">
            <h2>My Products</h2>
        </div>
	<?php 
	if(count($products) > 0) { 
	foreach ($products as $product) { ?>
        <div class="col-sm-3 mt-3">
            <div class="card card-effect" style="width: 18rem;">
				<a href="<?= $base_url ?>seller?page=product-details.php&product=<?= $product["id"] ?>" class="text-decoration-none text-black"><img class="card-img-top" src="../uploads/images/<?= $product["image_url"] ?>" width="300px" height="180px" alt="Card image cap"></a>
			  <div class="card-body">
				<a href="<?= $base_url ?>seller?page=product-details.php&product=<?= $product["id"] ?>" class="text-decoration-none text-black"><h5 class="card-title"><?= $product["name"] ?></h5></a>
				<p class="card-text"><?= substr($product["description"], 0, 30)."..." ?></p>
			  </div>
			  <div class="card-body">
			  <form action="../controller/productController.php" method="POST">
				<a href="../seller/?page=edit.php&product_id=<?= $product["id"] ?>" class="btn btn-outline-primary btn-sm">Edit</a>
				
				<input name="delete-product" value="<?= $product["id"] ?>" hidden>
				<button type="submit" class="btn btn-outline-danger btn-sm">Remove</button>
				</form>
			  </div>
			</div>
        </div>
	<?php } 
	} else { ?>
	<div class="col-sm-12" style="margin-top:200px;">
		<center><p class="mt-10 display-6">Add product and Start Earning!</p></center>
	</div>
	<?php } ?>
    </div>
	 
	</div>