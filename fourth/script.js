var input = document.querySelector("input");
var buttons = document.querySelectorAll("button");
var monitor = document.querySelector(".actual_monitor");
var m = null;

function ifAbleToWriteSign() {
    let value = input.value;
    let lastChar = value.slice(-1);
    if(lastChar == "+" || lastChar == "-" || lastChar == "*" || lastChar == "/" || lastChar == "%" || lastChar == "") {
        return false;
    } else {
        return true;
    }
}

function resetMemory() {
    m = null;
    buttons.forEach((elem, index) => {
        if (buttons[index].getAttribute("value") == "M") {
            buttons[index].style = "color: rgba(75, 126, 236, 1)";
        }
    });
}

function ifOn() {
    if (input.classList.contains("screenON")) {
        return true;
    } else {
        return false;
    }
}

buttons.forEach((elem, index) => {
    elem.addEventListener("click", () => {
        if (buttons[index].getAttribute("value") == "ON") {
            input.value = "";
            input.classList.toggle("screenON");
            if(!input.classList.contains("screenON")) {
                resetMemory();
                buttons[index].style = "background-color: rgba(117, 159, 252, 0.775);";
            } else{
                buttons[index].style = "background-color: rgb(16, 92, 255);";
            }
        } else if (buttons[index].getAttribute("value") == "C") {
            input.value = "";
        } else if (buttons[index].getAttribute("value") == "CE") {
            input.value = input.value.slice(0, -1);
        } else if (buttons[index].getAttribute("value") == "M+") {
            if (input.classList.contains("screenON")) {
                if (m != null) {
                    m = null;
                    buttons[index + 1].style = "color: rgba(75, 126, 236, 1)";
                } else if (m == null) {
                    m = input.value;
                    buttons[index + 1].style = "color: rgb(16, 92, 255);";
                }
            }
        } else if (buttons[index].getAttribute("value") == "M" && ifOn()) {
            if (m != null) {
                input.value = input.value + m;
            }
        } else if (buttons[index].getAttribute("value") == "/" && ifOn()) {
            if (ifAbleToWriteSign()) {
                input.value = input.value + "/";
            }
        } else if (buttons[index].getAttribute("value") == "X" && ifOn()) {
            if (ifAbleToWriteSign()) {
                input.value = input.value + "*";
            }
        } else if (buttons[index].getAttribute("value") == "+/-" && ifOn()) {
            if (input.value.slice(0, 1) == "-") {
                input.value = input.value.slice(1, input.length);
            } else {
                input.value = "-" + input.value;
            }
        } else if (buttons[index].getAttribute("value") == "-" && ifOn()) {
            if (ifAbleToWriteSign()) {
                input.value = input.value + "-";
            }
        } else if (buttons[index].getAttribute("value") == "√" && ifOn()) {
            if (ifAbleToWriteSign()) {
                input.value = Math.sqrt(input.value);
            }
        } else if (buttons[index].getAttribute("value") == "%" && ifOn()) {
            if (ifAbleToWriteSign()) {
                input.value = input.value * 100 + "%";
            }
        } else if (buttons[index].getAttribute("value") == "+" && ifOn()) {
            if (ifAbleToWriteSign()) {
                input.value = input.value + "+";
            }
        } else if (buttons[index].getAttribute("value") == "=" && ifOn()) {
            if (input.value == "") {
                input.value = "";
            } else {
                try {
                    input.value = eval(input.value);
                } catch (e) {
                    input.value = "error";
                }
            }
        } else if (input.getAttribute("class") == "screenON") {
            input.value = input.value + buttons[index].getAttribute("value");
        } else {
        }
    });
});


var backButton = document.querySelector('.back');
if (backButton) {
    backButton.addEventListener('click', ()=>{
        back();
    });
}

function back() {
    window.location.href = '../index.html';
}