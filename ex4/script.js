const display = document.getElementById("display");
const history = document.getElementById("history");

function append(value){

display.value += value;

}

function appendFunction(value){

display.value += value;

}

function clearDisplay(){

display.value="";

history.innerHTML="";

}

function backspace(){

display.value=display.value.slice(0,-1);

}

function calculate(){

try{

let expression=display.value;

let result=eval(expression);

history.innerHTML=expression+" =";

display.value=result;

}

catch{

display.value="Error";

}

}

document.addEventListener("keydown",function(e){

if(!isNaN(e.key) || "+-*/.%()".includes(e.key))

display.value+=e.key;

if(e.key==="Enter")

calculate();

if(e.key==="Backspace")

backspace();

if(e.key==="Escape")

clearDisplay();

});