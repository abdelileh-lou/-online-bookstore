<?php


session_start();


$conn = new mysqli("localhost", "zaki", "louhichi25", "online_bookstore", 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit();
}
$sql = "SELECT id, tittle, author, price, urlimage FROM book";
$result = $conn->query($sql);

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bookstore - Dashboard</title>

    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="css/main.css?v=1" />

    <!-- Normalize CSS -->
    <link rel="stylesheet" href="css/normalize.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Jomhuria&family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/all.min.css" />

    <style>
    /* Additional Dashboard-specific styles */
    .books-section {
        padding: 50px 0;
        background-color: #f4f4f4;
    }

    .books-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }

    .book-card {
        display: flex;
        flex-direction: column;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .book-card:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .book-card img {
        width: 100%;
        height: 350px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .book-card .card-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        justify-content: space-between;
    }

    .book-card h3 {
        margin-bottom: 10px;
        font-size: 1.2rem;
    }

    .btn-add-to-cart {
        margin-top: auto;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-add-to-cart:hover {
        background-color: #0056b3;
    }

    .btn-add-to-cart a {
        color: white;
        line-style: none;
    }

    .filter-section {
        margin-bottom: 30px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .books-grid {
            grid-template-columns: 1fr;
        }

        .book-card img {
            height: 400px;
        }
    }
    </style>
</head>

<body>
    <!-- Navbar (Identical to Index Page) -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Bookstore</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Admin Dashboard</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search books" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="shoppingCart.php">
                            <i class="fa-solid fa-cart-shopping"></i> Cart
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Books Dashboard Section -->
    <section class="books-section">
        <div class="container">
            <div class="row filter-section">
                <div class="col-12">
                    <h2 class="text-center mb-4">Our Book Collection</h2>
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <select class="form-control" id="categoryFilter">
                                <option value="">All Categories</option>
                                <option value="fiction">Fiction</option>
                                <option value="non-fiction">Non-Fiction</option>
                                <option value="science">Science</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="books-grid">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                <div class="book-card">
                    <img src="../miniProject/images/<?php echo htmlspecialchars($row['urlimage']);?>" alt="Book 1">
                    <div class="card-body">
                        <h3><?php echo htmlspecialchars($row['tittle']); ?></h3>
                        <p>Author: <?php echo htmlspecialchars($row['author']); ?></p>
                        <p>Price: $<?php echo number_format($row['price'], 2); ?></p>
                        <button class="btn-add-to-cart"><a href="shoppingCart.php?book_id=<?php echo $row['id']; ?>">Add
                                to Cart</a></button>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo "<p class='text-center'>No books found.</p>";
                }
                ?>

            </div>
        </div>


        </div>
    </section>

    <!-- Footer (Identical to Index Page) -->
    <footer class="text-light py-3">
        <div class="container text-center">
            <p>&copy; 2024 Online Bookstore. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript for Book Filtering and Cart -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryFilter = document.getElementById('categoryFilter');
        const bookCards = document.querySelectorAll('.book-card');
        const addToCartButtons = document.querySelectorAll('.btn-add-to-cart');

        // Category Filtering
        categoryFilter.addEventListener('change', function() {
            const selectedCategory = this.value;

            bookCards.forEach(card => {
                const bookCategory = card.querySelector('.card-text').textContent.toLowerCase();

                if (selectedCategory === '' || bookCategory.includes(selectedCategory)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Add to Cart Functionality
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function() {
                const bookId = this.getAttribute('data-book-id');

                // AJAX call to add book to cart
                fetch('add_to_cart.php', {
                        method: 'POST',
                        body: JSON.stringify({
                            book_id: bookId
                        }),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Book added to cart!');
                        } else {
                            alert('Failed to add book to cart.');
                        }
                    });
            });
        });
    });
    </script>
</body>

</html>