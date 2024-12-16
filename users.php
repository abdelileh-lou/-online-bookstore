<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>

<body>
    <div class="tab-pane" id="users">
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
                            <th>Registration Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                        session_start();
                                        $conn = new mysqli("localhost", "zaki", "louhichi25", "online_bookstore", 3307);

                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }

                                        $query = "SELECT id, username, email FROM users";
                                        $result = $conn->query($query);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>{$row['id']}</td>";
                                                echo "<td>{$row['username']}</td>";
                                                echo "<td>{$row['email']}</td>";
                                                echo "<td>
                                                    <button class='btn btn-sm btn-info me-2'>
                                                        <i class='fas fa-eye'></i>
                                                    </button>
                                                    <button class='btn btn-sm btn-danger'>
                                                        <i class='fas fa-trash'></i>
                                                    </button>
                                                </td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>No users found.</td></tr>";
                                        }
                                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>