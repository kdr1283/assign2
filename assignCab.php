<?php
    $status = $_POST["status"];
    $ref_num = $_POST["ref"];

    include "./config/connect.inc.php";

    if ($status === "unassigned") {
        $sqlUpdate = "UPDATE BOOKING SET STATUS='assigned' WHERE REFERENCE='$ref_num'";
    } else if ($status === "assigned") {
        $sqlUpdate = "UPDATE BOOKING SET STATUS='unassigned' WHERE REFERENCE='$ref_num'";
    }

    $sqlResult = mysqli_query($dbConn, $sqlUpdate);

    if (!$sqlResult) {
        echo "<p>Error ". mysqli_errno($dbConn). ": ". mysqli_error($dbConn). "</p>";
    } else {
        $sqlSelect = "SELECT STATUS FROM BOOKING WHERE REFERENCE='$ref_num'";
        $sqlResult = mysqli_query($dbConn, $sqlSelect);

        if (!$sqlResult) {
            echo "<p>Error ". mysqli_errno($dbConn). ": ". mysqli_error($dbConn). "</p>";
        } else {
            $row = mysqli_fetch_assoc($sqlResult);
            echo $row["STATUS"];
        }
    }

    mysqli_free_result($sqlResult);
?>