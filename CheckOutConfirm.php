<?php
	session_start();
?>
<html>
<head>
<title>Check Out Confirmation</title>
<meta name="Content-Type" content="text/html; charset=utf8"/>
        <link rel="stylesheet" type="text/css" href="theme.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>

    <div id="wrapper">
	<h2> Confirmation Page with Payment At Check Out</h2>
	<br>
    <?php
    header('Content-Type: text/html; charset=utf8');
    require "configHotel.php";
	require "functionUse.php";

    $link = LoginDB($_SESSION['User'],$_SESSION['Pass']);
	mysqli_set_charset($link,"utf8");

	//query to check if the payment is suffice
    $check ="SELECT ReservationID, CheckInDate, CheckOutDate, ReservedRoom,
               GuestName,  Statue, NumberOfGuest, PaidAmount,  ReseredFrom, RoomPrice, DiscountPercent,
               PaymentMethod
               FROM ReservationTable, GuestTable, RoomTable
               WHERE   Statue = 'Check In'
                    AND ReservationID = '$_SESSION[OutID]'
                    AND GuestIDNum  = ReservedForGuest
                    AND ReservedRoom = RoomIDNum ";
	
	$forcheck = mysqli_query($link,$check);
	//check payment query
	if($forcheck == fail)
	{
		echo "Query for Check Fail";
		BackToMainBTN();
		exit();
	}

	$temp = mysqli_fetch_assoc($forcheck);
	
	//calculate the price for the night
	$NumDayPay =  _Cal_Day($temp["CheckInDate"], $temp["CheckOutDate"]);
	$PriceCom = (($NumDayPay * $temp[RoomPrice]) + $temp[DiscountPercent]);
	echo $_POST[PayValue];


	if(($PriceCom <= $_POST[PayValue])&&($_POST[PaymentMethod] != NULL) )
	{//check if paid

		//echo $_SESSION["passOn"];
		//echo $_POST[PaymentMethod];
		if($_POST[PayValue] != NULL)
		{
			$change = "UPDATE ReservationTable
					SET PaidAmount = '$_POST[PayValue]'
					, PaymentMethod = '$_POST[PaymentMethod]'
					, Statue = 'Check Out'
					WHERE ReservationID = '$_SESSION[OutID]'";
			$qChange = mysqli_query($link,$change);

			if($qChange == false)
			{
				echo "Update Fail";
				BackToMainBTN();
				exit();
			}
		}
		
		//-- handle when Use ResevationID For search
			//echo    $_POST[SelID];
	        $sql ="SELECT ReservationID, CheckInDate, CheckOutDate, ReservedRoom,
	                   GuestName, ReseredFrom , Statue, NumberOfGuest, ReservedComment,
	                   PaidAmount, Statue, ReseredFrom, RoomPrice, DiscountPercent,
			   PaymentMethod
	                   FROM ReservationTable, GuestTable, RoomTable
	                   WHERE   Statue = 'Check Out'
				AND ReservationID = '$_SESSION[OutID]'
				AND GuestIDNum  = ReservedForGuest 
				AND ReservedRoom = RoomIDNum ";

			
		$result = mysqli_query($link, $sql);
			
			if($result != false)
			{
				$test = mysqli_num_rows($result);
				if($test == 0)
				{
					echo "No Result";
					BackToMainBTN();
					exit();
				}
				else if($test > 1)  //catch if there are duplicationin name
				{
					echo "<br>";
					echo "Please Use the ID to search for this reservation";
					BackToMainBTN();
					exit();
					//echo $test;
				}
				else 
				{
					$row = mysqli_fetch_assoc($result);
		
					//display all information
					echo "<table>";
					echo "<div id='Testing'>";
					echo "<strong>Guest Resevation Info</strong>";
					echo "<form  method='post'>";
					
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
						
					echo "<tr><td>Number of Guest</td>"
						. "<td>".$row[NumberOfGuest]."</td>"
						."<td></td>"
						."</tr>";

					//$date1 = date_create($row[CheckInDate]);
					//$date2 = date_create($row[CheckOutDate]);
					//$diff = date_diff($date1,$date2);
					echo "<tr><td><br> </td>"
	                                        . "<td></td>"
	                                        ."<td> </td>"
	                                        ."</tr>";

					 echo "<tr><td>Reserved From</td>"
	                                        . "<td>".$row[ReservedFrom]."</td>"
	                                        ."<td></td>"
	                                        ."</tr>";
					 echo "<tr><td>Status</td>"
	                                        . "<td>".$row[Statue]."</td>"
	                                        ."<td></td>"
	                                        ."</tr>";
			
					echo "<tr><td>Paid</td>"
	                                        . "<td>".$row[PaidAmount]."</td>"
	                                        ."<td></td>"
	                                        ."</tr>";

	                                if($row[DiscountPercent] != 0)
	                                {
	                                        echo "<tr><td>Discount</td>"
	                                                . "<td>".$row[DiscountPercent]."</td>"
	                                                ."<td></td>"
	                                                ."</tr>";
	                                }

					 echo "<tr><td>Comment</td>"
	                                        . "<td>".$row[ReservedComment]."</td>"
	                                        ."<td></td>"
	                                        ."</tr>";

					echo "<tr><td><br> </td>"
	                                        . "<td></td>"
	                                        ."<td> </td>"
	                                        ."</tr>";

					echo "<tr><td>Number Day</td>"
						."<td>";
					$NumDay =  _Cal_Day($row["CheckInDate"], $row["CheckOutDate"]);
					echo $NumDay;
					echo "</td>"
	                                   	."<td></td>"
	                                        ."</tr>";

					echo "<tr><td>Price</td>"
	                                        . "<td>".$row[RoomPrice]."</td>"
	                                        ."<td> </td>"
	                                        ."</tr>";
					$ActualPrice = (($NumDay * $row[RoomPrice])* ( 100 - $row[DiscountPercent]) ) /100;
					echo "<tr><td>Total Price</td>"
	                                        . "<td>".$ActualPrice."</td>"
	                                        ."<td> </td>"
	                                        ."</tr>";

	                                echo "<tr><td><br></td>"
	                                        . "<td></td>"
	                                        ."<td> </td>"
	                                        ."</tr>";

					//Payment method list
				 	echo "<tr><td>Payment Method</td>"
	                                        . "<td>".$row[PaymentMethod]."</td>"
	                                        ."<td> </td>"
	                                        ."</tr>";

					//payment amount
	                                echo "<tr><td>Pay Amount</td>"
	                                        . "<td>$row[PaidAmount]</td>"
	                                        ."<td></td>"
	                                        ."</tr>";

					echo "</div>";
					echo "</form>";
					echo "</table>";
				}
				
			} 
			else
			{
				echo "Query is Wrong";
				BackToMainBTN();
				exit();
				
			}

	}//end check for paid
	else
	{
		echo "Need payment before check out <br> Go back to the first page"; 
		BackToMainBTN();
		exit();
	}

	//session_destroy();
    mysqli_close($link);
    BackToMainBTN();

    ?>
<script>
function PrintFunction()
{
	window.print();
}

</script>

</div>
</body>
</html>             
