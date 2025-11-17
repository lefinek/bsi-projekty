var backButton = document.querySelector('.back');
if (backButton) {
    backButton.addEventListener('click', ()=>{
        back();
    });
}

function back() {
    window.location.href = '../second/form/index.html';
}