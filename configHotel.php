<?php

function LoginDB ($inUser, $inPass){
	$host = "localhost";
	$database = "HotelDB";

	//Link to SQL
	//$link = mysqli_connect($host, $inUser, $inPass, $database);
	$link = mysqli_connect($host, "root", "toukoSQL", $database);
	if(mysqli_connect_errno())
	{
		echo "Fail to Connect::".msqli_connect_errno();
		echo "<br>";
		return 0;
	}

	//Login to the User Account
	$permit = ExamPassword($inUser, $inPass, $link);
	if($permit == 0)
	{
		echo "Wrong password";
		echo "<br>";
		return 0;
	}

	return $link;
}

function CloseLint($inLink){
	mysqli_close($inLink);
}

//Check if sthe user input is correct or not
function ExamPassword($inUser, $inPass, $inLink){

	
	$sql = "SELECT UserName, Password FROM EmployeeTable WHERE UserName ='$inUser' AND Password = '$inPass'";

	$result = mysqli_query($inLink,$sql);

	if($result == false)
	{
		echo "fail";
		return 0;
	}
	else{

		//if return empty then their is not record on the database
		// therefore not exist / wrong 
		$test = mysqli_num_rows($result);
		if($test == 0)
		{
			echo "Unknow account";
			return 0;
		}
	}
	return 1;
}


?>
