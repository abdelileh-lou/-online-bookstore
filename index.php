<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Bookstore</title>
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
    /* Books Carousel Section */
    .books-carousel {
        width: 100%;
        overflow: hidden;
        position: relative;
        background-color: #f8f9fa;
        /* Background color for the carousel */
        padding: 20px 0;
    }

    .book-container {
        display: flex;
        animation: moveBooks 20s linear infinite;
    }

    .book {
        flex: 0 0 auto;
        /* Prevents books from shrinking */
        margin-right: 30px;
        /* Space between books */
        text-align: center;
    }

    .book img {
        width: 150px;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .book img:hover {
        transform: scale(1.1);
        /* Hover effect for enlarging book image */
    }

    .book p {
        margin-top: 10px;
        font-size: 16px;
        font-weight: bold;
    }

    /* Animation for moving the books */
    @keyframes moveBooks {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-100%);
        }
    }
    </style>
</head>

<body>
    <!-- Navbar -->
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
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Admin Dashboard</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search books" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Landing Section -->
    <div class="landing">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <h1>We're Growing - And We Want Your Ideas!</h1>
                    <p>We are expanding our online bookstore and looking for innovative suggestions from our community.
                        Your input matters! Whether it's new features, book categories, or unique services, we're eager
                        to hear how we can make our bookstore even better.</p>
                    <a href="#" class="btn btn-warning mt-3">Share Your Ideas</a>
                </div>
                <div class="col-md-6 text-center">
                    <img src="../miniProject/images/10306296.png" alt="Book Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- Books Carousel Section -->
    <div class="books-carousel">
        <div class="book-container">
            <div class="book">
                <img src="./images/Our-Missing-Hearts-Celeste-Ng-091922-0e49e83f9b09410688515f4d2e85f5e7.jpg"
                    alt="Book 1">
                <p>Our Missing Heart</p>
            </div>
            <div class="book">
                <img src="./images/544x840.jpg" alt="Book 2">
                <p>Code</p>
            </div>
            <div class="book">
                <img src="./images/images.png" alt="Book 3">
                <p>THE 7th HABITS OF PEOPLE</p>
            </div>
            <!-- Add more books here as needed -->
        </div>
    </div>

    <!-- Services Section -->
    <div class="services">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 p-3">
                    <div class="serv-box">
                        <i class="fa-solid fa-dollar-sign fa-2x mb-3 text-primary"></i>
                        <h3>Affordable Prices</h3>
                        <p>Find books at unbeatable prices.</p>
                    </div>
                </div>
                <div class="col-md-3 p-3">
                    <div class="serv-box">
                        <i class="fa-solid fa-book fa-2x mb-3 text-primary"></i>
                        <h3>High Quality</h3>
                        <p>Only the best books for our customers.</p>
                    </div>
                </div>
                <div class="col-md-3 p-3">
                    <div class="serv-box">
                        <i class="fa-solid fa-user fa-2x mb-3 text-primary"></i>
                        <h3>24/7 Support</h3>
                        <p>We're here to help anytime you need.</p>
                    </div>
                </div>
                <div class="col-md-3 p-3">
                    <div class="serv-box">
                        <i class="fa-solid fa-cart-shopping fa-2x mb-3 text-primary"></i>
                        <h3>Free Delivery</h3>
                        <p>Fast and free delivery on all orders.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-light py-3">
        <div class="container text-center">
            <p>&copy; 2024 Online Bookstore. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Optional: Add more books dynamically using JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        const books = [{
                image: './images/Our-Missing-Hearts-Celeste-Ng-091922-0e49e83f9b09410688515f4d2e85f5e7.jpg',
                title: 'Our Missing Heart'
            },
            {
                image: './images/544x840.jpg',
                title: 'Code'
            },
            {
                image: './images/images.png',
                title: 'THE 7th HABITS OF PEOPLE'
            }
        ];

        const container = document.querySelector('.book-container');
        books.forEach(book => {
            const bookElement = document.createElement('div');
            bookElement.classList.add('book');
            bookElement.innerHTML = `<img src="${book.image}" alt="${book.title}"><p>${book.title}</p>`;
            container.appendChild(bookElement);
        });
    });
    </script>
</body>

</html>