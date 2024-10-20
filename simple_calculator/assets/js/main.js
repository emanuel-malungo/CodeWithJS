document.addEventListener('keydown', function(event) {
    const key = event.key;
    
    if ('0123456789/*-+'.includes(key)) {
        insertElements(key);
    } else if (key === 'Enter' || key === '=') {
        insertElements('=');
    } else if (key === 'Backspace') {
        removeElements();
    } else if (key === 'Escape') {
        cleanElements();
    }
});

function insertElements(element) {
    const resultInput = document.querySelector("#result");
    
    if (element === '=') {
        try {
            const evaluatedResult = eval(resultInput.value);
            resultInput.value = evaluatedResult; 
            document.querySelector("#entry").value = resultInput.value;
        } catch (error) {
            resultInput.value = 'error';
        }
    } else {
        resultInput.value += element;
    }
}

function cleanElements() {
    document.querySelector("#result").value = '';
    document.querySelector("#entry").value = '';
}

function removeElements() {
    const resultInput = document.querySelector("#result");
    resultInput.value = resultInput.value.slice(0, - 1);
}

