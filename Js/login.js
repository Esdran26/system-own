
/* Seleccionar los dos íconos que al dar click en alguno de ellos muestre el otro, creando una función que muestre 
en los campos de tipo contraseña a tipo text y viceversa */

const eyeSlash = document.getElementById('eye-slash');
const eye = document.getElementById('eye');

eyeSlash.addEventListener('click', () => {
    eyeSlash.style.display = 'none';
    eye.style.display = 'block';

    inputPassword.type = 'text';
    inputVerifyPassword.type = 'text';
});

eye.addEventListener('click', () => {
    eye.style.display = 'none';
    eyeSlash.style.display = 'block';

    inputPassword.type = 'password';
    inputVerifyPassword.type = 'password';
});