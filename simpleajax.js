var xhr = createRequest();
function getData(dataSource, divID, aName, aPwd)  {
    if(xhr) {
        var obj = document.getElementById(divID);
        var requestbody ="name="+encodeURIComponent(aName)+"&pwd="+encodeURIComponent(aPwd);
        xhr.open("POST", dataSource, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            alert(xhr.readyState);
            if (xhr.readyState == 4 && xhr.status == 200) {
            obj.innerHTML = xhr.responseText;
            }
        }
        xhr.send(requestbody);
    }
}