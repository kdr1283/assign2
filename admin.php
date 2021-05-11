<html>
    <head>
        <title>Cabs Online</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>" type="text/css">
        <script type="text/javascript" src="administration.js"> </script>
        <script type="text/javascript" src="xhr.js"> </script>
    </head>
    <div class="content">
        <body>
            <h1>Administration Page</h1>
            <form>
                <label for="bsearch">Search bookings: <input type="text" id="bsearch" name="bsearch"></label>
                <br><input type="button" onClick="getBooking('displayPickupRequests.php', 'requests', bsearch.value)" name="sbutton" value="Search">
            </form>
            <div id="requests">
                
            </div>
            <br><a href="http://kdr1283.cmslamp14.aut.ac.nz/assign2/index.html">Return to Home Page</a>
        </body>
    </div>
</html>