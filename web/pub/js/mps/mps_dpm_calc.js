// 1st CALC

// this defines the text fields
function scaling()
{
var a = document.scale.a.value
var b = document.scale.b.value
var c = document.scale.c.value
var equals = ((a/1000)*b)/(c-(a/1000))
var whole = Math.round(equals * 100)/100

if (whole <= '0')
{
document.scale.equals.value="";
window.alert("R2 can not be a negative number");
document.scale.equals.value="Error"
}
else // run the equation
document.scale.equals.value= whole 
}

//check Display reading values old way
//function checkDisplayNumber(a){
//var x = 1999
//var y = 0
//if (a <= y || a > x)
//{
//document.scale.a.value="";
//window.alert("Display Reading must be greater than 0 and less than 2000");
//document.scale.a.focus()
//}
//}

//check Display reading values
function checkDisplayNumber(a){
var x = 1999
var y = 0
input=document.scale.a.value
if (!parseFloat(input) || a > x || a <= y) {
window.alert("Please enter a number greater than 0 and less than 2000.");
document.scale.a.value="";
document.scale.a.focus()
}
else {
for (var i=0; i<input.length; i++) {
if (input.charAt(i) != "0") {
    if (!parseFloat(input.charAt(i))) {
    window.alert("Please enter number without decimal point.");
  document.scale.a.value="";
document.scale.a.focus();return false
break
    }
}
}
}
}

//check Vin values
function isANumber(){
entry=document.scale.c.value
if (!parseFloat(entry)) {
window.alert("Please enter a number greater than zero.");
document.scale.c.value="";
document.scale.c.focus();
}
//else {
//for (var i=0; i<entry.length; i++) {
//if (entry.charAt(i) != "0") {
//    if (!parseFloat(entry.charAt(i))) {
//    window.alert("Please enter a numeric value.")
//    break
//    }
//}
//}
document.scale.c.value = parseFloat(entry)
//}
}

// set all but field "b" to null
function clearform()
{
document.scale.a.value=""
document.scale.b.value="909"
document.scale.c.value=""
document.scale.equals.value="";
document.scale.a.focus();
}


// 2nd CALC

// this defines the text fields
function scalingfour()
{
var a = document.scalefour.a.value
var b = document.scalefour.b.value
var c = document.scalefour.c.value
var equals = ((a/10000)*b)/(c-(a/10000))
var whole = Math.round(equals * 100)/100

if (whole <= '0')
{
document.scalefour.equals.value="";
window.alert("R2 can not be a negative number");
document.scalefour.equals.value="Error"
}
else // run the equation
document.scalefour.equals.value= whole 
}


//check Display reading values
function checkDisplayNumberFour(a){
var x = 19999
var y = 0
input=document.scalefour.a.value
if (!parseFloat(input) || a > x || a <= y) {
window.alert("Please enter a number greater than 0 and less than 2000.");
document.scalefour.a.value="";
document.scalefour.a.focus()
}
else {
for (var i=0; i<input.length; i++) {
if (input.charAt(i) != "0") {
    if (!parseFloat(input.charAt(i))) {
    window.alert("Please enter number without decimal point.");
  document.scalefour.a.value="";
document.scalefour.a.focus();return false
break
    }
}
}
}
}

//check Vin values
function isANumberFour(){
entry=document.scalefour.c.value
if (!parseFloat(entry)) {
window.alert("Please enter a number greater than zero.");
document.scalefour.c.value="";
document.scalefour.c.focus();
}

document.scalefour.c.value = parseFloat(entry)

}

// set all but field "b" to null
function clearformfour()
{
document.scalefour.a.value=""
document.scalefour.b.value="909"
document.scalefour.c.value=""
document.scalefour.equals.value="";
document.scalefour.a.focus();
}

