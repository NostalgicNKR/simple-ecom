<?php
require_once("routes.php");
require_once("controller/redirectController.php");
require_once("controller/flashController.php");
if(session_id() == "") {
	session_start();
}

if(isset($_SESSION['Authid'])) {
	if($_SESSION['Authid'][0] == 1) {
		redirect("customer/");
	} elseif($_SESSION['Authid'][0] == 2) {
		redirect("seller/");
	}
	
}


?>


<!doctype html>
<html lang="en">
  <head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Sign up</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
   <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
	
<style>

</style>
  </head>
  <body class="text-center">

<main class="form-signin w-100 m-auto">
  <form action="controller/signupController.php" method="POST" name="signupForm" onsubmit="return validateSignup();">
    <img class="mb-4" src="assets/img/shopping-cart.png" alt="" width="72">
    <h1 class="h3 mb-3 fw-normal">Please Enter Details</h1>
	<div class="form-floating">
      <input type="text" class="form-control" name="username" id="username" placeholder="Peter" required>
      <label for="username">username</label>
	  <p class="h6 validate-result text-danger d-none"></p>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" >
      <label for="email">Email address</label>
	  <p class="h6 validate-result text-danger d-none"></p>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
      <label for="password">Password</label>
	  <p class="h6 validate-result text-danger d-none"></p>
    </div>
	<div class="form-floating">
      <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" required>
      <label for="confirmPassword">Confirm Password</label>
	  <p class="h6 validate-result text-danger d-none"></p>
    </div>
	<div class="form-floating mb-3">
		<select class="form-select" name="role" id="role">
			<option value="1">Buyer</option>
			<option value="2">Seller</option>
		</select>
      <label for="role">Registering as</label>
    </div>
    
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
	<div class="mt-2">
      <a href="<?= $login ?>" class="text-bold">Already Registered?</a>
    </div>
  </form>
  
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>   
<script>
toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

</script>
<?php showFlash(); ?>  
<script src="assets/js/validate.js"></script>
  </body>
</html>
