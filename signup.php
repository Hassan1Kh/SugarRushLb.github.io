<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin/styles.css">
</head>
<body>
    <div class="particles-js" id="particles-js"></div>
    <div class="container">
        <form id="registration-form" action="admin/add.php" method="POST" onsubmit="return validateForm()">
            <div class="title">Registration</div>

            <div class="input-box underline">
                <input type="text" id="username" name="username" placeholder="Enter Your Name" required />
                <div class="underline"></div>
            </div>

            <div class="input-box underline">
                <input type="email" id="email" name="email" placeholder="Enter Your Email" required />
                <div class="underline"></div>
            </div>

            <div class="input-box underline">
                <input type="password" id="password" name="passworder"  placeholder="Enter Your Password" required />
                <div class="underline"></div>
            </div>

            <div class="input-box underline">
                <input type="tel" id="mobile" name="mobile" placeholder="Enter Your Mobile Number" required />
                <div class="underline"></div>
            </div>

            <div class="input-box underline">
                <input type="text" id="location" name="location" placeholder="Enter Your Location" required />
                <div class="underline"></div>
            </div>

            <div class="input-box button">
                <input type="submit" value="Register" />
            </div>
        </form>
        <div class="option">Already have an account?! <a href="admin_login.php">Login</a></div>
        <div class="option">Home page?! <a href="index.php">Sugar Rush</a></div>  
    </div>

    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="admin/script.js"></script>
    <script>
        function validateForm() {
            var username = document.getElementById('username').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var mobile = document.getElementById('mobile').value;
            var location = document.getElementById('location').value;

            // Basic name validation
            if (username.trim() === '') {
                alert('Please enter your name');
                return false;
            }

            // Basic email format validation using HTML5
            if (!email.includes('@')) {
                alert('Please enter a valid email address');
                return false;
            }

            // Password length validation
            if (password.length < 6 || password.length >16 ) {
                alert('Password must be at least 6 characters long');
                return false;
            }
            // Password character validation
 var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
        if (!passwordRegex.test(password)) {
            alert('Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character');
            return false;
        }

            // Basic mobile number validation
            if (isNaN(mobile) || mobile.length !== 8) {
                alert('Please enter a valid 10-digit mobile number');
                return false;
            }

            // Basic location validation
            if (location.trim() === '') {
                alert('Please enter your location');
                return false;
            }

            return true; // If all validations pass, submit the form
        }
    </script>
</body>
</html>
