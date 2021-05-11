<HTML XMLns="http://www.w3.org/1999/xHTML"> 
<html>
    <head>
        <title>Cabs Online</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>" type="text/css">
        <script type="text/javascript" src="cabBooking.js"> </script>
        <script type="text/javascript" src="xhr.js"> </script>
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
    </head>
    <div class="content">
        <body>
            <h1>Book a Cab</h1>
            <form name="bookingForm" id="bookingForm" method="POST">
                <p>
                    <label for="cname">Full Name*: <input type="text" id="cname" name="cname" required></label>
                    <label for="phone">Phone Number*: <input type="text" id="phone" name="phone" required></label>
                </p>
                <p>
                    <label for="unumber">Unit Number: <input type="text" id="unumber" name="unumber"></label>
                    <label for="snumber">Street Number*: <input type="text" id="snumber" name="snumber" required></label>
                    <label for="sname">Street Name*: <input type="text" id="sname" name="sname" required></label>
                    <label for="sbname">Suburb: <input type="text" id="sbname" name="sbname"></label>
                </p>
                    <label for="dsbname">Destination Suburb: <input type="text" id="dsbname" name="dsbname"></label>
                <p>
                    <label for="date">Pick-Up Date*: <input type="date" id="date" name="date" value="<?php echo date("Y-m-d")?>" min="<?php echo date("Y-m-d")?>" max="<?php echo date("Y-m-d", strtotime("+1 week")) ?>" required></label>
                    <label for="time">Pick-Up Time*: <input type="time" id="time" name="time" value="<?php echo date("H:i")?>" required></label> 
                </p>
                <br><input name="submit" type="button" onClick="bookACab('recordBooking.php','confirmation', cname.value, phone.value, unumber.value, snumber.value, sname.value, sbname.value, dsbname.value, date.value, time.value)" value="Submit Booking Request">
            </form>
            <div id="confirmation">
                
            </div>
            <br><a href="http://kdr1283.cmslamp14.aut.ac.nz/assign2/index.html">Return to Home Page</a>
        </body>
    </div>
</html>