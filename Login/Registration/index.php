<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Login & Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-group button:hover {
            background: #0056b3;
        }

        .toggle-link {
            text-align: center;
            margin-top: 10px;
        }

        .toggle-link a {
            color: #007BFF;
            text-decoration: none;
        }

        .toggle-link a:hover {
            text-decoration: underline;
        }

        .error, .success {
            color: white;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .error {
            background-color: #dc3545;
        }

        .success {
            background-color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <h2 id="form-title">Login</h2>
        <form id="auth-form" method="POST" action="auth.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="patient">Patient</option>
                    <option value="hospital">Hospital</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" name="login">Login</button>
            </div>
        </form>
        <div class="toggle-link">
            <a href="#" id="toggle-form">New here? Register</a>
        </div>
    </div>

    <script>
        const form = document.getElementById('auth-form');
        const formTitle = document.getElementById('form-title');
        const toggleLink = document.getElementById('toggle-form');
        const roleSelect = document.getElementById('role');

        toggleLink.addEventListener('click', (e) => {
            e.preventDefault();

            if (formTitle.innerText === 'Login') {
                formTitle.innerText = 'Register';
                toggleLink.innerText = 'Already registered? Login';
                form.innerHTML = `
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select id="role" name="role" required>
                            <option value="patient">Patient</option>
                            <option value="hospital">Hospital</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="register">Register</button>
                    </div>
                `;
            } else {
                formTitle.innerText = 'Login';
                toggleLink.innerText = 'New here? Register';
                form.innerHTML = `
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select id="role" name="role" required>
                            <option value="patient">Patient</option>
                            <option value="hospital">Hospital</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login">Login</button>
                    </div>
                `;
            }
        });
    </script>
</body>
</html>
