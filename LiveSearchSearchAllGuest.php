
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
        $sql = "SELECT * FROM GuestTable WHERE GuestName LIKE '" . $term . "%'".
                "OR GuestTel LIKE '".$term."%'".
                "OR GuestEmail LIKE '".$term."%'";
        
        
        if($result = mysqli_query($Rlink, $sql))
        {
            if(mysqli_num_rows($result) > 0)
            {
                echo "<table border = 2><tr>"
                    ."<th>Guest ID</th>"
                    ."<th>Name</th>"
                    ."<th>Phone Number</th>"
                    ."<th>Email</th>"
                    ."<th>Number of visit</th>"
                    ."<th>Comment</th>"
                    ."</tr>";

                //echo "<table border=1px>";
                while($row = mysqli_fetch_array($result))
                {
                    //echo "<p>" . $row['GuestName']."--".$row['GuestTel']."</p>";
                    echo "<tr><td>".$row['GuestIDNum']."</td>"
                        ."<td>".$row['GuestName']."</td>"
                        ."<td>".$row['GuestTel']."</td>"
                        ."<td>".$row['GuestEmail']."</td>"
                        ."<td>".$row['GuestNumberOfVisit']."</td>"
                        ."<td>".$row['GuestComment']."</td>"
                        ."</tr>";
                }
                echo "</table>";
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
