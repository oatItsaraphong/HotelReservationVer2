<?php
    session_start();
?>
<html>
<head>
<title>Send Page</title>
<meta name="Content-Type" content="text/html; charset=utf8"/>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div>

<?php

	//echo $_POST['MsgIDRead'];
	$ID = $_POST['RsvpID'];
	//$link = $_SESSION['Link'];

	require "configHotel.php";

	//check both the server connection and user account authentication
	$link = LoginDB($_SESSION['User'], $_SESSION['Pass']);
	if($link == 0)
	{
		//access
		echo "Unable to establish server connection<br>";
		BackToMainBTN();
		exit();
	}

	mysqli_set_charset($link,"utf8");

	//check if the incoming informaiton is not empty
	if(is_null($ID))
	{
		echo "Missing arguemnt";
		BackToMainBTN();
		exit();
	
	}
	else
	{
		//Retrive the message
		
		$sqlCheck = "UPDATE `ReservationTable` SET `Statue` = 'Check In' WHERE `ReservationID` = '$ID'";
		$checkResult = mysqli_query($link,$sqlCheck);
		
		if($checkResult != false)
		{
	 		 $sql2 ="SELECT ReservationID, CheckInDate, CheckOutDate, ReservedRoom, GuestName, NumberOfGuest, GuestIDNum FROM ReservationTable, GuestTable WHERE ReservationID = '$ID' AND ReservedForGuest = GuestIDNum";

			
			$result = mysqli_query($link, $sql2);
			
			if($result != false)
			{
				$test = mysqli_num_rows($result);
				if($test == 0)
				{
					echo "No Result";
				}
				else if($test > 1)  //catch if there are duplicationin name
				{
					echo "<br>";
					echo "Please Use the ID to search for this reservation";
					//echo $test;
				}
				else 
				{
					$row = mysqli_fetch_assoc($result);
					
					//display all information
					echo "<table>";
					echo "<div id='Testing'>";
					echo "<strong>Reserved Info</strong>";
					echo "<form>";
					
					echo "<tr><td>Reservation ID</td>"
						. "<td>".$row[ReservationID]."</td>"
						. "<td></td>"
						."</tr>";
					
	                echo "<tr><td>Name</td>"
	                        . "<td>".$row[GuestName]."</td>"
	                        ."<td></td>"
	                        ."</tr>";

					echo "<tr><td>Check In</td>"
						. "<td>".$row[CheckInDate]."</td>"
						."<td></td>"
						."</tr>";
					
					echo "<tr><td>Check Out</td>"
						. "<td>".$row[CheckOutDate]."</td>"
						."<td></td>"
						."</tr>";
					
					echo "<tr><td>Room Number</td>"
						. "<td>".$row[ReservedRoom]."</td>"
						."<td></td>"
						."</tr>";
					echo "</div>";
					echo "</form>";
					echo "</table>";
				}//end empty query
			
			} 
			else //if cannot get query
			{
				echo "Updated ";
				BackToMainBTN();
				exit();
				
			}
		}
		else //if cannot update
		{	
			echo "Unable to Update";
			BackToMainBTN();
			exit();
		}
	
	}//end check empty argument

	BackToMainBTN();
?>
	</div>
	<script src="jscode/page.js" type="text/javascript"></script>
</body>
</html>
