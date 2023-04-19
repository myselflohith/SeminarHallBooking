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
	$id = mysqli_real_escape_string($conn,$_POST['id']);
	$password = $_POST['password'];

	$sql1 = "SELECT username FROM bookings WHERE id='$id'";
	$result = mysqli_query($conn, $sql1);
	
if ($result) {
	$row = mysqli_fetch_assoc($result);
	$username = $row['username'];
	
	//Change common password here
	$pwd = "123456";
	if($password == $pwd or $password == $username) {
	
		$sql = "DELETE FROM bookings WHERE id='$id'";
		if (mysqli_query($conn, $sql)) {
			header('Location: index.php?error= Booking Successfully Deleted');
			
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	} else {
	    header('Location: index.php?error=Error: Wrong Common Password.');
	}
}
else{
	echo mysqli_error($result);
}
	mysqli_close($conn);
?>
