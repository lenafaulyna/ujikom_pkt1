<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #9195F6, #B7C9F2);
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 30px; /* Adjusted padding */
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.9); /* Adjusted background color with opacity */
            box-shadow: 15px 15px 8px rgba(0, 0, 0, 0.2);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 10px; /* Adjusted margin */
            font-weight: bold; /* Added font weight */
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Added box-sizing */
        }
        .form-group button {
            width: 100%;
            padding: 8px 12px;
            background-color: #387ADF;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        #message {
            margin-top: 10px;
            padding: 10px;
            background-color: #dff0d8;
            border: 1px solid #c3e6cb;
            border-radius: 3px;
            color: #155724;
            display: none; /* Initially hidden */
        }
        .container form {
            text-align: center; /* Center align form elements */
        }
        .container a {
            color: #387ADF; /* Link color */
            text-decoration: none;
        }
        .container a:hover {
            text-decoration: underline; /* Hover effect for links */
        }
        .show-password-container {
            display: flex;
            align-items: center;
        }
        .show-password-label {
            margin-right: 95px;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <form id="resetForm" method="post" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="newPassword">New Password:</label>
                <input type="password" id="newPassword" name="newPassword" required>
            </div>
            <div class="form-group">
                <div class="show-password-container">
                    <input type="checkbox" id="showPasswordCheckbox" onchange="togglePassword()">
                    <label class="show-password-label" for="showPasswordCheckbox">Show Password</label>
                </div>
            </div>
            <div class="form-group">
                <button type="submit">Reset Password</button>
            </div>
            <div id="message"></div>
            <div class="card-footer text-center">
                <div class="small" style="font-weight: bold; font-size: 12px;">
                    <a href="login.php">Kembali ke halaman Login!</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("newPassword");
            var passwordCheckbox = document.getElementById("showPasswordCheckbox");
            if (passwordCheckbox.checked) {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }

        document.getElementById('resetForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            var username = document.getElementById('username').value;
            var newPassword = document.getElementById('newPassword').value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'reset_password_backend.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var messageDiv = document.getElementById('message');
                        messageDiv.style.display = 'block'; // Show the message
                        messageDiv.innerHTML = xhr.responseText;
                        setTimeout(function(){
                            window.location.href = 'login.php'; // Redirect after 3 seconds
                        }, 3000);
                    } else {
                        console.error('Error occurred.');
                    }
                }
            };
            xhr.send('username=' + username + '&newPassword=' + newPassword);
        });
    </script>
</body>
</html>
