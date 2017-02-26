
<?php
    session_start();
?>
<html>
<head>
<title>Guest Added</title>
<meta name="Content-Type" content="text/html; charset=utf8"/>

        <link rel="stylesheet" type="text/css" href="theme.css">

</head>

<body>

    <div id="wrapper">

    <h2> Guest Added</h2>
    <br>

	<?php
	header('Content-Type: text/html; charset=utf8');
	require "configHotel.php";
    $link = LoginDB($_SESSION['User'],$_SESSION['Pass']);
    mysqli_set_charset($link,"utf8");

    //check Iput data if no NULL
	if (($_POST["GName"]!=NULL) 
		&&(($_POST["GTel"]!=NULL) || ($_POST["GEmail"])))
	{
        //Add to DB
		$insertQ ="INSERT INTO GuestTable (GuestIDNum, GuestName, GuestTel, GuestEmail, GuestNumberOfVisit, GuestComment) 
				VALUES (NULL,'$_POST[GName]','$_POST[GTel]','$_POST[GEmail]',0, '$_POST[GComment]' )";
		if(mysqli_query($link,$insertQ))
		{
			echo "<br><h2>Inserted</h2>". "<br>";
		}
		else
		{
			echo "Error Inserted". mysqli_error(). "<br>". "<br>";
            BackToMainBTN();
            exit();
		}
	}	
	else
	{
		echo "<font color='red'><h2>Insert Error !!!!!</h2></font>";
	}
		
        $sql ="SELECT GuestIDNum, GuestName, GuestTel, GuestEmail,
                        GuestNumberOfVisit, GuestComment
                FROM GuestTable
                WHERE GuestName = '$_POST[GName]'";

        $result = mysqli_query($link,$sql);

        if($result != false)
        {
                $test = mysqli_num_rows($result);
                if($test == 0)
                {
                        echo "No Guest";
                        BackToMainBTN();
                        exit();
                }
	
        		echo "<table border = 2><tr>"
                        ."<th>Guest ID</th>"
                        ."<th>Name</th>"
                        ."<th>Phone Number</th>"
                        ."<th>Email</th>"
                        ."<th>Number of visit</th>"
                        ."<th>Comment</th>"
                        ."</tr>";

                        while($row = mysqli_fetch_assoc($result))
                        {
                                echo "<tr>"
                                ."<td>".$row["GuestIDNum"]."</td>"
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
        BackToMainBTN();
        exit();
	}
    BackToMainBTN();
	mysqli_close($link);
	?>

    </div>

</body>
</html>
