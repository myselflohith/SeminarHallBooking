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
$id = $_GET['id'];
?>
	<h1>Seminar Hall Booking System</h1>
    <a href="index.php" style="float: right; margin-top: 10px; padding: 10px 20px; font-size: 16px; background-color: #4CAF50; border: none; border-radius: 5px; color: #fff; cursor: pointer; transition: background-color 0.3s ease-in-out;">Home</a>
    <br>
    <br>
    <h1>Confirm Removal of Booking - <?php echo $id; ?></h1>
    <br>
    <form action="remBook.php" method="post">
		
		<label for="password">Common Password:</label>
		<input type="password" id="password" name="password" required><br><br>
		
        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" required>

		<input type="submit" value="Remove Booking">
	</form>
</div>

    </body>
    </html>