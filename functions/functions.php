<?php

// After uploading to online server, change this connection accordingly
$con = mysqli_connect("localhost","root","","ecommerce");

if (mysqli_connect_errno())
{
  	echo "The Connection was not established: " . mysqli_connect_error();
}

// getting the user IP address
function getIp()
{
	$ip = $_SERVER['REMOTE_ADDR'];

	if (!empty($_SERVER['HTTP_CLIENT_IP']))
	{
		$ip = $_SERVER['HTTP_CLIENT_IP'];

	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}

	return $ip;

}

//creating the shopping cart
function cart()
{
	if(isset($_GET['add_cart']))
	{
		global $con; 
		$ip = getIp();
		$pro_id = $_GET['add_cart'];
		$check_pro = "select * from cart where ip_add='$ip' AND p_id='$pro_id'";
		$run_check = mysqli_query($con, $check_pro); 
		
		if(mysqli_num_rows($run_check)>0)
		{
			echo "";

		} else {

			$insert_pro = "insert into cart (p_id,ip_add) values ('$pro_id','$ip')";
			$run_pro = mysqli_query($con, $insert_pro); 
			echo "<script>window.open('index.php','_self')</script>";

		}
	}

}

// getting the total added items
function total_items()
{
	if(isset($_GET['add_cart']))
	{
		global $con; 
		$ip = getIp(); 
		$get_items = "select * from cart where ip_add='$ip'";
		$run_items = mysqli_query($con, $get_items); 
		$count_items = mysqli_num_rows($run_items);

	} else {

		global $con; 
		$ip = getIp(); 
		$get_items = "select * from cart where ip_add='$ip'";
		$run_items = mysqli_query($con, $get_items); 
		$count_items = mysqli_num_rows($run_items);

	}

	echo $count_items;

}
  
// Getting the total price of the items in the cart 
function total_price()
{
	$total = 0;
	global $con; 
	$ip = getIp(); 
	$sel_price = "select * from cart where ip_add='$ip'";
	$run_price = mysqli_query($con, $sel_price); 
	
	while($p_price=mysqli_fetch_array($run_price))
	{
		$pro_id = $p_price['p_id']; 
		$pro_price = "select * from products where product_id='$pro_id'";
		$run_pro_price = mysqli_query($con,$pro_price); 
		
		while ($pp_price = mysqli_fetch_array($run_pro_price))
		{
			$product_price = array($pp_price['product_price']);
			$values = array_sum($product_price);
			$total +=$values;
		}
	}
	
	echo "$" . $total;

}

//getting the categories
function getCats()
{
	global $con; 
	$get_cats = "select * from categories";
	$run_cats = mysqli_query($con, $get_cats);
	
	while ($row_cats=mysqli_fetch_array($run_cats))
	{
		$cat_id = $row_cats['cat_id']; 
		$cat_title = $row_cats['cat_title'];

		// echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";

		// echo "<a class='py-2 d-none d-md-inline-block' href='index.php?cat=$cat_id' onclick='testDestroy();'>$cat_title</a>";

		echo "<a class='py-2 d-none d-md-inline-block' href='index.php?cat=$cat_id'>$cat_title</a>";

	}

}

//getting the brands
function getBrands()
{
	global $con; 
	$get_brands = "select * from brands";
	$run_brands = mysqli_query($con, $get_brands);
	
	while ($row_brands=mysqli_fetch_array($run_brands))
	{
		$brand_id = $row_brands['brand_id']; 
		$brand_title = $row_brands['brand_title'];
	
		// echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";

		echo "<a class='dropdown-item' href='index.php?brand=$brand_id'>$brand_title</a>";
	}

}

function getPro()
{
	if(!isset($_GET['cat']))
	{
		if(!isset($_GET['brand']))
		{
			global $con; 
			$get_pro = "select * from products order by RAND() LIMIT 0,6";
			$run_pro = mysqli_query($con, $get_pro); 
			
			while($row_pro=mysqli_fetch_array($run_pro))
			{
				$pro_id = $row_pro['product_id'];
				$pro_cat = $row_pro['product_cat'];
				$pro_brand = $row_pro['product_brand'];
				$pro_title = $row_pro['product_title'];
				$pro_price = $row_pro['product_price'];
				$pro_image = $row_pro['product_image'];
				echo "
					<div id='single_product'>
						<h3>$pro_title</h3>
						<img src='admin_area/product_images/$pro_image' width='180' height='180' />
						<p><b> Price: $ $pro_price </b></p>
						<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
						<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>
					</div>
				";
			}
		}
	}

}

