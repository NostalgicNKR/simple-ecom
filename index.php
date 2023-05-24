<?php
include("routes.php");
?>


<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Welcome to Ecom</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
  <body>
	  <div class="container">
    <header class="d-flex justify-content-center py-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img class="my-1" src="assets/img/shopping-cart.png" alt="" width="50">
        <span class="fs-4">My ECom</span>
      </a>

      <ul class="nav nav-pills">
        <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>
        <li class="nav-item"><a href="<?= $login ?>" class="nav-link">Login</a></li>
        <li class="nav-item"><a href="<?= $signup ?>" class="nav-link">Sign Up</a></li>
      </ul>
    </header>
  </div>

	<div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="assets/img/shopping-cart.png" alt="" width="72">
    <h1 class="display-5 fw-bold">Welcome to My ECom</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Welcome to my ecommerce application, register either as a buyer or seller to start using the application. <br> Have a great day!</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="<?= $login ?>" class="btn btn-primary btn-lg px-4 ">Already Registered?</a>
        <a href="<?= $signup ?>" class="btn btn-outline-secondary btn-lg px-4">Register now</a>
      </div>
    </div>
  </div>

<div class="container">
  <footer class="py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-muted">&copy; 2023 My ECom</p>
  </footer>
</div>
    
  </body>
</html>