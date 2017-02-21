<html>
<head>
<title>Search All Guest</title>
<meta name="Content-Type" content="text/html; charset=utf8"/>
        <link rel="stylesheet" type="text/css" href="theme.css">

	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="code/sample.js" type="text/javascript"></script>
</head>

<body>
	<div>
		<button class="testMix">LoadPHP</button>
		<h2>--------------------</h2>
		<div class="phpContain"></div>
	</div>
    <div id="wrapper">
        <table width=100% height=30 bgcolor="blue"><tr></tr></table>
        <form>
        <input class="buttonMain" type="button" onClick="window.location.href='index.html'"
                value="Main"/>
        </form>
        <h2> All Guest</h2>
        <br>

	<?php
	header('Content-Type: text/html; charset=utf8');
	require "configHotel.php";
	$link = LoginDB($_POST["feededUser"],$_POST["feededPass"]);
	if($link == 0)
	{
		echo "wrong";
	}
	require "functionUse.php";
	mysqli_set_charset($link,"utf8");
	
	$sql ="SELECT GuestIDNum, GuestName, GuestTel, GuestEmail,
			GuestNumberOfVisit, GuestComment
		FROM GuestTable
		WHERE 1
		ORDER BY GuestName ASC";

	$result = mysqli_query($link,$sql);

	if($result != false)
	{
		$test = mysqli_num_rows($result);
		if($test == 0)
		{
			echo "No Guest";
		}
/*
		echo "<div id= 'SearchForGuest'>";
		echo "<strong>Search For Guest Reservation</strong>";
		echo "<form action='CheckingIn.php' method='post'>";
		echo "Search For Guest: " ;
		echo "<input id='GuestName' list='NameList' name='SelName'>";

		echo "<datalist id='NameList'>";
		foreach($link->query($sql)as $row)
		{
			echo "<option value=".$row[GuestName].">";
		}
		echo "</datalist>";
		echo "<input type='submit'>";
		echo "</form>";
		echo "</div>";
		echo "<br>";
*/
		//echo "<br>Number of Reservation</br>";

		echo "<table border = 2><tr>"
		."<th>Guest ID</th>"
		."<th>Name</th>"
		."<th>Phone Number</th>"
		."<th>Email</th>"
		."<th>Number of visit</th>"
		."<th>Comment</th>"
		."</tr>";

		$color =0;
		while($row = mysqli_fetch_assoc($result))
		{

			echo "<tr bgcolor="._Alt_TR($color).">";
			$color = $color +1;
			
			echo"<td>".$row["GuestIDNum"]."</td>"
			."<td>".$row["GuestName"]."</td>"
			."<td>".$row["GuestTel"]."</td>"
			."<td>".$row["GuestEmail"]."</td>"
			."<td>".$row["GuestNumberOfVisit"]."</td>"
			."<td>".$row["GuestComment"]."</td>";
		}
		echo "</table>";
	}
	else
	{
		echo "Query is Wrong";
	}
	mysqli_close($link);
	?>
        <table width=100% height=30 bgcolor="blue"><tr></tr></table>

</div>
</body>
</html>
