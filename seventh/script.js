var backButton = document.querySelector('.back');
if (backButton) {
    backButton.addEventListener('click', ()=>{
        back();
    });
}

function back() {
    window.location.href = '../index.html';
}

var indexNumber = document.querySelectorAll('.id-field');

var selectEditButtons = document.querySelectorAll('.select-edit-button');
var deleteButtons = document.querySelectorAll('.delete-button');
var editButtons = document.querySelectorAll('.edit-button');
var abortEditButtons = document.querySelectorAll('.abort-edit-button');

var rows = document.querySelectorAll('.table-content .row');

function updateValues(index){
    rowsInput = rows[index].querySelectorAll('.row-item-input input, .row-item-input select');
    rowsInput.forEach((input) => {
        input.addEventListener('change', () => {
            input.setAttribute('value', input.value);
        });
    });
}

function resetValues(index){
    rowValues = rows[index].querySelectorAll('.data');
    rowsInput = rows[index].querySelectorAll('.row-item-input input, .row-item-input select');
    rowsInput.forEach((input, i) => {
        const originalValue = rowValues[i].innerHTML.trim();
        input.value = originalValue;
        input.setAttribute('value', originalValue);
        if (input.tagName === 'SELECT') {
            Array.from(input.options).forEach(option => {
                option.selected = (option.value === originalValue);
            });
        }
    });
}

function changeToEditMode(index) {
    rowsDisplay = rows[index].querySelectorAll('.row-item');
    rowsInput = rows[index].querySelectorAll('.row-item-input');
    i = 0;
    rowsDisplay.forEach((cell) => {
        if(i == rowsDisplay.length - 1){
            return;
        }
        i++;
        cell.style.display = 'none';
    });
    rowsInput.forEach((cell) => {
        cell.classList.remove('hidden');
    });

    updateValues(index);
}

function changeToDisplayMode(index) {
    rowsDisplay = rows[index].querySelectorAll('.row-item');
    rowsInput = rows[index].querySelectorAll('.row-item-input');
    i = 0;
    rowsDisplay.forEach((cell) => {
        if(i == rowsDisplay.length - 1){
            return;
        }
        i++;
        cell.style.display = 'flex';
    });
    rowsInput.forEach((cell) => {
        cell.classList.add('hidden');
    });
    resetValues(index);
}

selectEditButtons.forEach((button, index) => {
    button.addEventListener('click', () => {
        abortEditButtons.forEach((btn, idx) => {
            if(idx != index){
                btn.style.display = 'none';
                editButtons[idx].style.display = 'none';
                selectEditButtons[idx].style.display = 'inline-block';
                deleteButtons[idx].style.display = 'inline-block';
                changeToDisplayMode(idx);
            }
        });
        abortEditButtons[index].style.display = 'inline-block';
        editButtons[index].style.display = 'inline-block';
        button.style.display = 'none';
        deleteButtons[index].style.display = 'none';
        changeToEditMode(index);
    });
});

abortEditButtons.forEach((button, index) => {
    button.addEventListener('click', () => {
        selectEditButtons[index].style.display = 'inline-block';
        editButtons[index].style.display = 'none';
        button.style.display = 'none';
        deleteButtons[index].style.display = 'inline-block';
        changeToDisplayMode(index);
    });
});


editButtons.forEach((button, index) => {
    button.addEventListener('click', () => {
        string = '';
        rowsInput = rows[index].querySelectorAll('.row-item-input input, .row-item-input select');
        rowsInput.forEach((input) => {
            string += `${input.name}=${encodeURIComponent(input.value)}&`;
        });
        id = document.querySelectorAll('.id-field')[index].value;
        window.location.href = `editRecord.php?id=${id}&${string}`;
    });
});

deleteButtons.forEach((button, index) => {
    id = document.querySelectorAll('.id-field')[index].value;
    button.addEventListener('click', () => {
        window.location.href = `deleteRecord.php?id=${id}`;
    });
});