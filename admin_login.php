<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin/styles.css">
</head>
<body>
    <div class="particles-js" id="particles-js"></div>
    <div class="container">
        <form id="login-form" action="admin/Login_Process.php" method="POST" onsubmit="return validateForm()">
            <div class="title">Login</div>
            <div class="input-box underline">
                <input type="email" id="email" name="email" placeholder="Enter Your Email" required />
                <div class="underline"></div>
            </div>
            <div class="input-box">
                <input type="password" id="password" name="passworder"  placeholder="Enter Your Password" required />
                <div class="underline"></div>
            </div>
            <div class="input-box button">
                <input type="submit" value="Login" />
            </div>
        </form>
        <div class="option">Don't have an account?! <a href="signup.php">Signup</a></div>
        <div class="option">Home page?! <a href="index.php">Sugar Rush</a></div>
    </div>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="admin/script.js"></script>
    <script>
        function validateForm() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            
            // Basic email format validation using HTML5
            if (!email.includes('@')) {
                alert('Please enter a valid email address');
                return false;
            }
            
            // Password length validation
            if (password.length < 6 || password.length >16 ) {
                alert('Password must be at least 6 characters long and max 16 characters');
                return false;
            }
 // Password character validation
 var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
        if (!passwordRegex.test(password)) {
            alert('Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character');
            return false;
        }
            // You can add more advanced validation here if needed
            
            return true; // If all validations pass, submit the form
        }
    </script>
</body>
</html>
