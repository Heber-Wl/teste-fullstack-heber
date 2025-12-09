document.addEventListener('DOMContentLoaded', function () {
    const password = document.getElementById('password');
    const confirm = document.getElementById('password_confirmation');
    const senhaMinError = document.getElementById('senha-min-error');
    const senhaMatchError = document.getElementById('senha-match-error');
    const submitBtn = document.getElementById('submit-btn');

    function validarSenhas() {
        let valido = true;

        if (password.value.length < 8) {
            senhaMinError.style.display = "block";
            password.style.border = "2px solid red";
            valido = false;
        } else {
            senhaMinError.style.display = "none";
            password.style.border = "";
        }

        if (password.value.length >= 8 && confirm.value.length > 0) {
            if (password.value !== confirm.value) {
                senhaMatchError.style.display = "block";
                confirm.style.border = "2px solid red";
                valido = false;
            } else {
                senhaMatchError.style.display = "none";
                confirm.style.border = "";
            }
        } else {
            senhaMatchError.style.display = "none";
            confirm.style.border = "";
        }

        submitBtn.disabled = !valido;
    }

    password.addEventListener('input', validarSenhas);
    confirm.addEventListener('input', validarSenhas);
});