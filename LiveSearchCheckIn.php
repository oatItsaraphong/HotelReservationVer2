
<?php
    //Use as a live search for GuestName

    require "configHotel.php";
    $Rlink = LoginDB($_POST["feededUser"],$_POST["feededPass"]);
    mysqli_set_charset($Rlink,"utf8");

    // Escape user inputs for security
    $term = mysqli_real_escape_string($Rlink, $_REQUEST['term']);
    if(isset($term)){
        // Attempt select query execution
        //$sql = "SELECT * FROM GuestTable WHERE GuestName LIKE '" . $term . "%'";
        //$sql = "SELECT * FROM GuestTable WHERE GuestName LIKE '" . $term . "%'";
        
        $sql = "SELECT ReservationID, GuestName, Statue, GuestIDNum, ReservedForGuest
                 FROM ReservationTable, GuestTable 
                 WHERE Statue = 'Check In' 
                 AND GuestIDNum = ReservedForGuest AND GuestName LIKE '".$term."%'";
        
        if($result = mysqli_query($Rlink, $sql))
        {
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
                    echo "<p>" . $row['GuestName'] ."---".$row['ReservationID']."</p>";
                }
                // Close result set
                mysqli_free_result($result);
            } 
            else
            {
                echo "<p>No matches found</p>";
            }
        } 
        else
        {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($Rlink);
        }
    }

    // close connection
    mysqli_close($link);
?>
