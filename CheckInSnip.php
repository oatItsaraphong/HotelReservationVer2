<?php
	session_start();
?>

<html>
<head>
<title>Search All Guest</title>
<meta name="Content-Type" content="text/html; charset=utf8"/>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>


 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<!-- LiveSearch -->
<script type="text/javascript">
$(document).ready(function()
{
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length)
        {
            $.get("Search/LiveSearchReserved.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } 
        else
        {
            resultDropdown.empty();
        }
    });
    // Set search input value on click of result item
    $(document).on("click", ".result p", function()
    {
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>

</head>

<body>
    <div id="wrapper">
        <div class="search-box">
        <input type="text" autocomplete="off" placeholder="Search Guest's Name..." />
        <p>--------------------------------------------</p>
        <div class="result"></div>
        </div>


        <h2> Check In</h2>
        <br>
        <form action="CheckInConfirm.php" method="post">
            <div class='panel panel-success'>
                <div class='panel-heading'> Check In </div>
                <div class='panel-body'>
                    <div class="form-group">
                        <label for="RsvpID">Reservation ID: </label>
                        <input type="number" class="form-control" name="RsvpID" placeholder="ID" required>
                    </div>
                    <input type='submit' class='btn btn-block btn-success' value="Check In">
                </div>
            </div>
        </form>
        <table width=100% height=30 bgcolor="blue"><tr></tr></table>

    </div>
</body>
</html>
