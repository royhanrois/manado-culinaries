<?php
require '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $resId = $_POST["res_id"];

    $rowsAffected = deleteRes($resId);

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
    <title>Restaurant List</title>
    <link rel="shortcut icon" href="img/manacul-icon.png">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <style>
        /* Vertically center text in table cells */
        .table td, .table th {
            vertical-align: middle;
        }
    </style>
    <div class="container mt-4">
        <h1>Restaurant List</h1><br><br>
        <table class="table">
        <thead>
            <tr>
                <th>Restaurant Logo</th>
                <th>Restaurant ID</th>
                <th>User ID</th>
                <th>Restaurant Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Website</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php    
            // Fetch restaurants
            $restaurants = fetchRestaurantsAdmin();

            foreach ($restaurants as $restaurant) {
                $logoUrl = fetchLogoRes($restaurant['res_id']);
            ?>
            <tr>
                <td><img style="width: 70px;" src="<?= $logoUrl ?>" class="img-thumbnail" alt="Restaurant Logo"></td>
                <td><?= $restaurant['res_id'] ?></td>
                <td><?= $restaurant['user_id'] ?></td>
                <td><?= $restaurant['res_name'] ?></td>
                <td><?= $restaurant['address'] ?></td>
                <td><?= $restaurant['notelp'] ?></td>
                <td><a href="<?= $restaurant['site_address'] ?>" target="_blank" class="btn btn-primary">Visit Website</a></td>
                
                <!-- Action dropdown menu -->
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" onclick="editRes(<?= $restaurant['res_id']; ?>)">Edit</a>
                            <a class="dropdown-item" onclick="deleteRes(<?= $restaurant['res_id']; ?>)">Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    function deleteRes(resId) {
        console.log("Deleting restaurant with ID:", resId);
        
        var confirmation = confirm("Are you sure you want to delete this restaurant with id " + resId + "?");
        if (confirmation) {
            console.log("Confirmed, sending AJAX request...");
            
            $.ajax({
                type: "POST",
                url: "adminRestaurant.php",
                data: { res_id: resId },
                success: function(response) {
                    console.log("AJAX response:", response);
                    
                    if (response === "success") {
                        console.log(response);
                        alert("Restaurant with ID " + resId + " has been deleted.");
                        window.location.reload(); 

                    } else {
                        console.log(response);
                        alert("Failed to delete restaurant.");
                    }
                },
                error: function(xhr, status, error) {
                    console.log("AJAX error:", status, error);
                    alert("An error occurred while trying to delete the restaurant.");
                }
            });
        }
    }

    function editRes(resId) {
        console.log("Edit function called with resId:", resId);
    $.ajax({
        type: "POST",
        url: "adminEditRes.php",
        data: {
            res_id: resId
        },
        dataType: "html",
        success: function (response) {
            console.log("AJAX Success:", response);
            $(".content").html(response); // Replace the content in the side panel with the content from the edit page  
        },
        error: function () {
            alert("Failed to load restaurant edit page.");
        },
    });
}

    </script>
    </script>

</body>
</html>
