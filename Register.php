<?php
session_start();


$conn = new mysqli("localhost", "zaki", "louhichi25", "online_bookstore", 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Save session data
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute SQL query
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            // Redirect to dashboard on success
            header("Location:dashboard.php");
        } else {
            $error_message = "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Online Bookstore</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
    body {
        background: linear-gradient(to right, #00c6ff, #0072ff);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .register-container {
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
    }

    .register-container h3 {
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .register-container .form-control {
        border-radius: 5px;
    }

    .register-container button {
        border-radius: 5px;
    }

    .alert {
        display: none;
    }
    </style>
</head>

<body>
    <div class="register-container">
        <h3>Create Your Account</h3>
        <form id="registerForm" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username"
                    required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                    required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Enter your password" required>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                    placeholder="Confirm your password" required>
            </div>
            <div id="errorContainer" class="alert alert-danger"></div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
            <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>

    <!-- JavaScript Validation -->
    <script>
    document.getElementById("registerForm").addEventListener("submit", function(e) {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;
        const errorContainer = document.getElementById("errorContainer");

        if (password !== confirmPassword) {
            e.preventDefault();
            errorContainer.style.display = "block";
            errorContainer.textContent = "Passwords do not match.";
        } else {
            errorContainer.style.display = "none";
        }
    });
    </script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>