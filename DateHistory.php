<?php
	session_start();
?>

<html>
<head>
<title>All infor</title>
<meta name="Content-Type" content="text/html; charset=utf8"/>
       <link rel="stylesheet" type="text/css" href="theme.css">
</head>

<body>
    <div id="wrapper">
        <table width=100% height=30 bgcolor="#555555"><tr></tr></table>
        <form>
        <input class="buttonMain" type="button" onClick="window.location.href='index.html'"
                value="Main"/>
        </form>
        <h2> Reservation Record History</h2>
        <br>

	<?php
	
	header('Content-Type: text/html; charset=utf8');
	require "configHotel.php";

	$link = LoginDB($_SESSION['User'],$_SESSION['Pass']);
	if($link == 0)
	{
		echo "Wrong UserName";
		echo "<a href='index.php' type='button' class='btn-block btn btn-warning'>Back to Login</a>";
		exit();

	}
	//$InDate = date('Y-m-d', strtotime($_SESSION['DateIn']));
	//$OutDate= date('Y-m-d', strtotime($_SESSION['DateOut']));

	require "functionUse.php";
	require "hisFunction.php";
	mysqli_set_charset($link,"utf8");
	
	if($_POST[CDate] != NULL)
	{
		
		$DateType = $_POST[CDate];
		$Min = date('Y-m-d', strtotime($_POST[DateMin]));
		$Max = date('Y-m-d', strtotime($_POST[DateMax]));
		echo "<h3>Between ".$Min." and ".$Max." (inclusive)</h3>";

		$sqlCash ="SELECT *
			FROM ResevHistoryTable, GuestTable, EmployeeTable
			WHERE GuestIDNum = ResevForGuest
				AND HisEmployee = EmployeeID
				AND HisStatus = 'Check Out'
				AND HisPayMentMethod = 'Cash'
				AND ($DateType BETWEEN '$Min' AND '$Max')
			ORDER BY HisStatus";
		$COCashQ = mysqli_query($link,$sqlCash);


		$sqlCredit ="SELECT *
			FROM ResevHistoryTable, GuestTable, EmployeeTable
			WHERE GuestIDNum = ResevForGuest
				AND HisEmployee = EmployeeID
				AND HisStatus = 'Check Out'
				AND HisPayMentMethod = 'Credit Card'
				AND ($DateType BETWEEN '$Min' AND '$Max')
			ORDER BY HisStatus";
		$COCreditQ = mysqli_query($link,$sqlCredit);


		$sqlCancel ="SELECT *
			FROM ResevHistoryTable, GuestTable, EmployeeTable
			WHERE GuestIDNum = ResevForGuest
				AND HisEmployee = EmployeeID
				AND HisStatus = 'Cancel'
				AND ($DateType BETWEEN '$Min' AND '$Max')
			ORDER BY HisStatus";
		$CancelQ = mysqli_query($link,$sqlCancel);

		//=========================
		function DisplaySQL($result, $MethodP)
		{
			if($result != false)
			{
				$test = mysqli_num_rows($result);
				if($test == 0)
				{
					echo "No Reservation";
				}
				echo "There are ".$test." records for <b>".$MethodP. "</b> catagory";
				echo "<table border = 2>";
				_Title_for_History();
				$totalCash = _Fill_History_Table_with_Total($result);
				echo "</table>";
				echo "The total payment for <b>".$MethodP."</b> is <b>".$totalCash."</b>" ;
			}
			else
			{
				echo "Query is Wrong";
			}	
		}//end function

		DisplaySQL($COCashQ,"Cash");
		echo "<br><br><br>";
		DisplaySQL($COCreditQ,"Credit Card");
		echo "<br><br><br>";
		echo "<h4>Cancel Records------------------------</h4>" ;
		DisplaySQL($CancelQ, "None");

	}
	else
	{
		echo "Please Enter Type to use CheckIn or Out";
	}
	mysqli_close($link);
	?>
       <table width=100% height=30 bgcolor="#555555"><tr></tr></table>

</div>
</body>
</html>
