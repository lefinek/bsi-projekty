var backButton = document.querySelector('.back');
var nextButton = document.querySelector('.next');

if (nextButton) {
    nextButton.addEventListener('click', ()=>{
        next();
    });
}
if (backButton) {
    backButton.addEventListener('click', ()=>{
        back();
    });
}

function back() {
    window.location.href = '../index.html';
}

function next(){
    window.location.href = '../form/index.html';
}