function signup() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    const number = document.getElementById('number').value;
    if (password !== confirmPassword) {
        alert('Passwords do not match');
        return;
    }
    if (email === '' || password === '' || confirmPassword === '' || number === '') {
        alert('Please fill in all fields');
        return;
    }
    if (number.length !== 8) {
        alert('Phone number must be 8 digits');
        return;
    }
    if (password.length < 8) {
        alert('Password must be at least 8 characters');
        return;
    }
    return true;
}
