<?php
	session_start();
?>
<html>
<head>
<title>Check In Confirmation</title>
<meta name="Content-Type" content="text/html; charset=utf8"/>

        <link rel="stylesheet" type="text/css" href="theme.css">

</head>

<body>
     <div id="wrapper"> 

	<h2> Confirmation Reservation</h2>
	<br>
    <?php
        header('Content-Type: text/html; charset=utf8');
    require "configHotel.php";
	require "functionUse.php";

	$link = LoginDB($_SESSION['User'],$_SESSION['Pass']);
    mysqli_set_charset($link,"utf8");


	$_SESSION["Room"] = $_POST['RoomNumAv'];

	$New = 0;
	
	$DateIn = $_SESSION['DateIn'];
	$DateOut = $_SESSION['DateOut'];
	
	$Room = $_SESSION['Room'];
	$ID = $_SESSION['ID'];
	$NumCus = $_SESSION['NumCus'];

	$FromInfo = $_SESSION['FromInfo'];
	$User = $_SESSION['User'];
	$Add = $_SESSION['Additional'];

	echo $ID;

	$MoIn = date('Y-m-d', strtotime($_SESSION['DateIn']));
	$MoOut = date('Y-m-d', strtotime($_SESSION['DateOut']));

	//echo $_POST[PaymentMethod];
	if($_SESSION['User'] != NULL)
	{
		$EmID = "SELECT UserName, EmployeeID FROM `EmployeeTable` WHERE UserName = '$User'";
		$result1 = mysqli_query($link,$EmID);
		if($result1 == false)
		{
			echo "Permission Deny 1";
			BackToMainBTN();
			exit();
		}
		else
		{
			$test = mysqli_num_rows($result1);
			if($test == 1)
			{
				$row = mysqli_fetch_assoc($result1);
				$New = $row['EmployeeID'];
			}
			else
			{
				echo "Permission Deny 2";
				BackToMainBTN();
				exit();
			}


		}

		echo "Enter insert";
		/*
		$change = "INSERT INTO `ReservationTable` (`ReservationID`, `CheckInDate`, `CheckOutDate`, `ReservedRoom`, `ReservedForGuest`, `NumberOfGuest`, `ReseredFrom`, `PaymentMethod`, `Statue`, `PaidAmount`, `DiscountPercent`, `HandlerEmployee`, `ReservedComment`) VALUES (NULL, '$MoIn', '$MoOut', '201', '$ID', '$NumCus', '$FromInfo', 'None', 'Reserved', '0', '0', '1122', '$Add')";
		*/
		
		$change ="INSERT INTO `ReservationTable` (`ReservationID`, `CheckInDate`, `CheckOutDate`, `ReservedRoom`, `ReservedForGuest`, `NumberOfGuest`, `ReseredFrom`, `PaymentMethod`, `Statue`, `PaidAmount`, `DiscountPercent`, `HandlerEmployee`, `ReservedComment`) VALUES (NULL, '$MoIn', '$MoOut', '$Room', '$ID', '$NumCus', '$FromInfo', 'None', 'Reserved', '0', '0', '$New', '$Add')";
		
		$qChange = mysqli_query($link,$change);

		if($qChange == false)
		{
			echo "Update Fail<br>";
			echo "Please Check the GuestID or other input <br>";
			BackToMainBTN();
			exit();
		}

	}
	else
	{
		echo "Invalid Access";
		BackToMainBTN();
		exit();
	}
	
	//-- handle when Use ResevationID For search
		//echo    $_POST[SelID];
    $sql ="SELECT ReservationID, CheckInDate, CheckOutDate, ReservedRoom, GuestName, 
		ReseredFrom , Statue, NumberOfGuest, ReservedComment PaidAmount, Statue,
		ReseredFrom, RoomPrice, DiscountPercent, PaymentMethod 
		FROM ReservationTable, GuestTable, RoomTable 
		WHERE GuestIDnum = ReservedForGuest
		AND ReservedRoom = RoomIDNum 
		AND ReservationID = (SELECT max(ReservationID) 
					FROM ReservationTable 
					WHERE Statue = 'Reserved') ";

		
		$result = mysqli_query($link, $sql);
		
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
				
				//even when use two submit button to go to the same page
				// the submit will only send what is within the form
				//==for test
				//echo $_POST[SelName];
				//echo $_POST[SelID];

				

	
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
                                        . "<td><u>".$ActualPrice."</u></td>"
                                        ."<td> </td>"
                                        ."</tr>";
/*
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
                                        . "<td><u>$row[PaidAmount]</u></td>"
                                        ."<td></td>"
                                        ."</tr>";
*/
				echo "</div>";
				echo "</form>";
				echo "</table>";
/*			        echo "<form>";
        			echo "<input type='submit' formtarget='_blank' onClick='window.location.href='PrintPage.php''
                			value='Printing'/>";

        			echo "</form>";
*/
			}//end empty query
			
		} 
		else
		{
			echo "Query is Wrong";
			BackToMainBTN();
			exit();
			
		}
	
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
