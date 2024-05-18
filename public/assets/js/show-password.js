const tombolTogglePassword = document.getElementById('toggle-password');
const tombolTogglePassword2 = document.getElementById('toggle-password-2');
const tombolTogglePassword3 = document.getElementById('toggle-password-3');
const inputPassword = document.getElementById('password');
const inputKonfirmasiPassword = document.getElementById('konfirmasi_password');
const inputOldPassword = document.getElementById('old_password');

tombolTogglePassword.addEventListener('click', () => {
    const passwordInputType = inputPassword.getAttribute('type');

    if (passwordInputType === 'password') {
        inputPassword.setAttribute('type', 'text');
        tombolTogglePassword.classList.remove('fa-eye');
        tombolTogglePassword.classList.add('fa-eye-slash');
    } else {
        inputPassword.setAttribute('type', 'password');
        tombolTogglePassword.classList.remove('fa-eye-slash');
        tombolTogglePassword.classList.add('fa-eye');
    }
});

if(tombolTogglePassword2){
    tombolTogglePassword2.addEventListener('click', () => {
        const passwordInputType = inputKonfirmasiPassword.getAttribute('type');
    
        if (passwordInputType === 'password') {
            inputKonfirmasiPassword.setAttribute('type', 'text');
            tombolTogglePassword2.classList.remove('fa-eye');
            tombolTogglePassword2.classList.add('fa-eye-slash');
        } else {
            inputKonfirmasiPassword.setAttribute('type', 'password');
            tombolTogglePassword2.classList.remove('fa-eye-slash');
            tombolTogglePassword2.classList.add('fa-eye');
        }
    });
}

if(tombolTogglePassword3){
    tombolTogglePassword3.addEventListener('click', () => {
        const passwordInputType = inputOldPassword.getAttribute('type');
    
        if (passwordInputType === 'password') {
            inputOldPassword.setAttribute('type', 'text');
            tombolTogglePassword3.classList.remove('fa-eye');
            tombolTogglePassword3.classList.add('fa-eye-slash');
        } else {
            inputOldPassword.setAttribute('type', 'password');
            tombolTogglePassword3.classList.remove('fa-eye-slash');
            tombolTogglePassword3.classList.add('fa-eye');
        }
    });
}