<!DOCTYPE html>
<html>
<head>

	<title>Seminar Hall Booking</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<style>
	    form input[type="password"] {
	width: 100%;
	padding: 10px;
	font-size: 16px;
	border: none;
	border-radius: 5px;
	background-color: #f2f2f2;
	color: #333;
}


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
.form-popup-bg {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  display: flex;
  flex-direction: column;
  align-content: center;
  justify-content: center;
}
.form-popup-bg {
  position: fixed;
  left: 0;
  top: 0;
  height: 100%;
  width: 100%;
  background-color: rgba(94, 110, 141, 0.9);
  opacity: 0;
  visibility: hidden;
  -webkit-transition: opacity 0.3s 0s, visibility 0s 0.3s;
  -moz-transition: opacity 0.3s 0s, visibility 0s 0.3s;
  transition: opacity 0.3s 0s, visibility 0s 0.3s;
  overflow-y: auto;
  z-index: 10000;
}
.form-popup-bg.is-visible {
  opacity: 1;
  visibility: visible;
  -webkit-transition: opacity 0.3s 0s, visibility 0s 0s;
  -moz-transition: opacity 0.3s 0s, visibility 0s 0s;
  transition: opacity 0.3s 0s, visibility 0s 0s;
}
.form-container {
  background-color: #2d3638;
  border-radius: 10px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
  display: flex;
  flex-direction: column;
  width: 100%;
  max-width: 700px;
  margin-left: auto;
  margin-right: auto;
  position: relative;
  padding: 40px;
  color: #fff;
}
.close-button {
  background: none;
  color: #fff;
  width: 40px;
  height: 40px;
  position: absolute;
  top: 0;
  right: 0;
  border: solid 1px #fff;
}
.form-popup-bg:before {
  content: '';
  background-color: #fff;
  opacity: 0.25;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}
.form-group {
    margin-bottom: 1rem;
}
.form-control {
    display: block;
    width: 100%;
    padding: 0.5rem 0.75rem;
    font-size: 1rem;
    line-height: 1.25;
    color: #464a4c;
    background-color: #fff;
    background-image: none;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 0.25rem;
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
}
	</style>
	
</head>
<body>
	<div class="container">
<?php
			// Connect to the database

			$host = 'localhost';
			$user = 'root';
			$pass = '';
			$dbname = 'seminar';
      
			$conn = mysqli_connect($host, $user, $pass, $dbname);
$current_year = isset($_POST['current_year']) ? mysqli_real_escape_string($conn,$_POST['current_year']) : date('Y');
$current_month = isset($_POST['current_month']) ? mysqli_real_escape_string($conn,$_POST['current_month']) : date('m');
?>
	<h1>Seminar Hall Booking</h1>
  <form action="index.php" method="post">
        <label for="current_month">Month:</label>
        <select id="current_month" name="current_month">
          <option value="" selected>SELECT</option>
          <option value=1>January</option>
          <option value=2>February</option>
          <option value=3>March</option>
          <option value=4>April</option>
          <option value=5>May</option>
          <option value=6>June</option>
          <option value=7>July</option>
          <option value=8>August</option>
          <option value=9>September</option>
          <option value=10>October</option>
          <option value=11>November</option>
          <option value=12>December</option>
        </select>

        <input type="number" name="current_year" min=2023 max="<?php echo (date('Y')+1); ?>" step="1" value=<?php echo date('Y'); ?> />

        <input type="submit" value="Check">

    <br><br>  
  </form>
	<?php 
		$details = isset($_GET['details']) ? $_GET['details'] : '';
		$status = isset($_GET['status']) ? $_GET['status'] : '';
		$error = isset($_GET['error']) ? $_GET['error'] : '';
		if($status=="booked") {
			echo "<h1 style=\"color:red;\">The slot has already been booked for</h1>";
		}
		if($details!="") {
		    echo "<h2 style=\"padding: 5px;background: #dddddd;margin-top: 0;text-align: center;\">$details</h2>";
		}
		if($error!="") {
		    echo "<h2 style=\"padding: 5px;background: #dddddd;margin-top: 0;text-align: center; color: red;\">$error</h2>";
		}
	?>


	<div class="calendar">
			<?php
// Get the current year and month



// Get the number of days in the current month
$days_in_month = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);

// Get the events for the current month
$query = "SELECT * FROM bookings WHERE MONTH(date) = $current_month AND YEAR(date) = $current_year";
$result = mysqli_query($conn, $query);

