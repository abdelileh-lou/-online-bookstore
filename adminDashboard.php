<?php
session_start();
$conn = new mysqli("localhost", "zaki", "louhichi25", "online_bookstore", 3307);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Bookstore</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
    body {
        background-color: #f4f6f9;
    }

    .sidebar {
        height: 100vh;
        background-color: #2c3e50;
        color: white;
        position: fixed;
        left: 0;
        top: 0;
    }

    .content-area {
        margin-left: 250px;
        padding: 20px;
    }

    .card-header {
        background-color: #34495e;
        color: white;
    }

    .hidden {
        display: none;
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <div class="p-4">
                    <h4 class="text-center mb-5">
                        <i class="fas fa-user-shield me-2"></i>Admin Panel
                    </h4>
                    <nav class="nav flex-column">
                        <a class="nav-link text-white" href="#" id="dashboard-btn">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link text-white" href="#" id="manage-books-btn">
                            <i class="fas fa-book me-2"></i>Manage Books
                        </a>
                        <a class="nav-link text-white" href="#" id="user-list-btn">
                            <i class="fas fa-users me-2"></i>User List
                        </a>
                        <a class="nav-link text-white" href="logout.php">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="col-md-10 content-area">
                <!-- Dashboard Section -->
                <div id="dashboard" class="content-section">
                    <h1>Admin Dashboard</h1>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Books</h5>
                                    <?php
                                    $books_query = "SELECT COUNT(*) as book_count FROM book";
                                    $books_result = $conn->query($books_query);
                                    $books_count = $books_result ? $books_result->fetch_assoc()['book_count'] : 0;
                                    echo "<h2>{$books_count}</h2>";
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Users</h5>
                                    <?php
                                    $users_query = "SELECT COUNT(*) as user_count FROM users";
                                    $users_result = $conn->query($users_query);
                                    $users_count = $users_result ? $users_result->fetch_assoc()['user_count'] : 0;
                                    echo "<h2>{$users_count}</h2>";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Books Management Section -->
                <div id="books-management" class="content-section hidden">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-plus me-2"></i>Add New Book
                                </div>
                                <div class="card-body">
                                    <form action="add_book.php" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label class="form-label">Book Title</label>
                                            <input type="text" class="form-control" name="title" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Author</label>
                                            <input type="text" class="form-control" name="author" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Price</label>
                                            <input type="number" class="form-control" name="price" step="0.01" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Book Cover URL</label>
                                            <input type="url" class="form-control" name="book_cover">
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Add Book
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-list me-2"></i>Book List
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Author</th>
                                                <th>Price</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $books_list_query = "SELECT * FROM book";
                                            $books_list_result = $conn->query($books_list_query);
                                            while ($book = $books_list_result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>{$book['tittle']}</td>";
                                                echo "<td>{$book['author']}</td>";
                                                echo "<td>€{$book['price']}</td>";
                                                echo "<td>
                                                    <a href='edit_book.php?id={$book['id']}' class='btn btn-sm btn-warning'>
                                                        <i class='fas fa-edit'></i>
                                                    </a>
                                                    <a href='delete_book.php?id={$book['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>
                                                        <i class='fas fa-trash'></i>
                                                    </a>
                                                </td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Users Management Section -->
                <div id="users-management" class="content-section hidden">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-users me-2"></i>Registered Users
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $users_list_query = "SELECT * FROM users";
                                    $users_list_result = $conn->query($users_list_query);
                                    while ($user = $users_list_result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>{$user['user_id']}</td>";
                                        echo "<td>{$user['username']}</td>";
                                        echo "<td>{$user['email']}</td>";
                                        echo "<td>
                                            <a href='edit_user.php?id={$user['user_id']}' class='btn btn-sm btn-warning'>
                                                <i class='fas fa-edit'></i>
                                            </a>
                                            <a href='delete_user.php?user_id={$user['user_id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>
                                                <i class='fas fa-trash'></i>
                                            </a>
                                        </td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const dashboard = document.getElementById('dashboard');
        const booksManagement = document.getElementById('books-management');
        const usersManagement = document.getElementById('users-management');
        const dashboardBtn = document.getElementById('dashboard-btn');
        const manageBooksbtn = document.getElementById('manage-books-btn');
        const userListBtn = document.getElementById('user-list-btn');

        function hideAllSections() {
            dashboard.classList.add('hidden');
            booksManagement.classList.add('hidden');
            usersManagement.classList.add('hidden');
        }

        dashboardBtn.addEventListener('click', function() {
            hideAllSections();
            dashboard.classList.remove('hidden');
        });

        manageBooksbtn.addEventListener('click', function() {
            hideAllSections();
            booksManagement.classList.remove('hidden');
        });

        userListBtn.addEventListener('click', function() {
            hideAllSections();
            usersManagement.classList.remove('hidden');
        });

        dashboard.classList.remove('hidden');
    });
    </script>
</body>

</html>
<?php
$conn->close();
?>