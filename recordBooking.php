<?php
    function generateRefNum() {
        $letters = "";
        // randomly generate 4 uppercase letters
        for ($i = 0; $i < 4; $i++) {
            $rand_letter = chr(rand(65,90));
            $letters = $letters. $rand_letter;
        }
        $ref = $letters. rand(0, 9999); // concatenate the four random uppercase letters with 4 random numbers, this will be the reference number

        return $ref; // return the reference number
    }

    include "./config/connect.inc.php";
    date_default_timezone_set("Pacific/Auckland");

    $name = $_POST["cname"];
    $phone = $_POST["phone"];

    $unit_num = $_POST["unumber"]; // optional
    $street_num = $_POST["snumber"];
    $street_name = $_POST["sname"];
    $suburb = $_POST["sbname"]; // optional

    if (empty($unit_num) && !empty($suburb)){
        $pickup_location = $street_num. " ". $street_name. ", ". $suburb;
    } else if (empty($suburb) && !empty($unit_num)) {
        $pickup_location = "Unit ". $unit_num. ", ". $street_num. " ". $street_name;
    } else if (empty($suburb) && empty($unit_num)) {
        $pickup_location = $street_num. " ". $street_name;
    } else {
        $pickup_location = "Unit ". $unit_num. ", ". $street_num. " ". $street_name. ", ". $suburb;
    }

    if (empty($_POST["dsbname"])) {
        $dest_suburb = NULL;
    } else {
        $dest_suburb = $_POST["dsbname"];
    }

    $pickup_date = $_POST["date"];
    $pickup_time = $_POST["time"];

    $booking_date = date("Y-m-d"); // current date
    $booking_time = date("H:i"); // current time

    $status = "unassigned";

    $ref_number = "";
    $sqlSelect = "SELECT REFERENCE FROM BOOKING WHERE REFERENCE='$ref_number'";

    do { // do while loop to prevent duplicate reference numbers from being entered into the SQL database
        $ref_number = generateRefNum();
        $sqlResult = mysqli_query($dbConn, $sqlSelect);
    } while (mysqli_num_rows($sqlResult)); // if a row is being returned, then generate another reference number


    $ref_number = mysqli_escape_string($dbConn, htmlspecialchars($ref_number));
    $status = mysqli_escape_string($dbConn, htmlspecialchars($status));
    $booking_date = mysqli_escape_string($dbConn, htmlspecialchars($booking_date));
    $booking_time = mysqli_escape_string($dbConn, htmlspecialchars($booking_time));
    $name = mysqli_escape_string($dbConn, htmlspecialchars($name));
    $phone = mysqli_escape_string($dbConn, htmlspecialchars($phone));
    $pickup_location = mysqli_escape_string($dbConn, htmlspecialchars($pickup_location));
    $pickup_date = mysqli_escape_string($dbConn, htmlspecialchars($pickup_date));
    $dest_suburb = mysqli_escape_string($dbConn, htmlspecialchars($dest_suburb));

    $sqlInsert = "INSERT INTO BOOKING (REFERENCE, STATUS, BOOKING_DATE, BOOKING_TIME, NAME, PHONE, PICKUP_LOCATION, PICKUP_DATE, PICKUP_TIME, DESTINATION) VALUES (
        '$ref_number',
        '$status',
        '$booking_date',
        '$booking_time',
        '$name',
        '$phone',
        '$pickup_location',
        '$pickup_date',
        '$pickup_time',
        '$dest_suburb'
    )";

    $sqlResult = mysqli_query($dbConn, $sqlInsert);

    if (!$sqlResult) {
        echo "<p>Error ". mysqli_errno($dbConn). ": ". mysqli_error($dbConn). "</p>";
        exit(0);
    } else {
        mysqli_free_result($sqlResult);
        echo "<div class='confirmation'>";
        echo "<p name='reference'>Thank you! Your booking reference number is <strong>$ref_number</strong>. You will be picked up in front of your provided address at $pickup_time on $pickup_date.</p>";
        echo "</div>";
    }
?>