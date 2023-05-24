<?php
require_once "../routes.php";
require_once("../controller/redirectController.php");
require_once("../controller/flashController.php");
require_once("../controller/buyerController.php");
require_once("../controller/buyerProfileController.php");
require_once("../controller/checkoutController.php");
require_once("../controller/ordersController.php");
require_once("../functions.php");
if(session_id() == ''){
      session_start();
   }
if(!isset($_SESSION['Authid']) || empty($_SESSION['Authid'])) {
	
	setFlash("Please Login to proceed", "danger");
	redirect("../".$login);
	//Flash Login to proceed
	
}
if( $_SESSION['Authid'][0] != 1 ) {
	//Flash Not authorised
	echo "Not authorised";
	exit();
}



$loadView = "list.php";
if(isset($_GET['page']) && (!empty($_GET['page']))) {
$loadView = $_GET['page'];
}

?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Buyer</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
 <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
	  .invalidData {
			border: 1px solid red;
		}
    </style>

    
    <!-- Custom styles for this template -->
    <link href="../assets/css/dashboard.css" rel="stylesheet">
  </head>
  <body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid px-5">
                <a class="navbar-brand" href="#">My ECom</a>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4"></ul>
					<?php $itemsCount = showItemsCount(explode("#", $_SESSION['Authid'])[1]); ?>
						<a class="btn btn-outline-danger  mx-2" href="<?= $wishlistlink ?>">
                            <i class="bi-cart-fill me-1"></i>
                            My Wishlist
                            <span class="badge bg-danger text-white ms-1 rounded-pill"><?= $itemsCount[0] ?></span>
                        </a>
                        <a class="btn btn-outline-primary" href="<?= $cart ?>">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill"><?= $itemsCount[1] ?></span>
                        </a>
 
					<div class="dropdown mx-2">
					  <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
						<img src="https://img.icons8.com/matisse/200/null/experimental-gender-neutral-user-matisse.png" alt="" width="32" height="32" class="rounded-circle me-2">
						<strong><?= $_SESSION['username'] ?></strong>
					  </a>
					  <ul class="dropdown-menu text-small shadow">
						<li><a class="dropdown-item" href="<?= $orders ?>">My Orders</a></li>
						<li><a class="dropdown-item" href="<?= $profile ?>">Profile</a></li>
						<li><a class="dropdown-item" href="<?= $changePassword ?>">Change Password</a></li>
						<li><hr class="dropdown-divider"></li>
						<li><a class="dropdown-item" href="<?= $logout ?>">Sign out</a></li>
					  </ul>
					</div>
                </div>
            </div>
        </nav>
<main class="d-flex">

  <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;height:100vh;">
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="?page=list.php" class="nav-link link-dark <?= (!isset($_GET['category'])) ? 'active' : ''; ?>">
          All Products
        </a>
      </li>
	  
	  <?php foreach($categories as $category) { ?>
      <li>
        <a href="<?= "?page=list.php&category=".$category ?>" class="nav-link link-dark <?= (isset($_GET['category']) && ($_GET['category'] == $category)) ? 'active' : '' ?>">
          <?= $category ?>
        </a>
      </li>
      <?php } ?>
	  
    </ul>
  </div>




	<?php include($loadView); ?>

</main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="../assets/js/dashboard.js"></script>
	  <script src="../assets/js/validate.js"></script>
<script>
toastr.options = {
  "closeButton": true,
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
<script language="javascript">
    document.title = "<?= $titleOfPage ?>";
</script>
	<?php showFlash(); ?>	
  </body>
</html>
