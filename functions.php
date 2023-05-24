<?php

$categories = array("Mobiles", "Laptops", "Home Appliances", "Men's Fashion", "Women's Fashion", "Sports", "Accessories", "Other");

//https://gist.github.com/efusionsoft/12e7a144eb87c47ff894
$indianStates = [
'AP' => 'Andhra Pradesh',
'AR' => 'Arunachal Pradesh',
'AS' => 'Assam',
'BR' => 'Bihar',
'CT' => 'Chhattisgarh',
'GA' => 'Goa',
'GJ' => 'Gujarat',
'HR' => 'Haryana',
'HP' => 'Himachal Pradesh',
'JK' => 'Jammu and Kashmir',
'JH' => 'Jharkhand',
'KA' => 'Karnataka',
'KL' => 'Kerala',
'MP' => 'Madhya Pradesh',
'MH' => 'Maharashtra',
'MN' => 'Manipur',
'ML' => 'Meghalaya',
'MZ' => 'Mizoram',
'NL' => 'Nagaland',
'OR' => 'Odisha',
'PB' => 'Punjab',
'RJ' => 'Rajasthan',
'SK' => 'Sikkim',
'TN' => 'Tamil Nadu',
'TG' => 'Telangana',
'TR' => 'Tripura',
'UP' => 'Uttar Pradesh',
'UT' => 'Uttarakhand',
'WB' => 'West Bengal',
'AN' => 'Andaman and Nicobar Islands',
'CH' => 'Chandigarh',
'DN' => 'Dadra and Nagar Haveli',
'DD' => 'Daman and Diu',
'LD' => 'Lakshadweep',
'DL' => 'National Capital Territory of Delhi',
'PY' => 'Puducherry'];

$paymentType = array("Prepaid", "COD");

$orderStatus = array("Confirmed", "Shipped", "Delivered", "Returned", "Cancelled", "Seller Cancelled"); 


$productStatus = array("Available", "Out of Stock");

function formatCurrencyINR($money) {
	return preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,",  $money);
}


function getDateFromStamp($datetimestamp) {
	$timestamp = $datetimestamp;
	$datetime = explode(" ",$timestamp);
	$date = $datetime[0];
	return $date;
}
?>