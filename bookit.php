<!DOCTYPE html>
<html>
<head>

	<title>Seminar Hall Booking System</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<style>


@font-face {
  font-family: 'Roboto';
  font-style: normal;
  font-weight: 300;
  src: url(https://fonts.gstatic.com/s/roboto/v30/KFOlCnqEu92Fr1MmSU5fBBc9.ttf) format('truetype');
}
@font-face {
  font-family: 'Roboto';
  font-style: normal;
  font-weight: 500;
  src: url(https://fonts.gstatic.com/s/roboto/v30/KFOlCnqEu92Fr1MmEU9fBBc9.ttf) format('truetype');
}
html,
body {
  background-color: #fff;
}

	</style>
</head>
<body>
	<div class="container">
<?php
$date =  date('Y-m-');
$d = $_GET['day'];
//y-m-d
$mon = $_GET['month'];
$month = sprintf("%02d", $mon);

$year = $_GET['year'];

$day = sprintf("%02d", $d);

?>
	<h1>Seminar Hall Booking System</h1>
	<a href="index.php" style="float: right; margin-top: 10px; padding: 10px 20px; font-size: 16px; background-color: #4CAF50; border: none; border-radius: 5px; color: #fff; cursor: pointer; transition: background-color 0.3s ease-in-out;">Home</a>
<br>
    <br>
    <form action="booking.php" method="post">
		<label for="date">Date:</label>
		<input type="date" id="date" name="date" value ="<?php echo "$year-$month-$day" ?>" required><br><br>
		
		<label for="start_time">Start Time:</label>
		<input type="time" id="start_time" name="start_time" required><br><br>
		
		<label for="end_time">End Time:</label>
		<input type="time" id="end_time" name="end_time" required><br><br>
		
		<label for="event_details">Event Details:</label>
		<textarea id="event_details" name="event_details" required></textarea><br><br>
		
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" required><br><br>
		
		
		<label for="password">Common Password:</label>
		<input type="password" id="password" name="password" required><br><br>
		
		<input type="submit" value="Book">
	</form>
</div>

    </body>
    </html>