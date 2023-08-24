<?php
require_once '../config/config.php';

if (!isset($_SESSION["user"])) {
  $_SESSION["message"] = "You need to log in first.";
  header("Location: ../login/login.php");
  exit(); // Stop further execution of the script
}

$id = $_SESSION["user"];
$result = query("SELECT * FROM users WHERE user_id = $id")[0];
$avatarUrl = fetchLogo($id, $conn); // Fetch the avatar from the restoran table

if ($result['roles'] !== 'user') {
  $_SESSION["message"] = "You are not authorized as a user.";
    header("Location: ../index.php");
}

?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Resto Owner</title>
    <link rel="shortcut icon" href="../img/manacul-icon.png">
    <link
      rel="stylesheet"
      type="text/css"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link rel="stylesheet" type="text/css" href="../css/user.css">

    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Load jQuery UI Autocomplete -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

    // Function to load content from a given page and inject it into the side panel
    function loadPage(page) {
      $.ajax({
        url: page + ".php",
        dataType: "html",
        success: function (data) {
          $(".content").html(data);

          // Remove active class from previous active nav link
          $(".nav-link.active").removeClass("active");

          // Add active class to current nav link
          $(".nav-link[data-page='" + page + "']").addClass("active");
        },
        error: function () {
          $(".content").html("<p>Halaman tidak ditemukan.</p>");
        },
      });
    }

    // Event handler for clicking on a navigation link
    $(document).on("click", ".nav-link", function (event) {
      event.preventDefault(); // Prevent the default behavior of the anchor tag
      var page = $(this).data("page");
      updateUrl(page);
    });

    // Function to update the URL hash and load the appropriate content
    function updateUrl(page) {
      history.pushState(null, "", "#" + page);
      loadPage(page);
    }

    // Function to get the current page from the URL hash
    function getCurrentPageFromUrl() {
      return window.location.hash ? window.location.hash.substring(1) : "home";
    }

    // Event handler for the browser back and forward buttons
    window.onhashchange = function () {
      var page = getCurrentPageFromUrl();
      loadPage(page);
    };

    // Load the initial content based on the URL fragment (hash) or default to "home"
    $(document).ready(function () {
      var initialPage = getCurrentPageFromUrl();
      loadPage(initialPage);
      $(".nav-link[data-page='" + initialPage + "']").addClass("active");
    });
  </script>



  </head>
  <body>
    <div class="container-fluid h-100">
      <div class="row h-100">
        <div class="col-md-2 side-panel">
          <div class="avatar">
            <!-- You can replace the img src with the user's avatar -->
            <?php
                if (!empty($avatarUrl) && file_exists($avatarUrl)) {
                    echo '<img src="' . $avatarUrl . '" alt="User Avatar" />';
                } else {
                    echo '<img src="../img/reslogo/avatar.png" alt="Default Avatar" />';
                }
                ?>

              <button class="edit-button" id="editPhotoLink" title="Edit Photo">Edit Photo</button>

            <script>
              document.getElementById("editPhotoLink").addEventListener("click", function (event) {
                event.preventDefault();
                loadPage("restaurant");
              });
            </script>

          </div>
          <nav class="nav flex-column">
            <a class="nav-link" href="#" data-page="home">Home</a>
            <a class="nav-link" href="#" data-page="restaurant">Restaurant</a>
            <a class="nav-link" href="#" data-page="menu">Menu</a>
            <a class="nav-link" href="#" data-page="account">Account</a>
          </nav>

          
          <div class="nav-bottom mt-auto btn-bawah" style="position: absolute; bottom: 0; left: 0; right: 0; margin: 0 30px 30px">
          <a class="btn btn-secondary btn-block" href="../index.php" style="color: white;">Back to Main Page</a>
          
          <br>
          <a class="btn btn-danger btn-block" href="../login/logout.php">Sign Out</a>
                    
          </div>
        </div>
        
        <div class="col-md-10">
          <div class="content">
            <!-- Content of your landing page goes here -->
          </div>
        </div>
      </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
