
//notification validation

function empty() {
    var x;
    x = document.getElementById("msgn").value;
    if (x == "") {
        alert("Enter a Valid Message");
        return false;
    };
}
function empty1() {
    var x;
    x = document.getElementById("msgn1").value;
    if (x == "") {
        alert("Enter a Valid Message");
        return false;
    };
}
function myFunction() {
    var x = document.getElementById("fname");
    x.value = x.value.toUpperCase();
}
function myFunctionname() {
    var x = document.getElementById("name");
    x.value = x.value.toUpperCase();
}
