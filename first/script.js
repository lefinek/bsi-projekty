var backButton = document.querySelector('.back');
if (backButton) {
    backButton.addEventListener('click', ()=>{
        back();
    });
}

function back() {
    window.close();
    window.location.href = '/index.html';
}