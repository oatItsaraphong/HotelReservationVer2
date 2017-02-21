<?php
session_start();
?>

<html>
<head>
<title>BaseHotel</title>
<meta name="Content-Type" content="text/html; charset=utf8"/>
<link rel="stylesheet" type="text/css" href="theme.css">
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>


 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
	<div>
	<?php
	echo $_POST["feededUser"];
	echo $_POST["feededPass"];

	header('Content-Type: text/html; charset=utf8');
	require "configHotel.php";
	$link = LoginDB($_POST["feededUser"],$_POST["feededPass"]);
	if($link == 0)
	{
		echo "wrong";
	}
	require "functionUse.php";
	mysqli_set_charset($link,"utf8");

	$_SESSION["User"] = $_POST["feededUser"];
	$_SESSION["Pass"] = $_POST["feededPass"];

	$_SESSION["Link"] = $link;
	?>
	</div>

	<div class="col-sm-6 col-md-4 col-lg-3 MainNAV">
		<button type="button" id="AddGuestBTN" class="btn-block fit btn btn-primary">Add Guest</button>
		<button type="button" id="ReservationBTN" class="btn-block btn btn-primary">Reservation</button>
		<button type="button" id="CheckInBTN" class="btn-block btn btn-primary">Check In</button>
		<button type="button" id="CheckOutBTN" class="btn-block btn btn-warning">Check Out</button>
		<br>
		<button type="button" id="SearchAllGuestBTN" class="btn-block btn btn-warning">SearchAllGuest</button>
	</div>

	<div class="MainBODY col-sm-6 col-md-8 col-lg-9 "></div>
	<script src="code/sample.js" type="text/javascript"></script>
</body>
</html>
