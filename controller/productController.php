<?php
require_once("connectionController.php");
require_once("redirectController.php");
require_once("flashController.php"); 


	function listProducts() {
		global $con;
		$statement = $con->prepare("SELECT id, name, description, original_price, discounted_price, category, image_url FROM products WHERE seller_id = ? ORDER BY id DESC");
		$statement->bind_param("i", $_SESSION['seller_id']);
		$statement->execute();
		$result = $statement->get_result(); // get the mysqli result
		$products = $result->fetch_all(MYSQLI_ASSOC); // fetch data   
		return $products;
	}

	function addProduct($name, $category, $description, $originalPrice, $discountedPrice, $filename, $tempname, $folder) {
		global $con;
		$statement = $con->prepare("INSERT INTO products(seller_id, name, description, category, original_price, discounted_price, image_url) VALUES(?, ?, ?, ?, ?, ?, ?)");
		$statement->bind_param("issiiis",$_SESSION['seller_id'], $name, $description, $category, $originalPrice, $discountedPrice, $filename);
		uploadImage($tempname, $folder);
		$statement->execute();
		$statement->close();
		setFlash("Product added successfully", "success");
		redirect($_SERVER["HTTP_REFERER"]);

	}
	
	function updateProduct($product_id, $name, $category, $description, $originalPrice, $discountedPrice, $image, $productStatus) {
		global $con;
		
		$statement = $con->prepare("UPDATE products SET name = ?, description = ?, category = ?, original_price = ?, discounted_price = ?, image_url = ?, product_status = ? WHERE id = ?");
		$statement->bind_param("ssiiisii", $name, $description, $category, $originalPrice, $discountedPrice, $image, $productStatus, $product_id);
		$statement->execute();
		$statement->store_result();
		setFlash("Product updated successfully", "success");
		redirect($_SERVER["HTTP_REFERER"]);
	}
	
	/*function fetchProduct($id) {
		global $con;
		$statement = $con->prepare("SELECT * from products where id = ?");
		$statement->bind_param("i", $id);
		$statement->execute();
		$statement->store_result();
		if($statement->num_rows ==  1) {
			$statement->bind_result($product_id, $seller_id, $product_name, $product_description, $original_price, $discount_price, $category, $image, $addedOn, $productStatus);
			if($statement->fetch()) {
				return array(
							"product_id" => $product_id,
							"seller_id" => $seller_id,
							"product_name" => $product_name,
							"product_description" => $product_description,
							"original_price" =>  $original_price,
							"discount_price" => $discount_price,
							"category" => $category,
							"product_image" => $image,
							"listed_date" => $addedOn,
							"product_status" => $productStatus
							);
			}
			
		}
		
	}*/
	
	function fetchProduct($id, $user_id) {
		global $con;
		$statement = $con->prepare("SELECT * from products where id = ? AND seller_id = (SELECT id FROM sellers WHERE user_id = ?)");
		$statement->bind_param("ii", $id, $user_id);
		$statement->execute();
		$data = $statement->get_result();
		$result = $data->fetch_all(MYSQLI_ASSOC);
		return $result[0];
	}
	
	
	function uploadImage($tempname, $folder, $oldfile = null) {
		if (file_exists("../uploads/images/".$oldfile)) {
		    unlink("../uploads/images/".$oldfile);
		}
		 if (move_uploaded_file($tempname, $folder)) {
			 return true;
		 } else {
			 return false;
		 }
		
	}
	
	function deleteProduct($id) {
		global $con;
		$statement = $con->prepare("DELETE FROM products WHERE id=?");
		$statement->bind_param("i", $id);
		$statement->execute();
		setFlash("Product deleted successfully", "success");
		redirect($_SERVER["HTTP_REFERER"]);
	}

	function getProductDetail($product_id) {
		global $con;
		$statement = $con->prepare("SELECT id, seller_id, name, description, original_price, discounted_price, category, image_url FROM products WHERE id = ?");
		$statement->bind_param("i", $product_id);
		$statement->execute();
		$data = $statement->get_result(); 
		$result = $data->fetch_all(MYSQLI_ASSOC); 
		$stmt = $con->prepare("SELECT company_name, company_address FROM sellers WHERE id = ?");
		$stmt->bind_param("i", $result[0]['seller_id']);
		$stmt->execute();
		$dat = $stmt->get_result();
		$res = $dat->fetch_all(MYSQLI_ASSOC);
		$result[0]['company_name'] = $res[0]['company_name'];
		$result[0]['company_address'] = $res[0]['company_address'];
		return $result[0];
	
	}
//Call function to add new product if new product form is submiyyed
if (isset($_POST['uploadfile'])) {
	addProduct($_POST['product-name'], $_POST['product-category'], $_POST['product-description'], $_POST['product-price'], $_POST['product-discount-price'], $_FILES['product-image']['name'], $_FILES['product-image']['tmp_name'], "../uploads/images/".$_FILES['product-image']['name']);
}

//Call update function if theres product id already coming from form
if(isset($_POST['product-id'])){
	
	$image = $_FILES['product-image']['name']; //If newimage is selected, then update the name of it
	if($image != "") { //If newimage is selected, then upload image to destination folder
		uploadImage($_FILES['product-image']['tmp_name'], "../uploads/images/".$_FILES['product-image']['name'], "../uploads/images/".$_POST['old_image']);
	} else {
		$image = $_POST['old_image']; //If no new image is selected, then update the name of old image itself
	}
	updateProduct($_POST['product-id'], $_POST['product-name'], $_POST['product-category'],  $_POST['product-description'], $_POST['product-price'], $_POST['product-discount-price'], $image, $_POST['product-status']);
}
if(isset($_GET['product_id']) && (!empty($_GET['product_id']))) {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	$product = fetchProduct($_GET['product_id'], $user_id);
	
}


if(isset($_GET['page']) && $_GET['page'] == 'my-products.php') {
	$products = listProducts();

}


if(isset($_GET['page']) && ($_GET['page'] == "product-details.php")) {
	$productDetail = getProductDetail($_GET['product']);
	
}

if(isset($_POST['delete-product'])) {
	deleteProduct($_POST['delete-product']);
}
	