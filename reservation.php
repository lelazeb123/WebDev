<?php 
	
	session_start();
	require "admin/includes/functions.php";
	require "admin/includes/db.php";
	
	$msg = "";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if(isset($_POST['submit'])) {
			
			$guest = preg_replace("#[^0-9]#", "", $_POST['guest']);
			$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
			$phone = preg_replace("#[^0-9]#", "", $_POST['phone']);
			$date_res = htmlentities($_POST['date_res'], ENT_QUOTES, 'UTF-8');
			$time = htmlentities($_POST['time'], ENT_QUOTES, 'UTF-8');
			$suggestions = htmlentities($_POST['suggestions'], ENT_QUOTES, 'UTF-8');
			
			if($guest != "" && $email && $phone != "" && $date_res != "" && $time != "" && $suggestions != "") {
				
				//Check for remaining table space;
				$table_array = array();
				$mtime = strftime("%H", time());
				$mdate = strftime("%Y-%m-%d", time());
				$get_table_count = $db->query("SELECT global_amt FROM Globals");
				$row_count = $get_table_count->fetch_assoc();
				$table_count = $row_count['global_amt'];
				$fetch = $db->query("SELECT * FROM reservation");
				if($fetch->num_rows) {
					while($row_fetch = $fetch->fetch_assoc()) {
						if(($row_fetch['date_res'] >= $mdate) && ($row_fetch['time'] >= $mtime)) {
							$table_array[] = $row_fetch['reserve_id'];
						}
					}
				}
				echo(count($table_array));
				if(count($table_array) < $table_count) {
					$check = $db->query("SELECT * FROM reservation WHERE no_of_guest='".$guest."' AND email='".$email."' AND phone='".$phone."' AND date_res='".$date_res."' AND time='".$time."' LIMIT 1");
					
					if($check->num_rows) {
						
						$msg = "<p style='padding: 15px; color: red; background: #ffeeee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>You have already placed a reservation with the same information</p>";
						
					}else{
						
						$insert = $db->query("INSERT INTO reservation(no_of_guest, email, phone, date_res, time, suggestions) VALUES('".$guest."', '".$email."', '".$phone."', '".$date_res."', '".$time."', '".$suggestions."')");
						
						if($insert) {
							
							$ins_id = $db->insert_id;
							
							$reserve_code = "UNIQUE_$ins_id".substr($phone, 3, 8);
							
							$msg = "<p style='padding: 15px; color: green; background: #eeffee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>Reservation placed successfully. Your reservation code is $reserve_code. Please Note thatyour reservation expires after One hour</p>";
							
						}else{
							
							$msg = "<p style='padding: 15px; color: red; background: #ffeeee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>Could not place reservation. Please try again</p>";
							
						}
						
					}
				}else{
					
					$msg = "<p style='padding: 15px; color: red; background: #ffeeee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>No table space available.Please check back after one hour</p>";
					
				}
				
			}else{
				
				$msg = "<p style='padding: 15px; color: red; background: #ffeeee; font-weight: bold; font-size: 13px; border-radius: 4px; text-align: center;'>Incomplete form data or Invalid data type</p>";
				
				//print_r($_POST);
				
			}
			
		}
		
	}
	
?>

<!Doctype html>

<html lang="en">

<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<meta name="description" content="" />

<meta name="keywords" content="" />

<head>
	
<title>KALDERO RESTAURANT</title>

<link rel="stylesheet" href="css/main.css" />

<script src="js/jquery.min.js" ></script>

<script src="js/myscript.js"></script>
	
</head>

<body>
	
<?php require "includes/header.php"; ?>

<

<div class="content" onclick="remove_class()">
	
	<div class="inner_content">
		
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="hr_book_form">
			
			<h2 class="form_head"><span class="book_icon">BOOK A TABLE</span></h2>
			
			<?php echo "<br/>".$msg; ?>
			
			<div class="left">
				
				<div class="form_group">
					 
					 <label>No of Persons</label>
					<input type="number" placeholder="How many persons" min="1" name="guest" id="guest" required>
					
				</div>
				
				<div class="form_group">
					
					<label>Email</label>
					<input type="email" name="email" placeholder="Enter your email" required>
					
				</div>
				
				<div class="form_group">
					
					<label>Phone Number</label>
					<input type="text" name="phone" placeholder="Enter your phone number" required>
					
				</div>
				
				<div class="form_group">
					
					<label>Date</label>
					<input type="date" name="date_res" placeholder="Select date for booking" required>
					
				</div>
				
				<div class="form_group">
					
					<label>Time</label>
					<input type="time" name="time" placeholder="Select time for booking" required>
					
				</div>
				
				
			</div>
			
			<div class="left">
				
				<div class="form_group">
					
                    <label>Notes </label>
					<textarea name="suggestions" placeholder="" required></textarea>
					
				</div>
				
				<div class="form_group">
					
					<input type="submit" class="submit" name="submit" value="MAKE YOUR BOOKING" />
					
				</div>
				
			</div>
			
			<p class="clear"></p>
			
		</form>
		
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