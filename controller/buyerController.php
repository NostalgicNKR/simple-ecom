<?php
require_once("connectionController.php");
require_once("redirectController.php");
require_once("flashController.php"); 
require_once("../functions.php");
if(session_id() == "") {
	session_start();
}

function showItemsCount($user_id) {
	global $con;
	$statement = $con->prepare("SELECT wishlist, cart FROM buyers WHERE user_id = ?");
	$statement->bind_param("i", $user_id);
	$statement->execute();
	$data = $statement->get_result();
	$result = $data->fetch_all(MYSQLI_ASSOC);
	$result = $result[0];
	return array(count(explode(",", $result['wishlist']))-1, count(explode(",", $result['cart']))-1);
	
}

//Only return the product IDs in wishlist from a user row
function getRawWishlist($user_id) {
	global $con;
	$statement = $con->prepare("SELECT wishlist FROM buyers WHERE user_id = ?");
	$statement->bind_param("i", $user_id);
	$statement->execute();
	$data = $statement->get_result();
	$wishlist = $data->fetch_all(MYSQLI_ASSOC);
	return $wishlist[0]['wishlist'];
}


function listProducts() {
	global $categories;
	global $con;
	$statement = $con->prepare("SELECT id, name, description, original_price, discounted_price, category, image_url, product_status FROM products ORDER BY id DESC");
	if(isset($_GET['category'])) {
		$category = array_search($_GET['category'], $categories);
		$statement = $con->prepare("SELECT id, name, description, original_price, discounted_price, category, image_url, product_status FROM products WHERE category = ? ORDER BY id DESC");
		$statement->bind_param("i", $category);
	}
	$statement->execute();
	$result = $statement->get_result();
	$products = $result->fetch_all(MYSQLI_ASSOC); 
	return $products;
}
	
