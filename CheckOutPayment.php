<?php
	session_start();
?>
<html>
<head>
<title>Check In Payment Detail</title>
<meta name="Content-Type" content="text/html; charset=utf8"/>
        <link rel="stylesheet" type="text/css" href="theme.css">

 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>

<body>
    <div id="wrapper">
	<h2> Payment Info Check Out </h2>
        <br>

    <?php
    header('Content-Type: text/html; charset=utf8');
    require "configHotel.php";
	require "functionUse.php";
	$link = LoginDB($_SESSION['User'],$_SESSION['Pass']);
	mysqli_set_charset($link,"utf8");

	//$ID =  $_POST['CheckOutID'];
	//$User = $_SESSION['User'];
	//echo $_POST['DiscountInfo'];
	//$Dis = $_POST['DiscountInfo'];
    $_SESSION['OutID'] = $_POST['CheckOutID'];

	//echo $_SESSION["passOn"];


	if($_POST[DiscountInfo] != NULL)
	{
		//retrive employee ID to keep the record
		$sqlName = "SELECT EmployeeID FROM EmployeeTable WHERE UserName = '$_SESSION[User]'";
		$in = mysqli_query($link,$sqlName);

		if($in == false)
		{
			echo "Fail Retriving Name";
			BackToMainBTN();
			exit();
		}
		$row = mysqli_fetch_assoc($in);
		$User = $row['EmployeeID'];


		//update the Discount and Amount needed to pay
		$change = "UPDATE ReservationTable
				SET DiscountPercent = '$_POST[DiscountInfo]',
					HandlerEmployee = '$User'
				WHERE ReservationID = '$_POST[CheckOutID]'";
				//echo $change;
		$qChange = mysqli_query($link,$change);

		if($qChange == false)
		{
			echo "Update Fail";
			BackToMainBTN();
			exit();
		}
	
	}
	else
	{
		echo "Unable to access additional info";
		BackToMainBTN();
		exit();
	}
	
		//Retrive other nessary information such as name and date
        $sql ="SELECT ReservationID, CheckInDate, CheckOutDate, ReservedRoom,
                   GuestName, ReseredFrom , Statue, NumberOfGuest, ReservedComment,
                   PaidAmount, Statue, ReseredFrom, RoomPrice, DiscountPercent,
		   HandlerEmployee, PaymentMethod
                   FROM ReservationTable, GuestTable, RoomTable
                   WHERE   Statue = 'Check In' 
			AND ReservationID = '$_POST[CheckOutID]'
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
				echo "<form action='CheckOutConfirm.php' method='post'>";
				
				echo "<tr><td>Reservation ID</td>"
					. "<td><input id='nameid' name='InfoID' value= ".$row[ReservationID]." disabled></td>"
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
					echo "<tr><td>Discount/Additional</td>"
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

				//calculate number of day spend in the hotel
				$NumDay =  _Cal_Day($row["CheckInDate"], $row["CheckOutDate"]);
				echo $NumDay;
				echo "</td>"
                                   	."<td></td>"
                                        ."</tr>";

				echo "<tr><td>Price</td>"
                                        . "<td>".$row[RoomPrice]."</td>"
                                        ."<td> </td>"
                                        ."</tr>";

                //calculat the price
				$ActualPrice = (($NumDay * $row[RoomPrice]) + $row[DiscountPercent]);
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
                                        . "<td>";
				 //echo "<tr><td>Handler</td>";
                if($row[PaymentMethod] != NULL)
                {
                	echo "<input id='PayName' list='PaymentList' name='PaymentMethod' value=".$row[PaymentMethod].">";
                }
                else
                {
					echo "<input id='PayName' list='PaymentList' name='PaymentMethod'>";

                }

				echo "<datalist id='PaymentList' value=".$row[PaymentMethod]." required>";
				echo "<option value='Unknown'>Unknown</option>"
					."<option value='Cash'>Cash</option>"
					."<option value='Credit Card'>Credit Card</option>"
					."<option value='Internet'>Internet</option>";
				echo "</datalist>";

				echo "</td>"
                        ."<td> </td>"
                        ."</tr>";

				//payment amount
                echo "<tr><td>Pay Amount</td>"
                        . "<td>"."<input type='number' id='PayValue' name='PayValue' value =".$row[PaidAmount].">"."</td>"
                        ."<td></td>"
                        ."</tr>";
				echo "<td><input class='btn btn-block btn-danger' type='Submit' value='Confirm Check Out '></td>"
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
		echo "<br>";
		BackToMainBTN();
        mysqli_close($link);
        ?>

</div>
</body>
</html>             
