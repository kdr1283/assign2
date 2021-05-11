<?php
    include "./config/connect.inc.php";
    date_default_timezone_set("Pacific/Auckland"); 

    $bsearch = $_POST["bsearch"]; // booking search

    if (empty($bsearch)) { // if the search field is empty, show all booking requests within a certain time
        $dateTime = date("Y-m-d H:i:00"); // get current date and time
        $dateTimePlus2Hours = date("Y-m-d H:i:00", strtotime("+2 hours")); // get date and time 2 hours from now 

        /* 
        concatenate pick-up date and time
        check if pick-up date and time is within two hours from time of search
        by using the two variables initiated above
        */
        $sqlSelect = "SELECT 
        REFERENCE, 
        NAME, 
        PHONE, 
        PICKUP_LOCATION, 
        DESTINATION, 
        CONCAT(PICKUP_DATE, ' ', PICKUP_TIME) AS PICKUP_DATETIME, 
        STATUS 
        FROM BOOKING 
        WHERE STATUS='unassigned' AND
        CONCAT(PICKUP_DATE, ' ', PICKUP_TIME) >= '$dateTime' AND
        CONCAT(PICKUP_DATE, ' ', PICKUP_TIME) <= '$dateTimePlus2Hours'";
    } else { // search field has some form of reference number
        $sqlSelect = "SELECT 
        REFERENCE, 
        NAME, 
        PHONE, 
        PICKUP_LOCATION, 
        DESTINATION, 
        CONCAT(PICKUP_DATE, ' ', PICKUP_TIME) AS PICKUP_DATETIME, 
        STATUS 
        FROM BOOKING 
        WHERE REFERENCE='$bsearch'";
    }

    $sqlResult = mysqli_query($dbConn, $sqlSelect);

    if (!$sqlResult) { // if query failed
        echo "<p>Error ". mysqli_errno($dbConn). ": ". mysqli_error($dbConn). "</p>";
    } else if (mysqli_num_rows($sqlResult)) {
        echo "<table border=\"1\" width=\"100%\">";
        echo "<tr>\n"
            ."<th scope=\"col\">REFERENCE NUMBER</th>\n"
            ."<th scope=\"col\">NAME</th>\n"
            ."<th scope=\"col\">PHONE</th>\n"
            ."<th scope=\"col\">PICK-UP LOCATION</th>\n"
            ."<th scope=\"col\">DESTINATION</th>\n"
            ."<th scope=\"col\">PICK-UP DATE & TIME</th>\n"
            ."<th scope=\"col\">STATUS</th>\n"
            ."<th scope=\"col\">ASSIGN</th>\n"
            ."</tr>\n";

        while ($row = mysqli_fetch_assoc($sqlResult)) {
            $ref = $row["REFERENCE"]; 
            echo "<tr>";
            echo "<td>",$row["REFERENCE"],"</td>";
            echo "<td>",$row["NAME"],"</td>";
            echo "<td>",$row["PHONE"],"</td>";
            echo "<td>",$row["PICKUP_LOCATION"],"</td>";
            echo "<td>",$row["DESTINATION"],"</td>";
            echo "<td>",$row["PICKUP_DATETIME"],"</td>";
            echo "<td id='statusFor$ref'>",$row["STATUS"],"</td>"; // <td> with an id for status changes 
            echo "<td><input type='button' onClick=\"assignCab('assignCab.php', 'statusFor$ref','$ref')\" value='Assign/Unassign'</td>";
            echo "</tr>";
        }
    } else {
        //no booking requests found
        if (empty($bsearch)) {
            echo "<p>No booking requests within pick-up time within 2 hours from time of search found.</p>";
        } else {
            echo "<p>No booking request found with the reference number: \"<strong>$bsearch</strong>\"</p>";
        }
    }

    mysqli_free_result(($sqlResult));
?>