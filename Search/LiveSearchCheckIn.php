
<?php
    //Use as a live search for GuestName
    session_start();
    require "../configHotel.php";
    //echo "Name".$_SESSION['User'];
    $Rlink = LoginDB($_SESSION['User'],$_SESSION['Pass']);
    mysqli_set_charset($Rlink,"utf8");

    // Escape user inputs for security
    $term = mysqli_real_escape_string($Rlink, $_REQUEST['term']);
    if(isset($term)){
        // Attempt select query execution
        //$sql = "SELECT * FROM GuestTable WHERE GuestName LIKE '" . $term . "%'";
        //$sql = "SELECT * FROM GuestTable WHERE GuestName LIKE '" . $term . "%'";
        
        $sql = "SELECT ReservationID, GuestName, Statue, GuestIDNum, ReservedForGuest, CheckInDate, CheckOutDate
                 FROM ReservationTable, GuestTable 
                 WHERE Statue = 'Check In' 
                 AND GuestIDNum = ReservedForGuest AND GuestName LIKE '".$term."%'";
        
        if($result = mysqli_query($Rlink, $sql))
        {
            if(mysqli_num_rows($result) > 0)
            {

                echo "<table border = 2><tr>"
                    ."<th>ReservationID</th>"
                    ."<th>GuestName</th>"
                    ."<th>CheckInDate</th>"
                    ."<th>CheckOutDate</th>"
                    ."<th>NumberOfGuest</th>"
                    ."</tr>";
                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr><td>".$row['ReservationID']."</td>"
                        ."<td>".$row['GuestName']."</td>"
                        ."<td>".$row['CheckInDate']."</td>"
                        ."<td>".$row['CheckOutDate']."</td>"
                        ."<td>".$row['NumberOfGuest']."</td>"
                        ."</tr>";
                }
                // Close result set
                echo "</table>";
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