function getCatPro()
{
	if(isset($_GET['cat']))
	{
		$cat_id = $_GET['cat'];
		global $con; 

		$get_cat_pro = "
		select *, brand_title
		from products
			left join brands
				on products.product_brand = brands.brand_id
		where product_cat='$cat_id'
		";

		$run_cat_pro = mysqli_query($con, $get_cat_pro); 
		$count_cats = mysqli_num_rows($run_cat_pro);

		echo "
			<script>
				$(function() {
					$('.body-content').remove();
				});
			</script>
		";

		echo "
			<div class='product-container'>
				<div class='row pt-5 mt-5 mt-md-3 mt-lg-5'>
		";
		
		if($count_cats==0)
		{
			echo "
				<div class='col-md-4 pb-5'>
					<h2 class='font-weight-light text-muted'>Nothing to see here . . .</h2>
				</div>
			";
		}

		while($row_cat_pro=mysqli_fetch_array($run_cat_pro))
		{
			$pro_id = $row_cat_pro['product_id'];
			$pro_brand_title = $row_cat_pro['brand_title'];
			$pro_title = $row_cat_pro['product_title'];
			$pro_price = $row_cat_pro['product_price'];
			$pro_image = $row_cat_pro['product_image'];

			echo "
				<div class='col-md-4 pb-5'>
					<div class='card-mb-4 '>
						<div width='100%' height='225'>
							<a href='details.php?pro_id=$pro_id'>
								<img class='bd-placeholder-img card-img-top' src='admin_area/product_images/$pro_image' alt='' width='100%' height='100%'>
							</a>
						</div>
						<div class='card-body pt-5 pb-0 px-0'>
							<div class='d-flex justify-content-between align-items-center'>
								<a href='details.php?pro_id=$pro_id' class='product-link'>
									<small class='card-text text-muted'>$pro_brand_title $pro_title</small>
								</a>
								<small class='card-text'>$$pro_price</small>
							</div>
						</div>
					</div>
				</div>
			";

		}

		echo "
				</div>
			</div>
		";
	}
}

function getBrandPro()
{
	if(isset($_GET['brand']))
	{
		$brand_id = $_GET['brand'];
		global $con; 

		$get_brand_pro = "
		select *, brand_title
		from products
			left join brands
				on products.product_brand = brands.brand_id
		where product_brand='$brand_id'
		";

		$run_brand_pro = mysqli_query($con, $get_brand_pro); 
		$count_brands = mysqli_num_rows($run_brand_pro);

		echo "
			<script>
				$(function() {
					$('.body-content').remove();
				});
			</script>
		";

		echo "
			<div class='product-container'>
				<div class='row pt-5 mt-5 mt-md-3 mt-lg-5'>
		";

		if ($count_brands == 0) {
			echo "
				<div class='col-md-4 pb-5'>
					<h2 class='font-weight-light text-muted'>Nothing to see here . . .</h2>
				</div>
			";
		}
		
		while($row_brand_pro=mysqli_fetch_array($run_brand_pro))
		{
			$pro_id = $row_brand_pro['product_id'];
			$pro_brand_title = $row_brand_pro['product_brand'];
			$pro_title = $row_brand_pro['product_title'];
			$pro_price = $row_brand_pro['product_price'];
			$pro_image = $row_brand_pro['product_image'];

			echo "
				<div class='col-md-4 pb-5'>
					<div class='card-mb-4 '>
						<div width='100%' height='225'>
							<a href='details.php?pro_id=$pro_id'>
								<img class='bd-placeholder-img card-img-top' src='admin_area/product_images/$pro_image' alt='' width='100%' height='100%'>
							</a>
						</div>
						<div class='card-body pt-5 pb-0 px-0'>
							<div class='d-flex justify-content-between align-items-center'>
								<a href='details.php?pro_id=$pro_id' class='product-link'>
									<small class='card-text text-muted'>$pro_brand_title $pro_title</small>
								</a>
								<small class='card-text'>$$pro_price</small>
							</div>
						</div>
					</div>
				</div>
			";
		}

		echo "
				</div>
			</div>
		";

	}
}

?>