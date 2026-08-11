// =======================
// QUIZ QUESTIONS
// =======================

const questions = [

{
question: "What is the capital of India?",
answers: [
{text:"Mumbai", correct:false},
{text:"New Delhi", correct:true},
{text:"Chennai", correct:false},
{text:"Kolkata", correct:false}
]
},

{
question: "Which planet is called the Red Planet?",
answers: [
{text:"Earth", correct:false},
{text:"Mars", correct:true},
{text:"Venus", correct:false},
{text:"Jupiter", correct:false}
]
},

{
question: "HTML stands for?",
answers: [
{text:"Hyper Text Markup Language", correct:true},
{text:"High Text Machine Language", correct:false},
{text:"Home Tool Markup Language", correct:false},
{text:"Hyperlinks Text Machine Language", correct:false}
]
},

{
question: "Which language is mainly used for styling web pages?",
answers: [
{text:"HTML", correct:false},
{text:"Python", correct:false},
{text:"CSS", correct:true},
{text:"Java", correct:false}
]
},

{
question: "Which company developed JavaScript?",
answers: [
{text:"Microsoft", correct:false},
{text:"Netscape", correct:true},
{text:"Google", correct:false},
{text:"Apple", correct:false}
]
}

];

// =======================
// HTML ELEMENTS
// =======================

const startScreen = document.getElementById("start-screen");
const quizScreen = document.getElementById("quiz-screen");
const resultScreen = document.getElementById("result-screen");

const startBtn = document.getElementById("start-btn");
const nextBtn = document.getElementById("next-btn");
const restartBtn = document.getElementById("restart-btn");

const questionElement = document.getElementById("question");
const answerButtons = document.getElementById("answer-buttons");

const questionNumber = document.getElementById("question-number");
const progress = document.getElementById("progress");
const liveScore = document.getElementById("live-score");

const finalScore = document.getElementById("final-score");
const percentage = document.getElementById("percentage");
const remark = document.getElementById("remark");

// =======================
// VARIABLES
// =======================

let currentQuestionIndex = 0;
let score = 0;

// =======================
// START QUIZ
// =======================

startBtn.addEventListener("click", () => {

startScreen.classList.add("hide");
quizScreen.classList.remove("hide");

currentQuestionIndex = 0;
score = 0;

showQuestion();

});

// =======================
// SHOW QUESTION
// =======================

function showQuestion(){

resetState();

let currentQuestion = questions[currentQuestionIndex];

questionNumber.innerHTML = currentQuestionIndex + 1;

questionElement.innerHTML = currentQuestion.question;

liveScore.innerHTML = score;

progress.style.width =
((currentQuestionIndex)/questions.length)*100 + "%";

currentQuestion.answers.forEach(answer=>{

const button = document.createElement("button");

button.textContent = answer.text;
button.classList.add("answer-btn");

if(answer.correct){
button.dataset.correct = answer.correct;
}

button.addEventListener("click",selectAnswer);

answerButtons.appendChild(button);

});

}

// =======================
// RESET BUTTONS
// =======================

function resetState(){

nextBtn.classList.add("hide");

while(answerButtons.firstChild){

answerButtons.removeChild(answerButtons.firstChild);

}

}
// =======================
// SELECT ANSWER
// =======================

function selectAnswer(e){

const selectedBtn = e.target;

const correct =
selectedBtn.dataset.correct === "true";

if(correct){

selectedBtn.classList.add("correct");
score++;

}else{

selectedBtn.classList.add("wrong");

}

Array.from(answerButtons.children).forEach(button=>{

if(button.dataset.correct==="true"){

button.classList.add("correct");

}

button.disabled=true;

});

liveScore.innerHTML=score;

nextBtn.classList.remove("hide");

}

// =======================
// NEXT BUTTON
// =======================

nextBtn.addEventListener("click",()=>{

currentQuestionIndex++;

if(currentQuestionIndex < questions.length){

showQuestion();

}else{

showResult();

}

});

// =======================
// QUESTIONS 6 - 8
// =======================

