<?php
    session_start();
?>

<html>
<head>
<title>Check Out</title>
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
            $.get("Search/LiveSearchCheckIn.php", {term: inputVal}).done(function(data){
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
        <input type="text" autocomplete="off" placeholder="Search Name..." />
        <p>--------------------------------------------</p>
        <div class="result"></div>
        </div>

        <h2> Check Out</h2>
        <br>

        <form action="CheckOutPayment.php" method="post">
            <div class='panel panel-danger'>
                <div class='panel-heading'> Check Out </div>
                <div class='panel-body'>
                    <div class="form-group">
                        <label for="CheckOutID">ID to Check Out: </label>
                        <input type="number" class="form-control" name="CheckOutID" placeholder="ID" required>
                    </div>
                    <div class="form-group">
                        <label for="DiscountInfo">Discount Or Additional Payment(- to discount/  none to additinal): </label>
                        <input type="number" class="form-control" name="DiscountInfo" placeholder="100/-100" required>
                    </div>
                    <input type='submit' class='btn btn-block btn-danger' value="Check Out">
                </div>
            </div>
        </form>
        <table width=100% height=30 bgcolor="blue"><tr></tr></table>

    </div>
</body>
</html>
