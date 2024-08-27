<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../Styles/register.css">
    <script>
        function showFormFields() {
            const userType = document.getElementById('user_type').value;
            document.querySelectorAll('.form-group').forEach(group => {
                group.style.display = 'none';
            });
            document.querySelector(`#${userType}_form`).style.display = 'block';
        }
    </script>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        
        <?php
        session_start();
        if (isset($_SESSION['error'])) {
            echo "<div class='error'>{$_SESSION['error']}</div>";
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo "<div class='success'>{$_SESSION['success']}</div>";
            unset($_SESSION['success']);
        }
        ?>
        
        <form action="../PHP/register.php" method="POST">
            <label for="user_type">Select User Type</label>
            <select id="user_type" name="user_type" onchange="showFormFields()" required>
                <option value="">--Select--</option>
                <option value="user">User</option>
                <option value="pharmacy">Pharmacy</option>
                <option value="pharmacist">Pharmacist</option>
            </select>
            
            <!-- User Registration Form -->
            <div id="user_form" class="form-group" style="display: none;">
                <label for="username_user">Username</label>
                <input type="text" id="username_user" name="username" placeholder="Enter your username" required>
                
                <label for="password_user">Password</label>
                <input type="password" id="password_user" name="password" placeholder="Enter your password" required>
                
                <label for="confirm_password_user">Confirm Password</label>
                <input type="password" id="confirm_password_user" name="confirm_password" placeholder="Confirm your password" required>
            </div>
            
            <!-- Pharmacy Registration Form -->
            <div id="pharmacy_form" class="form-group" style="display: none;">
                <label for="pharmacy_name">Pharmacy Name</label>
                <input type="text" id="pharmacy_name" name="pharmacy_name" placeholder="Enter your pharmacy name" required>
                
                <label for="pharmacy_username">Username</label>
                <input type="text" id="pharmacy_username" name="username" placeholder="Enter your username" required>
                
                <label for="pharmacy_password">Password</label>
                <input type="password" id="pharmacy_password" name="password" placeholder="Enter your password" required>
                
                <label for="pharmacy_confirm_password">Confirm Password</label>
                <input type="password" id="pharmacy_confirm_password" name="confirm_password" placeholder="Confirm your password" required>
            </div>
            
            <!-- Pharmacist Registration Form -->
            <div id="pharmacist_form" class="form-group" style="display: none;">
                <label for="pharmacist_name">Name</label>
                <input type="text" id="pharmacist_name" name="name" placeholder="Enter your name" required>
                
                <label for="pharmacist_username">Username</label>
                <input type="text" id="pharmacist_username" name="username" placeholder="Enter your username" required>
                
                <label for="pharmacist_password">Password</label>
                <input type="password" id="pharmacist_password" name="password" placeholder="Enter your password" required>
                
                <label for="pharmacist_confirm_password">Confirm Password</label>
                <input type="password" id="pharmacist_confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                
                <label for="license_number">License Number</label>
                <input type="text" id="license_number" name="license_number" placeholder="Enter your license number" required>
            </div>
            
            <button type="submit">Register</button>
            
            <a href="logi