questions.push(

{
question:"CSS stands for?",
answers:[
{text:"Creative Style Sheets",correct:false},
{text:"Cascading Style Sheets",correct:true},
{text:"Computer Style Sheets",correct:false},
{text:"Colorful Style Sheets",correct:false}
]
},

{
question:"Which tag is used to create a hyperlink in HTML?",
answers:[
{text:"<a>",correct:true},
{text:"<link>",correct:false},
{text:"<href>",correct:false},
{text:"<url>",correct:false}
]
},

{
question:"Which is the largest ocean in the world?",
answers:[
{text:"Indian Ocean",correct:false},
{text:"Pacific Ocean",correct:true},
{text:"Atlantic Ocean",correct:false},
{text:"Arctic Ocean",correct:false}
]
}

);
// =======================
// QUESTIONS 9 - 10
// =======================

questions.push(

{
question:"Which is the national animal of India?",
answers:[
{text:"Tiger",correct:true},
{text:"Lion",correct:false},
{text:"Elephant",correct:false},
{text:"Leopard",correct:false}
]
},

{
question:"Which HTML tag is used to insert an image?",
answers:[
{text:"<image>",correct:false},
{text:"<img>",correct:true},
{text:"<pic>",correct:false},
{text:"<photo>",correct:false}
]
}

);
// =======================
// QUESTIONS 11 - 15
// =======================

questions.push(

{
question:"Which is the largest continent?",
answers:[
{text:"Europe",correct:false},
{text:"Asia",correct:true},
{text:"Africa",correct:false},
{text:"Australia",correct:false}
]
},

{
question:"Java is a ____?",
answers:[
{text:"Programming Language",correct:true},
{text:"Operating System",correct:false},
{text:"Database",correct:false},
{text:"Browser",correct:false}
]
},

{
question:"Which device is used to print documents?",
answers:[
{text:"Monitor",correct:false},
{text:"Keyboard",correct:false},
{text:"Printer",correct:true},
{text:"Scanner",correct:false}
]
},

{
question:"Which symbol is used for comments in JavaScript?",
answers:[
{text:"//",correct:true},
{text:"<!-- -->",correct:false},
{text:"#",correct:false},
{text:"**",correct:false}
]
},

{
question:"Which country is famous for the Eiffel Tower?",
answers:[
{text:"Italy",correct:false},
{text:"France",correct:true},
{text:"Germany",correct:false},
{text:"Spain",correct:false}
]
}

);
// =======================
// QUESTIONS 16 - 20
// =======================

questions.push(

{
question:"Which gas do plants absorb from the atmosphere?",
answers:[
{text:"Oxygen",correct:false},
{text:"Carbon Dioxide",correct:true},
{text:"Nitrogen",correct:false},
{text:"Hydrogen",correct:false}
]
},

{
question:"Which is the fastest land animal?",
answers:[
{text:"Tiger",correct:false},
{text:"Horse",correct:false},
{text:"Cheetah",correct:true},
{text:"Lion",correct:false}
]
},

{
question:"Which HTML tag creates a line break?",
answers:[
{text:"<break>",correct:false},
{text:"<br>",correct:true},
{text:"<lb>",correct:false},
{text:"<hr>",correct:false}
]
},

{
question:"JavaScript is mainly used for?",
answers:[
{text:"Styling webpages",correct:false},
{text:"Making webpages interactive",correct:true},
{text:"Creating databases",correct:false},
{text:"Editing images",correct:false}
]
},

{
question:"Which is the largest planet in our Solar System?",
answers:[
{text:"Earth",correct:false},
{text:"Saturn",correct:false},
{text:"Jupiter",correct:true},
{text:"Mars",correct:false}
]
}

);

// =======================
// SHOW RESULT
// =======================

function showResult(){

quizScreen.classList.add("hide");
resultScreen.classList.remove("hide");

finalScore.innerHTML = score + " / " + questions.length;

let percent = Math.round((score/questions.length)*100);

percentage.innerHTML = percent + "%";

if(percent>=90){

remark.innerHTML="🏆 Outstanding!";

}
else if(percent>=75){

remark.innerHTML="🎉 Excellent!";

}
else if(percent>=60){

remark.innerHTML="👍 Good Job!";

}
else if(percent>=40){

remark.innerHTML="🙂 Keep Practicing!";

}
else{

remark.innerHTML="📚 Try Again!";

}

}

// =======================
// RESTART QUIZ
// =======================

restartBtn.addEventListener("click",()=>{

resultScreen.classList.add("hide");
startScreen.classList.remove("hide");

currentQuestionIndex=0;
score=0;

liveScore.innerHTML=0;
progress.style.width="0%";

});