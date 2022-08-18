function changePrice (mainPrice, number, id){
    let before = document.getElementById("total" + id).innerHTML;
    before = before.substring(1, before.length);

    let totalTotal = (document.getElementById("totalTotal").innerHTML).trim();
    totalTotal = totalTotal.substring(1, totalTotal.length);
    totalTotal -= before;

    let price = mainPrice.substring(1, mainPrice.length);
    let total = price * number;
    document.getElementById("total" + id).innerHTML = "$" + total;


    totalTotal += total;
    document.getElementById("totalTotal").innerHTML = "$" + totalTotal;
    document.getElementById("mainTotal").innerHTML = "$" + (totalTotal+2);


    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
    
    }
    xmlhttp.open("GET", "ChangingNumber.php?number=" + number + "&id=" + id);
    xmlhttp.send();
}