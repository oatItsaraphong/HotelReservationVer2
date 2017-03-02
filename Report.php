<?php
	session_start();
?>
<html>
<head>
<title>Enter Date for report</title>
<meta name="Content-Type" content="text/html; charset=utf8"/>
       <link rel="stylesheet" type="text/css" href="theme.css">

</head>

<body>
    <div id="wrapper">
        <table width=100% height=30 bgcolor="#555555"><tr></tr></table>
        <form>
        <input class="buttonMain" type="button" onClick="window.location.href='DateHistory.php'"
                value="Main"/>
        </form>

     	<h2> Check Room</h2>
	<br>

<?php
	echo "Enter Update";
	//update the database
	require "configHotel.php";
	$link = LoginDB($_SESSION['User'],$_SESSION['Pass']);
	if($link == 0)
	{
		echo "Wrong UserName";
		echo "<a href='index.php' type='button' class='btn-block btn btn-warning'>Back to Login</a>";
		exit();

	}
	$allIn ="SELECT * FROM ReservationTable WHERE (Statue = 'Check Out' OR Statue = 'Cancel')";
	//echo "enter2";
	$result = mysqli_query($link,$allIn);
	if($result != false)
	{	
		$numEle = mysqli_num_rows($result);
		if($numEle == 0)
		{
			echo "No Update needed";
		}
		else
		{
			while($row = mysqli_fetch_assoc($result))
			{
				echo "There are ".$numEle."element got update<br><br>";
				
				
				$moving ="INSERT INTO ResevHistoryTable (ResevHisID, ResevID, HisCheckInDate, HisCheckOutDate,
					ResevRoom, 
        				ResevForGuest,
       	 				HisNumberOfGuest, ResevFrom, HisPaymentMethod,
					HisStatus, HisDiscount, HisAmount, 
				        HisEmployee, 
				        HisComment)
					VALUES (NULL, '$row[ReservationID]', '$row[CheckInDate]', '$row[CheckOutDate]',
						(SELECT RoomIDNum FROM RoomTable WHERE RoomIDNum = '$row[ReservedRoom]'), 
				            	(SELECT GuestIDNum FROM GuestTable WHERE GuestIDNum = '$row[ReservedForGuest]'), 
					        '$row[NumberOfGuest]', '$row[ReseredFrom]', '$row[PaymentMethod]',
						'$row[Statue]', '$row[DiscountPercent]', '$row[PaidAmount]', 
					        (SELECT EmployeeID FROM EmployeeTable WHERE EmployeeID = '$row[HandlerEmployee]'), 
					        '$row[ReservedComment]')";
				$deleting="DELETE FROM ReservationTable
						WHERE ReservationID = '$row[ReservationID]'";


				$movingQ = mysqli_query($link, $moving);
				if($movingQ != false)
				{
					echo "Moving Successful<br>";
					$deletingQ = mysqli_query($link, $deleting);
					
					if($deletingQ == false)
					{
						echo "Error deleting record<br>";
					}
					echo "Deleting Successful<br>";
				}
				else
				{
					echo "Error moving record<br>.";
				}
			}//end while


		}//end of number of element
	}
	else
	{
		echo "Query to update is wrong";
	}
?>

	<div id= 'CheckingInGuest'>
	<strong>Enter Date</strong>


		<form action='DateHistory.php' method='post'>
		<table>
			<tr>
				<td>Report by</td>
				<td><input type='radio' name='CDate' value='HisCheckInDate'>Check In
				<br><input type='radio' name='CDate' value='HisCheckOutDate'>Check Out</td>		
				<td></td>
			</tr>
			<tr>
				<td>--------</td></tr><tr>
				<td>Start Date</td>
				<td><input type='date' name='DateMin' required></td>
				<td></td>
			</tr>

			<tr>
		        <td>End Date</td>
		        <td><input type='date' name='DateMax' required></td>
		        <td></td>
			</tr>

			<tr>
				<td><input type="submit" value='Report22'></td>
		        <td></td>
		        <td></td>
			</tr>
		</table>

		</form>

	
	</div>
	<br>

       <table width=100% height=30 bgcolor="#555555"><tr></tr></table>

</div>
</body>
</html>
