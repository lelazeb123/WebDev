<?php 
	
	session_start();
	require "admin/includes/functions.php";
	require "admin/includes/db.php";
	
	$get_recent = $db->query("SELECT * FROM food LIMIT 9");
	
	$result = "";
	
	if($get_recent->num_rows) {
		
		while($row = $get_recent->fetch_assoc()) {
			
			$result .= "<div class='parallax_item'>
				
							<a href='detail.php?fid=".$row['id']."'><img src='image/FoodPics/".$row['id'].".jpg' width='80px' height='80px' /> 
							<div class='detail'>
								
								<h4>".$row['food_name']."</h4>
								<p class='desc'>".substr($row['food_description'], 0, 33)."...</p>
								<p class='price'>Php".$row['food_price']."</p>
								
							</div>
							<p class='clear'></p>
							</a>
							
						</div>";
			
		}
		
	}else{
		
		
		
	}
	
?>

<!Doctype html>

<html lang="en">

<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<meta name="description" content="" />

<meta name="keywords" content="" />

<head>
	
<title>KALDERO DINER</title>

<link rel="stylesheet" href="css/main.css" />

<script src="js/jquery.min.js" ></script>

<script src="js/myscript.js"></script>
	
</head>

<body>
	
<?php require "includes/header.php"; ?>

<div class="parallax" onclick="remove_class()">
	
	<div class="parallax_head">
		
		<h2>HELLO DEAR!</h2>
		<h3>We are always cooking fresh food for you!</h3>
		
	</div>
	
</div>

<div class="content" onclick="remove_class()">
	
	<a href="reservation.php" class="submit">BOOK A TABLE</a>
		
</div>

<div class="content remove_pad" onclick="remove_class()">
	
	<div class="inner_content on_parallax">
		
		<h2><span class="fresh">Discover Fresh Menu</span></h2>
		
		<div class="parallax_content">
			
			<?php echo $result; ?>
			
			<p class="clear"></p>
			
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
			
			<p class="left"></p>
			
			
			
		</div>
		
	</div>
	
</div>


</div>
	
</body>

</html>