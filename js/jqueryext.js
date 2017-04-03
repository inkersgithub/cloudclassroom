
//notification validation

function empty() {
    var x;
    x = document.getElementById("msgn").value;
    if (x == "") {
        alert("Enter a Valid Message");
        return false;
    };
}
