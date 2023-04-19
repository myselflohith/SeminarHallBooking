<?php
	// Establish database connection
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'seminar';
    
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	// Retrieve input values from the form
	$date = mysqli_real_escape_string($conn,$_POST['date']);
	$start_time = mysqli_real_escape_string($conn,$_POST['start_time']);
	$end_time = mysqli_real_escape_string($conn,$_POST['end_time']);
	$event_details = mysqli_real_escape_string($conn,$_POST['event_details']);
	$username = mysqli_real_escape_string($conn,$_POST['username']);
	$password = $_POST['password'];
	
	//Change common password here
	$pwd = "123456";
	if($password == $pwd) {
	if ($start_time >= $end_time) {
		// End time should be greater than start time
		header('Location: index.php?error=Error: End time should be greater than start time.');
		echo "Error: End time should be greater than start time.";
	} else {
		// Check if the selected time range is available
		$sql = "SELECT * FROM bookings WHERE date = '$date' AND ((start_time <= '$start_time' AND end_time > '$start_time') OR (start_time >= '$start_time' AND start_time < '$end_time'))";
		$result = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) > 0) {
			// Time range is not available, retrieve the name and details of the person who booked it
			$row = mysqli_fetch_assoc($result);
			$name = $row['username'];
			$details = $row['event_details'];
			header('Location: index.php?status=booked&details='.$details.'');
			echo "The seminar hall is already booked at that time by $name for $details.";
		} else {
			// Time range is available, insert the booking details into the database
			$sql = "INSERT INTO bookings (date, start_time, end_time, event_details, username) VALUES ('$date', '$start_time', '$end_time', '$event_details', '$username')";
			
			if (mysqli_query($conn, $sql)) {
				header('Location: index.php?error=Slot Booked Successfully for date '.$date.'');
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
	}
	}
	else {
	    header('Location: index.php?error=Error: Wrong Common Password.');
	}
	mysqli_close($conn);
?>
