<?php
require '../config/config.php';

// Fetch users from the database
$users = query("SELECT * FROM users");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId = $_POST["user_id"];

    $rowsAffected = deleteUser($userId);

    if ($rowsAffected > 0) {
        echo "success";
    } else {
        echo "error";
    }
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Users</title>
    <link rel="shortcut icon" href="img/manacul-icon.png">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Admin Users</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user['user_id']; ?></td>
                        <td><?= $user['name']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td>
                            <button onclick="editUser(<?= $user['user_id']; ?>)" class="btn btn-primary">Edit</button>
                            <button onclick="deleteUser(<?= $user['user_id']; ?>)" class="btn btn-danger">Delete</button>


                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
    function deleteUser(userId) {
        console.log("Deleting user with ID:", userId);
        
        var confirmation = confirm("Are you sure you want to delete this user with id " + userId + "?");
        if (confirmation) {
            console.log("Confirmed, sending AJAX request...");
            
            $.ajax({
                type: "POST",
                url: "adminUsers.php",
                data: { user_id: userId },
                success: function(response) {
                    console.log("AJAX response:", response);
                    
                    if (response === "success") {
                        console.log(response);
                        alert("User with ID " + userId + " has been deleted.");
                        window.location.reload(); 

                    } else {
                        console.log(response);
                        alert("Failed to delete user.");
                    }
                },
                error: function(xhr, status, error) {
                    console.log("AJAX error:", status, error);
                    alert("An error occurred while trying to delete the restaurant.");
                }
            });
        }
    }

    function editUser(userId) {
    $.ajax({
        type: "GET",
        url: "adminEditUser.php?user_id=" + userId,
        dataType: "html",
        success: function (response) {
            $(".content").html(response); // Replace the content in the side panel with the content from the edit page  
        },
        error: function () {
            alert("Failed to load user edit page.");
        },
    });
    }

    </script>
    <script>


    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>
