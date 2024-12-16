<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Bookstore</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
    body {
        background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: 'Arial', sans-serif;
    }

    .logout-container {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        padding: 50px;
        text-align: center;
        max-width: 500px;
        width: 100%;
        transform: perspective(1000px) rotateX(-10deg);
        transition: all 0.5s ease;
    }

    .logout-container:hover {
        transform: perspective(1000px) rotateX(0);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
    }

    .logout-icon {
        font-size: 100px;
        background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 30px;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }
    }

    h2 {
        color: #6a11cb;
        font-weight: bold;
        margin-bottom: 20px;
    }

    p {
        color: #555;
        margin-bottom: 30px;
    }

    .btn-login {
        background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        transform: translateY(-5px);
        box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #555f66;
        transform: translateY(-5px);
    }
    </style>
</head>

<body>
    <div class="logout-container">
        <div class="logout-icon">
            <i class="fas fa-sign-out-alt"></i>
        </div>
        <h2>Logged Out Successfully</h2>
        <p>You have been safely logged out of your account. We hope to see you again soon!</p>

        <div class="mt-4">
            <a href="login.php" class="btn btn-primary btn-lg btn-login me-2">
                <i class="fas fa-sign-in-alt me-2"></i>Log In Again
            </a>
            <a href="index.php" class="btn btn-secondary btn-lg">
                <i class="fas fa-home me-2"></i>Home
            </a>
        </div>
    </div>

    <!-- PHP Logout Session Handling -->
    <?php
    session_start();
    
    // Unset all session variables
    $_SESSION = array();
    
    // Destroy the session
    session_destroy();
    
    // Delete the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>