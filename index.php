<?php
session_start();
include("functions/functions.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
</head>

<body>

	<nav class="site-header sticky-top py-1" id="nav-contain">
		<div class="container d-flex flex-column flex-md-row justify-content-around" id="nav-content">
			<a class="py-2" href="index.php">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mx-auto" role="img" viewBox="0 0 24 24" focusable="false">
					<title>Product</title>
					<circle cx="12" cy="12" r="10" />
					<path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94" />
				</svg>
			</a>
			<?php getCats(); ?>
			<div class="dropdown">
				<a class="py-2 d-none d-md-inline-block" data-toggle="dropdown" href="">Shop</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="all_products.php">All Products</a>
					<div class="dropdown-divider"></div>
					<?php getBrands(); ?>
				</div>
			</div>
			<a class="py-2 d-none d-md-inline-block" href="#" data-toggle="modal" data-target="#search-modal">Search</a>
			<div class="dropdown">
				<a class="py-2 d-none d-md-inline-block" data-toggle="dropdown" href="">Bag</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="cart.php">Bag</a>
					<div class="dropdown-divider"></div>
					<?php
					if (isset($_SESSION['customer_email'])) {
						echo "<a class='dropdown-item' href='customer/my_account.php'>Account</a>";
						echo "<a class='dropdown-item' href='logout.php'>Log out</a>";
					} else {
						echo "<a class='dropdown-item' href='customer/my_account.php'>Account</a>";
						echo "<a class='dropdown-item' href='#'>Log in</a>";
					}
					?>
				</div>
			</div>
		</div>
	</nav>

	<div class="modal" tabindex="-1" role="dialog" id="search-modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<form method="get" action="results.php" enctype="multipart/form-data">
						<div class="row justify-content-center">
							<div class="input-group col-md-12" id="form">
								<input class="form-control py-2 border-right-0 border" type="text" placeholder="Search" name="user_query" />
								<span class="input-group-append">
									<button class="btn btn-outline-secondary border-left-0 border" type="submit" name="search">
										<i class="fa fa-search"></i>
									</button>
								</span>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php getCatPro(); ?>
	<?php getBrandPro(); ?>

	<div class="body-content">
		<div class="position-relative overflow-hidden p-3 p-md-5 mb-md-3 text-center bg-light">
			<div class="col-md-5 p-lg-5 mx-auto my-5">
				<h1 class="display-4 font-weight-normal">Punny headline</h1>
				<p class="lead font-weight-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts with this example based on Apple’s marketing pages.</p>
				<a class="btn btn-outline-secondary" href="#">Coming soon</a>
			</div>
			<div class="product-device shadow-sm d-none d-md-block"></div>
			<div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
		</div>

		<div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
			<div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden ">
				<div class="my-3 p-3">
					<h2 class="display-5">Another headline</h2>
					<p class="lead">And an even wittier subheading.</p>
				</div>
				<div class="bg-white shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
			</div>
			<div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden ">
				<div class="my-3 py-3">
					<h2 class="display-5">Another headline</h2>
					<p class="lead">And an even wittier subheading.</p>
				</div>
				<div class="bg-white shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
			</div>
		</div>

		<div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
			<div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden ">
				<div class="my-3 p-3">
					<h2 class="display-5">Another headline</h2>
					<p class="lead">And an even wittier subheading.</p>
				</div>
				<div class="bg-white shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
			</div>
			<div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden ">
				<div class="my-3 py-3">
					<h2 class="display-5">Another headline</h2>
					<p class="lead">And an even wittier subheading.</p>
				</div>
				<div class="bg-white shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
			</div>
		</div>

		<div class="position-relative overflow-hidden p-3 p-md-5 mt-md-3 mb-md-5 text-center bg-light">
			<div class="col-md-5 p-lg-5 mx-auto my-5">
				<h1 class="display-4 font-weight-normal">Punny headline</h1>
				<p class="lead font-weight-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts with this example based on Apple’s marketing pages.</p>
				<a class="btn btn-outline-secondary" href="#">Coming soon</a>
			</div>
			<div class="product-device shadow-sm d-none d-md-block"></div>
			<div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
		</div>
	</div>

	<footer class="pt-md-5 container" id="foot-contain">
		<div class="pt-md-5 pl-md-5 row justify-content-around">
			<div class="pl-md-4 col-2 col-md">
				<h7>first header</h7>
				<ul class="list-unstyled text-small">
					<li>
						<a class="text-muted" href="#">first list item</a>
					</li>
					<li>
						<a class="text-muted" href="#">second list item</a>
					</li>
					<li>
						<a class="text-muted" href="#">third list item</a>
					</li>
					<li>
						<a class="text-muted" href="#">fourth list item</a>
					</li>
					<li>
						<a class="text-muted" href="#">fifth list item</a>
					</li>
				</ul>
			</div>
			<div class="pl-md-4 col-2 col-md">
				<h7>second header</h7>
				<ul class="list-unstyled text-small">
					<li>
						<a class="text-muted" href="#">first list item</a>
					</li>
					<li>
						<a class="text-muted" href="#">second list item</a>
					</li>
					<li>
						<a class="text-muted" href="#">third list item</a>
					</li>
					<li>
						<a class="text-muted" href="#">fourth list item</a>
					</li>
					<li>
						<a class="text-muted" href="#">fifth list item</a>
					</li>
				</ul>
			</div>
			<div class="pl-md-4 col-2 col-md">
				<h7>third header</h7>
				<ul class="list-unstyled text-small">
					<li>
						<a class="text-muted" href="#">first list item</a>
					</li>
					<li>
						<a class="text-muted" href="#">second list item</a>
					</li>
					<li>
						<a class="text-muted" href="#">third list item</a>
					</li>
					<li>
						<a class="text-muted" href="#">fourth list item</a>
					</li>
					<li>
						<a class="text-muted" href="#">fifth list item</a>
					</li>
				</ul>
			</div>
			<div class="pl-md-4 col-2 col-md">
				<h7>fourth header</h7>
				<ul class="list-unstyled text-small">
					<li>
						<a class="text-muted" href="#">first list item</a>
					</li>
					<li>
						<a class="text-muted" href="#">second list item</a>
					</li>
					<li>
						<a class="text-muted" href="#">third list item</a>
					</li>
					<li>
						<a class="text-muted" href="#">fourth list item</a>
					</li>
					<li>
						<a class="text-muted" href="#">fifth list item</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="pt-md-5 row text-center">
			<div class="col-12 col-md" id="foot-info">
				<p class="text-muted">foot info placeholder text</p>
			</div>
		</div>
	</footer>

	<!-- Optional JavaScript -->
	<script src="js/script.js"></script>
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>