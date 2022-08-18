function forBuy (which, who){
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
        var res = this.responseText;
        if (res == "yes"){
            var before = document.getElementById("forNumber").innerHTML;
            before = before.trim();
            document.getElementById("forNumber").innerHTML = parseInt(before) + 1;
        }
    }
    xmlhttp.open("GET", "buying.php?product=" + which + "&user=" + who);
    xmlhttp.send();
}

function deleteRow(which, number){
    let toDecrease = document.getElementById("total" + number).innerHTML;
    toDecrease = toDecrease.trim();
    let beforeTotalTotal = document.getElementById("totalTotal").innerHTML;
    beforeTotalTotal = beforeTotalTotal.trim();
    let beforeMainTotal = document.getElementById("mainTotal").innerHTML;
    beforeMainTotal = beforeMainTotal.trim();

    let newTotal;
    let newMain;

    newTotal = parseInt(beforeTotalTotal.substring(1, beforeTotalTotal.length)) - parseInt(toDecrease.substring(1, toDecrease.length));
    newMain = parseInt(beforeMainTotal.substring(1, beforeMainTotal.length)) - parseInt(toDecrease.substring(1, toDecrease.length));

    document.getElementById("totalTotal").innerHTML = "$" + newTotal;
    document.getElementById("mainTotal").innerHTML = "$" + newMain;


    document.getElementById("thisRow" + which).innerHTML = "";
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
        var before = document.getElementById("forNumber").innerHTML;
        before = before.trim();
        document.getElementById("forNumber").innerHTML = parseInt(before) - 1;
    }
    xmlhttp.open("GET", "delete.php?p=" + which);
    xmlhttp.send();
}