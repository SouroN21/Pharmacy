<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../Styles/login.css">
</head>
<body>
    <!-- 
        ! user :naveenu naveenu 
        ! Pharmacy :Pharmacy , Pharmacy
        ! pharmacist :na123,na123
        ! admin :naveen , na123
    -->
    <div class="login-container">
        <h2>Login</h2>
        <div id="error" class="error">Invalid username or password.</div>
        <form id="loginForm" action="../PHP/login.php" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Login</button>

            <a href="register.php" class="href">Creare an Account</a>
        </form>
    </div>
    
</body>
</html>
