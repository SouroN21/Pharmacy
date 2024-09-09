document.getElementById('loginForm').addEventListener('submit', function(event) {
   
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();
    const errorDiv = document.getElementById('error');

    if (username === '' || password === '') {
        event.preventDefault();
        errorDiv.textContent = 'Please enter both username and password.';
        errorDiv.style.display = 'block';
    } else {       
        errorDiv.style.display = 'none';   
    }
});