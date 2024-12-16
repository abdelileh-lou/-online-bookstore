    <?php
    session_start();
    $conn = new mysqli("localhost", "zaki", "louhichi25", "online_bookstore", 3307);

    

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT email, password FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Compare the entered password with the hashed password stored in the database
        if (password_verify($password, $row["password"])){
           $_SESSION['logged_in'] = true; // Set a session variable
           $_SESSION['email'] = $email;  // Optionally store email
           header("Location: dashboard.php");
           exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found.";
    }
}


 


    
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Online Book Store</title>
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .login-container .form-control {
            border-radius: 5px;
        }

        .login-container button {
            border-radius: 5px;
        }

        .login-container h3 {
            margin-bottom: 1.5rem;
        }

        .login-container .form-text {
            font-size: 0.9rem;
        }
        </style>
    </head>

    <body>
        <div class="login-container">
            <h3 class="text-center">Login to Your Account</h3>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                        required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <div class="text-center mt-3">
                    <p class="form-text">Don't have an account? <a href="register.php">Register here</a></p>
                </div>
            </form>
        </div>

        <!-- Bootstrap 5 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>