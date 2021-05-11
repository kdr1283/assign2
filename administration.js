function getBooking(dataSource, divID, bsearch) {
    const xhr = createRequest();

    if(xhr) {
        const obj = document.getElementById(divID);
        const requestbody ="bsearch="+encodeURIComponent(bsearch);
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

function assignCab(dataSource, tdID, ref) {
    const xhr = createRequest();

    if(xhr) {
        const status = document.getElementById(tdID).innerHTML; // get the request status 
        console.log(status);
        const obj = document.getElementById(tdID); //the object of interest that will change the contents within the id
        const requestbody ="status="+encodeURIComponent(status)+"&ref="+encodeURIComponent(ref); // request body with the request status and reference number that will be sent
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