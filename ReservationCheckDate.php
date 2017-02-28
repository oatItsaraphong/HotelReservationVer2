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
            $.get("Search/LiveSearchSearchAllGuest.php", {term: inputVal}).done(function(data){
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
    $(document).on("click", ".resultRoom p", function()
    {
        $(this).parents(".search-date").find('input[type="text"]').val($(this).text());
        $(this).parent(".resultRoom").empty();
    });
});
</script>

</head>

<body>
    <div id="wrapper">
        <h2>Search For Guest ID</h2>
        <div class="search-box">
        <input type="text" autocomplete="off" placeholder="Search Name..." />
        <p>--------------------------------------------</p>
        <div class="result"></div>
        </div>
        <p>--------------------------------------------</p>

        <h2>Make Reservation</h2>
        <br>
        <form action="RoomReservation.php" method="post">
            <div class='panel panel-success'>
                <div class='panel-heading'> Check Date </div>
                <div class='panel-body'>
                    <div class="form-group">
                        <label for="GuestDate">Guest ID </label>
                        <input type="number" class="form-control" name="GuestDateC" placeholder="ID" required>
                    </div>
                    <div class="form-group">
                        <label for="CheckInDate">Check In From: </label>
                        <input type="date" class="form-control" name="DateInC" placeholder="mm/dd/yyyy" required>
                    </div>
                    <div class="form-group">
                        <label for="CheckOutDate">Check Out From: </label>
                        <input type="date" class="form-control" name="DateOutC" placeholder="mm/dd/yyyy" required>
                    </div>
                    <div class="form-group">
                        <label for="NumCustomer">Number of Guests: </label>
                        <input type="Number" class="form-control" name="NumCustomer" placeholder="....." required>
                    </div>
                    <div class="form-group">
                        <label for="FromInfo">Reservation From: </label>
                        <input type="text" class="form-control" name="FromInfo" placeholder="....." >
                    </div>
                    <div class="form-group">
                        <label for="Additional">Comment: </label>
                        <input type="text" class="form-control" name="Additional" placeholder="....." >
                    </div>
                    <input type='submit' value="Next" class="checkRoom">
                </div>
            </div>
        </form>


        <table width=100% height=30 bgcolor="blue"><tr></tr></table>

    </div>
        <script src="code/sample.js" type="text/javascript"></script>
</body>
</html>
