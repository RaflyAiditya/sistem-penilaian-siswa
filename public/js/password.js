let isPasswordValid = false;
let isPasswordMatch = false;

function checkPassword() {
    const password = document.getElementById('password').value;
    const requirements = document.getElementById('passwordRequirements');
    const lengthCheck = document.getElementById('lengthCheck');

    // // Tampilkan requirements saat user mulai mengetik
    // if (password.length > 0) {
    //     requirements.style.display = 'block';
    // } else {
    //     requirements.style.display = 'none';
    //     isPasswordValid = false;
    //     updateSubmitButton();
    //     return;
    // }

    // Jika password kosong
    if (password.length === 0) {
        requirements.style.display = 'none';
        isPasswordValid = false;
        isPasswordMatch = false;
        // Reset konfirmasi password dan pesannya
        document.getElementById('password_confirmation').value = '';
        document.getElementById('passwordMatchMessage').style.display = 'none';
        updateSubmitButton();
        return;
    }

    // Tampilkan requirements saat user mulai mengetik
    requirements.style.display = 'block';

    // Cek panjang minimal
    if (password.length >= 8) {
        lengthCheck.style.color = '#198754';
        lengthCheck.querySelector('i').className = 'fa-solid fa-check';
        isPasswordValid = true;
    } else {
        lengthCheck.style.color = '#dc3545';
        lengthCheck.querySelector('i').className = 'fa-solid fa-xmark';
        isPasswordValid = false;
    }

    // Panggil checkPasswordMatch untuk memperbarui status kecocokan
    checkPasswordMatch();
    updateSubmitButton();
}

function checkPasswordMatch() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('password_confirmation').value;
    const message = document.getElementById('passwordMatchMessage');

    if (password === '' || confirmPassword === '') {
        message.style.display = 'none';
        isPasswordMatch = false;
        updateSubmitButton();
        return;
    }

    if (password !== confirmPassword) {
        message.style.display = 'block';
        message.textContent = 'Password tidak cocok!';
        message.style.color = '#dc3545';
        isPasswordMatch = false;
    } else {
        message.style.display = 'block';
        message.textContent = 'Password cocok!';
        message.style.color = '#198754';
        isPasswordMatch = true;
    }

    updateSubmitButton();
}

function updateSubmitButton() {
    // const submitBtn = document.getElementById('submitBtn');
    // // Tombol submit hanya aktif jika password valid DAN cocok
    // submitBtn.disabled = !(isPasswordValid && isPasswordMatch);

    const submitBtn = document.getElementById('submitBtn');
    const password = document.getElementById('password').value;
    
    // Enable tombol jika password kosong ATAU (password valid DAN cocok)
    submitBtn.disabled = !(password === '' || (isPasswordValid && isPasswordMatch));
}

// Toggle password visibility
document.getElementById('togglePassword').addEventListener('click', function() {
    const password = document.getElementById('password');
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    
    // Toggle icon
    const icon = this.querySelector('i');
    icon.classList.toggle('fa-eye');
    icon.classList.toggle('fa-eye-slash');
});

document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
    const password = document.getElementById('password_confirmation');
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    
    // Toggle icon
    const icon = this.querySelector('i');
    icon.classList.toggle('fa-eye');
    icon.classList.toggle('fa-eye-slash');
});