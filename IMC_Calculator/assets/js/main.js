const nameInput = document.getElementById('name');
const weightInput = document.getElementById('weight');
const heightInput = document.getElementById('height');
const ageInput = document.getElementById('age');
const genderSelect = document.getElementById('gender');
const imcValueElement = document.getElementById('imc-value');
const classificationElement = document.getElementById('classification');
const imcValueTextElement = document.getElementById('imc-value-text');
const resultTextElement = document.getElementById('result-text');
const calculateButton = document.querySelector('.calculate-button');
const resultSection = document.querySelector('.result-section');

function calculateIMC()
{
    const weight = parseFloat(weightInput.value);
    const height = parseFloat(heightInput.value);

    if (isNaN(weight) || isNaN(height) || height <= 0 || weight <= 0) {
        alert("Por favor, insira valores válidos para peso e altura.");
        return;
    }

    const imc = (weight / (height * height)).toFixed(2);
    
    imcValueElement.textContent = imc;

    let classification, backgroundColor;
    if (imc < 18.5) {
        classification = "Abaixo do Peso";
        backgroundColor = "#f39c12";
    } else if (imc >= 18.5 && imc < 24.9) {
        classification = "Peso Normal";
        backgroundColor = "#2ecc71";
        resultTextElement.textContent = `Parabéns ${name}, você está com o peso ideal!`;
    } else if (imc >= 25 && imc < 29.9) {
        classification = "Sobrepeso";
        backgroundColor = "#e67e22";
        resultTextElement.textContent = `Cuidado ${name}, você está em sobrepeso.`;
    } else {
        classification = "Obesidade";
        backgroundColor = "#e74c3c";
        resultTextElement.textContent = `Atenção ${name}, você está com obesidade.`;
    }

    classificationElement.textContent = classification;

    imcValueTextElement.textContent = imc;

    resultSection.style.backgroundColor = backgroundColor;
    resultSection.classList.add('fade-in');

    clearInputs();
}

function clearInputs() {
    nameInput.value = '';
    weightInput.value = '';
    heightInput.value = '';
    ageInput.value = '';
    genderSelect.selectedIndex = 0;
}

calculateButton.addEventListener('click', calculateIMC);
