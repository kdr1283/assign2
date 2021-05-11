function bookACab(dataSource, divID, cname, phone, unumber, snumber, sname, sbname, dsbname, date, time) {
    const xhr = createRequest();

    if(xhr) {
        const obj = document.getElementById(divID);
        const requestbody ="cname="+encodeURIComponent(cname)+ // customer name
        "&phone="+encodeURIComponent(phone)+ // phone number
        "&unumber="+encodeURIComponent(unumber)+ // unit number
        "&snumber="+encodeURIComponent(snumber)+ // street number
        "&sname="+encodeURIComponent(sname)+ // street name
        "&sbname="+encodeURIComponent(sbname)+ // suburb name
        "&dsbname="+encodeURIComponent(dsbname)+ // destination suburb
        "&date="+encodeURIComponent(date)+ // pick-up date
        "&time="+encodeURIComponent(time); // pick-up time

        var pickUpDateTime = new Date(date+"T"+time); // get user pickup time and date and combine it
        console.log(pickUpDateTime);
        var currentDateTime = new Date() // get local date and time
        currentDateTime.setSeconds(0,0); // set seconds and miliseconds to 0 of 
        console.log(currentDateTime);

        if (cname && phone && snumber && sname && date && time) { // check if the required fields have been filled in
            var missingFields = false;
        } else {
            missingFields = true;
            console.log("Error: Missing Required Fields"); 
            alert("Please fill in the missing required fields."); // error prompt telling the user to fill in missing required fields
        }

        if (currentDateTime > pickUpDateTime && !missingFields) { // check if user pick-up date and time is before current date and time of booking
            console.log("Error: Invalid Pickup Date and Time");
            alert("Pickup date and time cannot be before the time of booking.")
            var invalidDateTime = true;
        }

        if (!invalidDateTime && !missingFields) { // check if pick-up date and time, as well as required fields are filled
            xhr.open("POST", dataSource, true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    obj.innerHTML = xhr.responseText;
                }
            }
            xhr.send(requestbody);
        }
    }
}