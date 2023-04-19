<?php
// Database connection
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'seminar';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get date parameter
$date = $_GET['date'];

// Query to retrieve booked events for the date
$sql = "SELECT * FROM bookings WHERE booking_date='$date'";
$result = mysqli_query($conn, $sql);

// Fetch the results and store them in an array
$booked_events = array();
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $booked_events[] = array(
        'start_time' => $row['start_time'],
        'end_time' => $row['end_time'],
        'event_name' => $row['event_name'],
        'username' => $row['username']
    );
}

// Return the booked events as a JSON response
echo json_encode($booked_events);

// Close the database connection
mysqli_close($conn);
?>
