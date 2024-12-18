<?php
session_start();
require('/xampp/htdocs/E-Project/db.php');

// Handle Registration
if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $password, $role);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful. Please log in.";
    } else {
        $_SESSION['error'] = "Error: Could not register.";
    }

    $stmt->close();
    header("Location: index.php");
    exit;
}

// Handle Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = trim($_POST['password']);

    // Query to retrieve user data by username
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify the provided password against the hashed password
        if (password_verify($password, $user['password'])) {
            // Store user info in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'hospital') {
                header("Location: /E-project/Doctor/index.html");
            } elseif ($user['role'] === 'patient') {
                header("Location: /E-Project/Covid-19-Management-system-main/book_appointment.php");
            } else {
                header("Location: index.php"); // Default fallback
            }
            exit;
        } else {
            // Password mismatch
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: index.php");
            exit;
        }
    } else {
        // Username not found
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: index.php");
        exit;
    }
}

// Redirect to login page if accessed directly
header("Location: /E-project/Login/Registration/login.php");
exit;

?>
    