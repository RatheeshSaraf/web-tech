const darkBtn =
document.getElementById("darkBtn");



if(darkBtn){


darkBtn.onclick=()=>{


document.body.classList.toggle("dark");



localStorage.setItem(

"darkMode",

document.body.classList.contains("dark")

);


};


}




window.onload=()=>{


if(localStorage.getItem("darkMode")=="true"){


document.body.classList.add("dark");


}



};