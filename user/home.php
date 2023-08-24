<?php
require_once '../config/config.php';
$id = $_SESSION["user"];
$restoData = query("SELECT * FROM restoran WHERE user_id = $id");
$restocheck = !empty($restoData) ? $restoData[0] : null;

$result = query("SELECT * FROM users WHERE user_id = $id")[0];
if ($result['roles'] !== 'user') {
  header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Home</title>
    <link rel="shortcut icon" href="../img/manacul-icon.png">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/user2.css" />
    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Load jQuery UI Autocomplete -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <style>
        h1 {
            color: rgb(190, 127, 1);
            animation: fadeIn 0.5s ease-in-out forwards;
        }
        .isi {
            animation: fadeIn 2s ease-in-out forwards;
        }
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
        label {
            color: rgb(255, 255, 255);
        }
    </style>
</head>
<body>

<br /><br />
<div class="container-fluid h-100">
    <div class="text-start">
        <h1>Welcome <?php echo isset($_SESSION["signup_data"]) ? ucwords($_SESSION["signup_data"]["name"]) : ucwords($_SESSION["name"]); ?>!</h1>
    </div>
    <br />


    <?php if (!empty($restocheck)): ?>
    <div class="isi">
        <h3>Your Restaurant has been promoted on our website!<br />

        <br />
    </div>
    <?php endif; ?>


    <?php if (empty($restocheck)): ?>
    <div class="isi">
        <h3>Lets Create your restaurant account!<br />

        <br />
        <a href="#" class="btn btn-primary load-content" data-page="createRestaurant.php">Create Restaurant Account</a>
        <a href="#" class="btn btn-primary load-content" data-page="createMenus.php">Create Menu</a>
    </div>
    <?php endif; ?>

</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        // Function to load content from the specified page and inject it into the side panel
        function loadPage(page) {
            $.ajax({
                type: "GET",
                url: page,
                dataType: "html",
                success: function (response) {
                    $(".content").html(response); // Replace the content in the side panel with the content from the specified page

                    // Remove active class from all nav links
                    $(".btn-primary").removeClass("active");

                    // Add active class to the corresponding nav link
                    $(".load-content[data-page='" + page + "']").addClass("active");
                },
                error: function () {
                    alert("Failed to load content from " + page);
                },
            });
        }

        // Attach click event handler to the buttons
        $(".load-content").on("click", function (event) {
            event.preventDefault(); // Prevent the default behavior of the anchor tag
            var page = $(this).data("page");
            loadPage(page);
        });
    });
    $(window).on("popstate", function (event) {
        if (event.originalEvent.state) {
            var page = event.originalEvent.state.page;
            loadPage(page);
        }
    });

</script>
</body>
</html>
