function showPlants(str) {
    if (str == "") {
        document.getElementById("plante").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("plante").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","\\BoW/apps/getplante.php?q="+str,true);
        xmlhttp.send();
    }
}