<?php
    // information and credentials for connecting to the database
    define("host", "cmslamp14.aut.ac.nz");
    define("username", "kdr1283");    
    define("password", "jacenice123"); 
    define("database", "kdr1283");

    // attempt connection to database server (cmslamp14.aut.ac.nz)
	$dbConn = @mysqli_connect
	(   host, 
		username, 
		password 
	) or die("<p>Failed to connect to database server</p>". "<p>Error code ". mysqli_connect_errno(). ": ". mysqli_connect_error(). "</p>");

	// attempt to select database (kdr1283)
	$dbSel = @mysqli_select_db
	(   $dbConn,
		database
	) or die("<p>Failed to connect to selected database</p>". "<p>Error code ". mysqli_errno($dbConn). ": ". mysqli_error($dbConn). "</p>");
?>