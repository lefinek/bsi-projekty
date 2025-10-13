var backButton = document.querySelector('.back');
var exitButton = document.querySelector('.exit');

if (exitButton) {
    exitButton.addEventListener('click', ()=>{
        exit();
    });
}
if (backButton) {
    backButton.addEventListener('click', ()=>{
        back();
    });
}

function back() {
    window.location.href = '../gallery/index.html';
}

function exit(){
    window.close();
    window.location.href = 'form/index.html';
}