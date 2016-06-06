function showButton() { 
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        ajax = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        ajax = new ActiveXObject("Microsoft.XMLHTTP");
    }
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.getElementById("login").innerHTML = ajax.responseText;
        }
    }
    ajax.open("GET","\\BoW/apps/utillog.php",true);
    ajax.send();
}