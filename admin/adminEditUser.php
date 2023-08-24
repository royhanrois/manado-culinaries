<?php
require '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["action"] === "edit") {
        $userId = $_POST["user_id"];
        // Fetch the user's current details from the database
        $currentUser = query("SELECT * FROM users WHERE user_id = $userId")[0];
        $name = $currentUser["name"];
        $email = $currentUser["email"];

        // Process the form data and update the user
        $updatedData = [
            "user_id" => $userId,
            "name" => $_POST["name"],
            "email" => $_POST["email"],
            "password" => $_POST["password"] // Make sure to validate and hash the password
        ];

        $rowsAffected = updateUser($updatedData);

            if ($rowsAffected > 0) {
                echo "success";
            } else {
                echo "error";
            }
            exit;
    }
} else {
    // Fetch the user details based on the user_id in the URL query parameter
    if (isset($_GET["user_id"])) {
        $userId = $_GET["user_id"];
        $userDetails = query("SELECT * FROM users WHERE user_id = $userId")[0];
        $name = $userDetails["name"];
        $email = $userDetails["email"];
    } else {
        // Redirect to the adminUsers.php page if no user_id is provided
        header("Location: adminUsers.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="shortcut icon" href="img/manacul-icon.png">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Edit User</h1>
        <form method="post" action="adminEditUser.php">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="user_id" value="<?= $userId; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $name; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $("form").on("submit", function (e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: "adminEditUser.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response === "success") {
                            alert("User Berhasil Diubah");
                            window.location.reload(); 
                        } else {
                            alert("User Gagal Diubah");
                        }
                    },
                    error: function () {
                        console.log("AJAX Request Failed!");
                        alert("AJAX request failed!");
                    },
                });
            });
        });
    </script>
</body>
</html>