// Create an array of booked dates
$booked_dates = array();
$booked_events = array();
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$booked_date = date('j', strtotime($row['date']));
		$id = $row['id'];
		$booked_dates[] = $booked_date;
		//modded line
		$booked_events[$booked_date][$id] = $row;
	}
}

// Display the calendar table
echo "<center><h3><span style=\"color: #808080;\">$current_month-$current_year</span></h3></center>";
echo '<table>';
echo '<thead>';
echo '<tr>';
echo '<th>Sun</th>';
echo '<th>Mon</th>';
echo '<th>Tue</th>';
echo '<th>Wed</th>';
echo '<th>Thu</th>';
echo '<th>Fri</th>';
echo '<th>Sat</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

// Print the first row of the calendar table
echo '<tr>';
$day_counter = 1;
for ($i = 0; $i < 7; $i++) {
	if ($i < date('w', mktime(0, 0, 0, $current_month, 1, $current_year))) {
		echo '<td></td>';
	} else {
		$class = in_array($day_counter, $booked_dates) ? 'booked' : '';
		echo '<td class="' . $class . '" data-date="' . $day_counter . '">' . $day_counter . '<br><a href="bookit.php?day=' . $day_counter . '&month=' . $current_month . '&year=' . $current_year . '"><button>Book</button></a></td>';
		$day_counter++;
	}
}
echo '</tr>';

// Print the remaining rows of the calendar table
while ($day_counter <= $days_in_month) {
	echo '<tr>';
	for ($i = 0; $i < 7; $i++) {
		if ($day_counter <= $days_in_month) {
			$class = in_array($day_counter, $booked_dates) ? 'booked' : '';
			echo '<td class="' . $class . '" data-date="' . $day_counter . '">' . $day_counter . '<br><a href="bookit.php?day=' . $day_counter . '&month=' . $current_month . '&year=' . $current_year . '"><button>Book</button></a></td>';
			$day_counter++;
		} else {
			echo '<td></td>';
		}
	}
	echo '</tr>';
}

echo '</tbody>';
echo '</table>';

// Close the database connection
mysqli_close($conn);
?>

<!-- HTML for pop-up window -->
<div id="popup" style="display:none;">
  <div id="popup-content">
    <h2>Booked Times</h2>
    <ul id="times-list">
    </ul>
    <button id="close-popup">Close</button>
  </div>
</div>


<!-- CSS for pop-up window -->
<style>
.popup {
display: none;
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: rgba(0, 0, 0, 0.5);
z-index: 9999;
}

#popup-content {
position: fixed;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
background-color: white;
padding: 20px;
border-radius: 5px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}


#close-popup {
margin-top: 10px;
}

.booked {
background-color: red;
color: white;
cursor: pointer;
}
</style>

<!-- JavaScript for pop-up window -->
<script>

// Get the pop-up window and close button elements
var popup = document.getElementById('popup');
var popupContent = document.getElementById('popup-content');
var timesList = document.getElementById('times-list');
var closePopup = document.getElementById('close-popup');

// Add event listeners to all calendar cells
var calendarCells = document.querySelectorAll('.calendar td');
for (var i = 0; i < calendarCells.length; i++) {
    var cell = calendarCells[i];
    if (cell.classList.contains('booked')) {
        // Add click event listener to booked calendar cells
        cell.addEventListener('click', function () {
            // Get the booked date from the data attribute
            var bookedDate = this.getAttribute('data-date');

            // Get the start and end times of all booked events for the date
            var events = <?php echo json_encode($booked_events); ?>;
            console.log(events)
			console.log(bookedDate);
            var eventTimesHtml = '';
			//modded line
            for (const event of Object.values(events[bookedDate])) {
						let eventStart = event.start_time.slice(0,-3);
						let eventEnd = event.end_time.slice(0,-3);
						eventTimesHtml += `Start Time: ${eventStart} - End Time: ${eventEnd} | Detail - ${event.event_details}    <a href="removeBooking.php?id=${event.id}" style="padding:2px; background: #808080; color: #fff; float: right;">✘</a><br><hr>`;
					
            }

	

            // Populate the pop-up window with the start and end times
            timesList.innerHTML = eventTimesHtml;

            // Show the pop-up window
            popup.style.display = 'block';
        });
    } else {
        // Add hover event listener to available calendar cells
        cell.addEventListener('mouseover', function () {
            this.style.backgroundColor = '#ddd';
        });
        cell.addEventListener('mouseout', function () {
            this.style.backgroundColor = '';
        });
    }
}

// Add event listener to close button
closePopup.addEventListener('click', function () {
    // Hide the pop-up window
    popup.style.display = 'none';
});


</script>
</div>
</div>
</body>
</html>
