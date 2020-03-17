<?php 
	
	session_start();
	error_reporting(0);
	
	$order_id = $_SESSION['order_id'];
	$name = $_SESSION['name'];
	
	unset($_SESSION['order_id']);
	
	unset($_SESSION['name']);
	
	unset($_SESSION['cart_array']);
	
?>

<!Doctype html>

<html lang="en">

<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<meta name="description" content="" />

<meta name="keywords" content="" />

<head>
	
<title>Kaldero Restaurant</title>

<link rel="stylesheet" href="css/main.css" />

<script src="js/jquery.min.js" ></script>

<script src="js/myscript.js"></script>
	
</head>

<body>
	
<?php require "includes/header.php"; ?>

<div class="parallax_basket" onclick="remove_class()">
	
	<div class="parallax_head_basket">
		
		<h2>Order</h2>
		<h3>Summary</h3>
		
	</div>
	
</div>

<div class="content remove_pad" onclick="remove_class()">
	
	<div class="inner_content on_parallax">
		
		<h2><span class="s_summary">Order Success</span></h2>
		
		<div class="order_holder">
			
			<p class="summary_p">Thank you for your ordering <?php echo $name; ?>. Your <span>Order number</span> is: <?php echo $order_id; ?>. We will ensure that your order is delivered in time. Please it is important to take note that your order number should be kept safe</p>
			
		</div>
		
		
		
	</div>
	
</div>

<div class="content" onclick="remove_class()">
	
	<div class="inner_content">
		
		<div class="contact">
			
			<div class="left">
				
				<h3>LOCATION</h3>
				<p>Matina, Davao City</p>
				<p>Mindanao, Phippines</p>
				
				
			</div>
			
			<div class="left">
				
				<h3>CONTACT</h3>
				<p>09172638272</p>
				<p>kalderoResto@gmail.com</p>
				
			</div>
			
			
			
		</div>
		
	</div>
	
</div>


	
</div>

</body>

</html>