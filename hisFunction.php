<?php
//require "functionUse.php";
function _Title_for_History()
{
 		echo "<tr><th>His ID</th>"
                ."<th>Res ID</th>"
                ."<th>Check In</th>"
                ."<th>Check Out</th>"
                ."<th>Room</th>"
                ."<th>Guest's Name</th>"
                ."<th>Person</th>"
                ."<th>From</th>"
                ."<th>Status</th>"
                ."<th>PaymentMethod</th>"
                ."<th>Discount</th>"
                ."<th>Paid Amount</th>"
                ."<th>Handler</th>"
                ."<th>Comment</th>"
                ."<th>Days</th>"
                ."</tr>";
}

function _Fill_History_Table_with_Total($inFetch)
{
		$totalAmount = 0; 
           	$colorF =0;
                while($row = mysqli_fetch_assoc($inFetch))
                {
                        echo "<tr bgcolor="._Alt_TR($colorF).">";
                        $colorF = $colorF +1;

                        echo "<td>".$row["ResevHisID"]."</td>"
                        ."<td>".$row["ResevID"]."</td>"
                        ."<td>".$row["HisCheckInDate"]."</td>"
                        ."<td>".$row["HisCheckOutDate"]."</td>"
                        ."<td>".$row["ResevRoom"]."</td>"
                        ."<td>".$row["GuestName"]."</td>"
                        ."<td>".$row["HisNumberOfGuest"]."</td>"
                        ."<td>".$row["ResevFrom"]."</td>"
                        ."<td>".$row["HisStatus"]."</td>"
                        ."<td>".$row["HisPaymentMethod"]."</td>"
                        ."<td>".$row["HisDiscount"]."</td>"
                        ."<td>".$row["HisAmount"]."</td>"
                        ."<td>".$row["EmployeeName"]."</td>"
                        ."<td>".$row["HisComment"]."</td>";

                        echo "<td>";
                        echo _Cal_Day($row["HisCheckInDate"], $row["HisCheckOutDate"]);
                        echo "</td>";

                        echo "</tr>";
			
			$totalAmount = $totalAmount + $row[HisAmount];
                }

	return $totalAmount;
}



?>
