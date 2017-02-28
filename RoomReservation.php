<?php
	session_start();
?>

<html>
<head>
<title>Make Reservation</title>
<meta name="Content-Type" content="text/html; charset=utf8"/>

        <link rel="stylesheet" type="text/css" href="theme.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
    <div id="wrapper">

	<h2> Making Reservation</h2>
	<br>

<?php
	require "configHotel.php";

	//echo $_SESSION['User'];
	if((is_null($_POST['DateInC'])) 
		|| (is_null($_POST['DateOutC'])) 
		|| (is_null($_POST['GuestDateC'])))
	{
		BackToMainBTN();
		exit("Invalid Access");
	}

	header('Content-Type: text/html; charset=utf8');

	
    //echo "Name".$_SESSION['User'];
    $link = LoginDB($_SESSION['User'],$_SESSION['Pass']);
    mysqli_set_charset($Rlink,"utf8");

    $_SESSION['ID'] = $_POST['GuestDateC'];
	$_SESSION['DateIn'] = $_POST['DateInC'];
	$_SESSION['DateOut'] = $_POST['DateOutC'];
	$_SESSION['NumCus'] = $_POST['NumCustomer'];
	$_SESSION['FromInfo'] = $_POST['FromInfo'];
	$_SESSION['Additional'] = $_POST['Additional'];

    $ID = $_SESSION['ID'];
    $InDate = date('Y-m-d', strtotime($_SESSION['DateIn']));
	$OutDate= date('Y-m-d', strtotime($_SESSION['DateOut']));
	
	$sql=	"SELECT RoomIDNum, NumberOfBed, Type
		FROM RoomTable
		WHERE RoomStatus = 'Good' AND RoomIDNum NOT IN (SELECT DISTINCT ReservedRoom 
        	FROM ReservationTable
        		WHERE 	((
                	(CheckInDate BETWEEN '$InDate' AND '$OutDate')
                	OR (CheckOutDate BETWEEN '$InDate' AND '$OutDate')
                	)
                	OR (
                   	(CheckInDate < '$InDate')
                    	AND (CheckOutDate > '$OutDate')
                   	))
                	AND (
                    	(CheckOutDate <> '$InDate')
                    	AND (CheckInDate <> '$OutDate')
                    	))";

	$result = mysqli_query($link,$sql);

	if($result != false)
	{
		$test = mysqli_num_rows($result);
		if($test == 0)
		{
			echo "No Room Free";
		}
		else
		{
		

		//search with name
		echo "<div id= 'CheckingInGuest'>";
		echo "<strong>Roome Free</strong><br><br>";

		echo "There are <b>". $test."</b> rooms free <br><br>";

		echo "<b>From: &nbsp</b>";
		echo $InDate."<br><br>";
		echo "<b>To:  &nbsp</b>";
		echo $OutDate."<br><br>";

		echo "<table>";
		
		echo "<form action='ExeRoomReservation.php' method='post'>";
		
		//Name 
		echo "<tr><td>";
		echo "Room Avaliable: </td>" ;
		echo "<td>";
		//echo "<input id='GuestName' list='NameList' name='RoomNumAv' required>";

		//can be change to use datalist
		echo "<select id='NameList' name='RoomNumAv'>";
		foreach($link->query($sql)as $row)
		{
			echo "<option value=".$row[RoomIDNum].">"
				.$row[RoomIDNum]." - "
				.$row[NumberOfBed]. " Bed - "
				.$row[Type]."</option>";
		}
		echo "</select>";
		echo "</td>";
		echo "<td><button type='submit'>Choose Room</input></td>";
		echo "</tr>";
	
		echo "</form>";

		echo "</table>";

		echo "</div>";
		echo "<br>";

		}//else if there is no room
	
	}
	else
	{
		echo "Query is Wrong";
	}
	mysqli_close($link);
	BackToMainBTN();
	?>

</div>

</body>
</html>
