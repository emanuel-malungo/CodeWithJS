const btnLogin = document.getElementById('btn-login');
const btnSign = document.getElementById('btn-sign');
const boxInputSign = document.getElementById('box-input-sign');

btnLogin.addEventListener('click', (e) => {
    e.preventDefault();
    btnLogin.style.background = "#31c9bc";
    btnLogin.style.color = "#fff";
    btnSign.style.border = "1px solid #31c9bc"; 
    btnSign.style.backgroundColor = "rgb(43, 41, 39";
    boxInputSign.classList.add('hide');
})

btnSign.addEventListener('click', (e) => {
    e.preventDefault();
    btnSign.style.background = "#31c9bc";
    btnSign.style.color = "#fff";
    btnLogin.style.border = "1px solid #31c9bc"; 
    btnLogin.style.backgroundColor = "rgb(43, 41, 39";
    boxInputSign.classList.remove('hide');
})