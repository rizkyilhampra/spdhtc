var notyf = new Notyf({
    position: {
        x: 'right',
        y: 'top',
    },
    dismissible: true
});

function emailHasSent() {
    let textStatusEmail = document.getElementById('textStatusEmail');
    if (statusSession == 'verification-link-sent') {
        let resendVerifEmail = document.getElementById('resendVerifEmail');
        resendVerifEmail.remove();
        textStatusEmail.innerHTML = 'Email verifikasi telah dikirim ke email anda!\n';
        textStatusEmail.innerHTML += 'Tolong cek email anda dan klik link untuk memverifikasi akun anda';
        return notyf.success('Email verifikasi telah dikirim ke email anda!');
    } else if (statusSession.includes('atur ulang sandi')) {
        let formForgotPassword = document.querySelector('form.needs-validation');
        formForgotPassword.remove();
        textStatusEmail.innerHTML = 'Kami telah mengirimkan link untuk mereset kata sandi anda';
        return notyf.success('Email telah dikirimkan');
    }
}

function tokenExpired() {
    if (errorHasEmail) {
        let form = document.querySelector('.needs-validation');
        form.innerHTML =
            'Mohon maaf, token anda sudah kadaluarsa. Silahkan melakukan permintaan reset password kembali';
        notyf.error(errorMsgEmail);
        setTimeout(function () {
            window.location.href = routePasswordRequest;
        }, 5000);
    }
}
