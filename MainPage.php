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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
	<div>
	<?php

	$User = 0;
	$Pass = 0;
	//echo $_POST['DateInC'];
	//check to use session or post
	if(!is_null($_POST['feededUser']))
	{
		session_destroy();
		//echo "LogIn 1";
		session_start();
	}

	if(is_null($_SESSION['User']))
	{
		if(is_null($_POST['feededUser']))
		{
			exit("Invalid Access");
		}

		$User = $_POST['feededUser'];
		$Pass = $_POST['feededPass'];

	}
	else
	{
		//echo $_SESSION['User'];
		//echo $_SESSION['Pass'];

		$User = $_SESSION['User'];
		$Pass = $_SESSION['Pass'];
	}

	echo $_SESSION['User'];
	echo $_SESSION['Pass'];

	header('Content-Type: text/html; charset=utf8');
	require "configHotel.php";
	$link = LoginDB($User,$Pass);
	if($link == 0)
	{
		echo "Wrong UserName";
		echo "<a href='index.php' type='button' class='btn-block btn btn-warning'>Back to Login</a>";
		exit();

	}

	require "functionUse.php";
	mysqli_set_charset($link,"utf8");

	$_SESSION["User"] = $User;
	$_SESSION["Pass"] =$Pass;

	$_SESSION["Link"] = $link;


	?>
	</div>

	<div class="col-sm-6 col-md-4 col-lg-3 MainNAV">
		<button type="button" id="AddGuestBTN" class="btn-block fit btn btn-primary">Add Guest</button>
		<button type="button" id="ReservationBTN" class="btn-block btn btn-primary">Reservation</button>
		<button type="button" id="CheckInBTN" class="btn-block btn btn-success">Check In</button>
		<button type="button" id="CheckOutBTN" class="btn-block btn btn-danger">Check Out</button>
		<br>
		<button type="button" id="SearchAllGuestBTN" class="btn-block btn btn-warning">SearchAllGuest</button>


		<?php
			$per = CheckPermission($_SESSION['User'],$_SESSION['Pass'],$link);
			if($per == 22)
			{
				echo "<br><br>";
				echo "<br><button type='button' id='ReportBTN' class='btn-block btn btn-warning'>Report By Date</button>";
			}
		?>
	</div>



	<div class="MainBODY col-sm-6 col-md-8 col-lg-9 "></div>
	<script src="code/sample.js" type="text/javascript"></script>
</body>
</html>