function getProductDetail($product_id) {
	global $con;
	$statement = $con->prepare("SELECT id, seller_id, name, description, original_price, discounted_price, category, image_url, product_status FROM products WHERE id = ?");
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

//Using raw list to get products from product database
function getItemsFromWishlist($user_id) {
	//IF wishlist is empty, show NO DATA in page
	if(empty(getRawWishlist($user_id))) {
		return NULL;
		//redirect($_SERVER["HTTP_REFERER"]);
	}
	
	//Poping the last element of array after exploding based on comma(,) to prevent bugs
	$product_ids = explode(",",getRawWishlist($user_id));
	array_pop($product_ids);
	
	$count = count($product_ids);
	$placeholders = implode(',', array_fill(0, $count, '?'));
	$bindStr = str_repeat('i', $count);
	
	global $con;
	$statement = $con->prepare("SELECT id, name, description, original_price, discounted_price, category, image_url, product_status FROM products WHERE id IN ($placeholders)");
	$statement->bind_param($bindStr, ...$product_ids);
	$statement->execute();
	$data = $statement->get_result();
	$products = $data->fetch_all(MYSQLI_ASSOC);
	return $products;
	
}

function addToWishlist($product_id, $user_id) {
	//Get the old list from db
	$previosList = getRawWishlist($user_id);
	
	//Check if the product is in db already by using product_id
	if(strpos($previosList, "$product_id") != '') {
		setFlash('Product already in wishlist', 'error');
		redirect($_SERVER["HTTP_REFERER"]);
	}
	//If not in db, add item to wishlist by concatinating it to comma(,) and proceed to store
	$newList = $previosList . $product_id . ",";
	global $con;
	$statement = $con->prepare("UPDATE buyers SET wishlist = ? WHERE user_id = ?");
	$statement->bind_param("si", $newList, $user_id);
	$statement->execute();
	setFlash('Product has been saved in wishlist', 'success');
	redirect($_SERVER["HTTP_REFERER"]);
	
}

function removeFromWishlist($product_id, $user_id) {
	//Get the old list
	$previosList = getRawWishlist($user_id);
	
	//delete the product by its ID and its comma(suffix) by replacing it with an empty string
	$newList = str_replace($product_id.",", "", $previosList);
	global $con;
	$statement = $con->prepare("UPDATE buyers SET wishlist = ? WHERE user_id = ?");
	$statement->bind_param("si", $newList, $user_id);
	$statement->execute();
	setFlash('Product has been removed from wishlist', 'success');
	redirect($_SERVER["HTTP_REFERER"]);
}


function getRawCart($user_id) {
	global $con;
	$statement = $con->prepare("SELECT cart FROM buyers WHERE user_id = ?");
	$statement->bind_param("i", $user_id);
	$statement->execute();
	$data = $statement->get_result();
	$cart = $data->fetch_all(MYSQLI_ASSOC);
	return $cart[0]['cart'];
}

function getItemsFromCart($user_id) {
	if(empty(getRawCart($user_id))) {
		return NULL;
		//redirect($_SERVER["HTTP_REFERER"]);
	}
	$product_ids = explode(",",getRawCart($user_id));
	array_pop($product_ids);

	$count = count($product_ids);
	$placeholders = implode(',', array_fill(0, $count, '?'));
	$bindStr = str_repeat('i', $count);
	
	global $con;
	$statement = $con->prepare("SELECT id, name, description, original_price, discounted_price, category, image_url FROM products WHERE id IN ($placeholders)");
	$statement->bind_param($bindStr, ...$product_ids);
	$statement->execute();
	$data = $statement->get_result();
	$cartProducts = $data->fetch_all(MYSQLI_ASSOC);
	return $cartProducts;
	
}


function addToCart($product_id, $user_id, $quantity = 1) {
	$previosList = getRawCart($user_id);
	
	
	if(strpos($previosList, "$product_id") != '') {
		setFlash('product is already in cart', 'error');
		redirect($_SERVER["HTTP_REFERER"]);
	}
	$newList = $previosList . $product_id . "#" . $quantity . ",";
	global $con;
	$statement = $con->prepare("UPDATE buyers SET cart = ? WHERE user_id = ?");
	$statement->bind_param("si", $newList, $user_id);
	$statement->execute();
	//setFlash('Product has been added to Cart', 'success');
	redirect($_SERVER["HTTP_REFERER"]);

}

function removeFromCart($product_id, $user_id, $redirect = 1,) {
	$previosList = getRawCart($user_id);
	$indexOfItem = strpos($previosList, $product_id."#");
	$newList = substr_replace($previosList, "", $indexOfItem, 3+strlen((string)$product_id));
	global $con;
	$statement = $con->prepare("UPDATE buyers SET cart = ? WHERE user_id = ?");
	$statement->bind_param("si", $newList, $user_id);
	$statement->execute();
	//setFlash('Product has been removed from cart', 'success');
	if($redirect == 1) {
		redirect($_SERVER["HTTP_REFERER"]);
	}
}


function getQuantity($user_id) {
	$previosList = getRawCart($user_id);
	$rawCart = explode(",", $previosList);
	array_pop($rawCart);
	$productQuantity = array();
	$temp = array();
	foreach($rawCart as $product) {
		$temp = explode("#", $product);
		$productQuantity["$temp[0]"] = $temp[1];
	}
	return $productQuantity;
}

function modifyQuantity($product_id, $user_id, $quantity) {
	setFlash("Quantity changed to $quantity", "success");
	removeFromCart($product_id, $user_id, 0);
	addToCart($product_id, $user_id, $quantity);
	
}


if($loadView = "list.php") {	
	$products = listProducts();
}

if(isset($_GET['page']) && ($_GET['page'] == "product-details.php")) {
	$productDetail = getProductDetail($_GET['product']);
	
}

if(isset($_POST['add-to-cart'])) {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	addToCart($_POST['product_id'], $user_id, $_POST['quantity']);	
}

if(isset($_GET['page']) && ($_GET['page'] == "wishlist.php")) {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	$wishlist = getItemsFromWishlist($user_id);
}

if(isset($_GET['add-to-wishlist'])) {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	addToWishlist($_GET['add-to-wishlist'], $user_id);
	
}

if(isset($_GET['remove-from-wishlist'])) {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	removeFromWishlist($_GET['remove-from-wishlist'], $user_id);
	
}


if(isset($_GET['page']) && ($_GET['page'] == "cart.php")) {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	$cartList = getItemsFromCart($user_id);
	$cartQuantity =  getQuantity($user_id);
}

if(isset($_GET['page']) && ($_GET['page'] == "checkout.php")) {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	$cartList = getItemsFromCart($user_id);
	$cartQuantity =  getQuantity($user_id);
}


if(isset($_GET['add-to-cart'])) {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	setFlash('Product has been added to Cart', 'success');
	addToCart($_GET['add-to-cart'], $user_id);	
	
}

if(isset($_GET['remove-from-cart'])) {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	setFlash('Product has been removed from cart', 'success');
	removeFromCart($_GET['remove-from-cart'], $user_id);
	
	
}

if(isset($_POST['quantity'])) {
	$user_id = explode("#", $_SESSION['Authid'])[1];
	modifyQuantity($_POST['product_id'], $user_id, $_POST['quantity']);
}

