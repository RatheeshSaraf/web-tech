/* ===================================
   RATHEESH R PORTFOLIO JAVASCRIPT
   Animations + Interactions
=================================== */



// Remove Loading Screen

window.addEventListener("load",()=>{

    const loader=document.querySelector(".loader");

    setTimeout(()=>{

        loader.style.opacity="0";

        setTimeout(()=>{

            loader.style.display="none";

        },500);


    },1500);


});





// Typing Animation


const textArray=[

"MCA Student",

"Frontend Developer",

"UI/UX Enthusiast",

"Web Developer",

"Software Developer"

];


let textIndex=0;

let charIndex=0;

let typingElement=document.querySelector(".typing");


function typeEffect(){


if(charIndex < textArray[textIndex].length){


typingElement.textContent += textArray[textIndex].charAt(charIndex);

charIndex++;

setTimeout(typeEffect,100);


}

else{


setTimeout(deleteEffect,1500);


}


}




function deleteEffect(){


if(charIndex>0){


typingElement.textContent =
textArray[textIndex].substring(0,charIndex-1);


charIndex--;


setTimeout(deleteEffect,50);


}

else{


textIndex++;


if(textIndex>=textArray.length){

textIndex=0;

}


setTimeout(typeEffect,300);


}


}


document.addEventListener("DOMContentLoaded",()=>{

typeEffect();

});






// Mobile Menu


const menu=document.querySelector(".menu");

const nav=document.querySelector(".nav-links");


if(menu){


menu.addEventListener("click",()=>{


nav.classList.toggle("active");


});


}






// Scroll Reveal Animation


const observer=new IntersectionObserver((entries)=>{


entries.forEach(entry=>{


if(entry.isIntersecting){


entry.target.style.opacity="1";

entry.target.style.transform="translateY(0)";


}


});


},{

threshold:0.15

});





document.querySelectorAll(

".section, .project-card, .skill, .stat-card, .timeline-box"

).forEach(el=>{


el.style.opacity="0";

el.style.transform="translateY(50px)";

el.style.transition="all .8s ease";


observer.observe(el);


});







// Navbar Background Change


window.addEventListener("scroll",()=>{


const header=document.querySelector("header");


if(window.scrollY>50){


header.style.background="rgba(5,8,22,.85)";


}

else{


header.style.background="transparent";


}


});







// Mouse Glow Effect


const glow=document.createElement("div");


glow.style.position="fixed";

glow.style.width="250px";

glow.style.height="250px";

glow.style.background="#00e5ff";

glow.style.opacity=".15";

glow.style.borderRadius="50%";

glow.style.filter="blur(100px)";

glow.style.pointerEvents="none";

glow.style.zIndex="-1";


document.body.appendChild(glow);



document.addEventListener("mousemove",(e)=>{


glow.style.left=e.clientX-125+"px";

glow.style.top=e.clientY-125+"px";


});







// Smooth Active Navigation


const sections=document.querySelectorAll("section");

const links=document.querySelectorAll(".nav-links a");


window.addEventListener("scroll",()=>{


let current="";


sections.forEach(section=>{


let top=window.scrollY;

let offset=section.offsetTop-150;

let height=section.offsetHeight;

let id=section.getAttribute("id");



if(top>=offset && top<offset+height){


current=id;


}



});



links.forEach(link=>{


link.classList.remove("active");


if(link.getAttribute("href")=="#"+current){


link.classList.add("active");


}


});


});







// Project Card 3D Hover


const cards=document.querySelectorAll(".project-card");


cards.forEach(card=>{


card.addEventListener("mousemove",(e)=>{


let rect=card.getBoundingClientRect();


let x=e.clientX-rect.left;

let y=e.clientY-rect.top;



let rotateX=((y-rect.height/2)/20)*-1;

let rotateY=(x-rect.width/2)/20;



card.style.transform=
`
perspective(800px)
rotateX(${rotateX}deg)
rotateY(${rotateY}deg)
translateY(-10px)
`;



});



card.addEventListener("mouseleave",()=>{


card.style.transform="translateY(0)";


});


});
