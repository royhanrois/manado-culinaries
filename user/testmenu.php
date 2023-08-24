<?php 
require_once '../config/config.php';

$id = $_SESSION["user"];
$users = query("SELECT * FROM users WHERE user_id = $id")[0];
$resto = query("SELECT * FROM restoran WHERE user_id = $id")[0];

if (empty($resto)) {
  header("Location: createRestaurant.php"); // Redirect to createRestaurant.php
  exit;
}

// Fetch menu data for autocomplete
$rekomendasi = fetchMenuAvail(); // Assuming fetchMenuAvail is defined in your config.php or another included file

if (isset($_POST["createMenu"])) {
  $menuItems = $_POST["menuItems"];
  $result = createMenu($menuItems);
  if ($result > 0) {
    echo "success";
  } else {
    echo "error";
  }
  exit; // Stop further processing of the PHP code
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="shortcut icon" href="img/manacul-icon.png">
    <link rel="stylesheet" type="text/css" href="../css/user2.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Load jQuery UI Autocomplete -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

<!-- Load Bootstrap scripts -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container-sm">
    <h1>Menu</h1><br>
    <form id="MenuForm" onsubmit="testmenu(event)" method="post" action="">
      <label for="menuItems">Highlighted Menu:</label>
      <input
        type="text"
        id="inputField"
        name="menuItems[]"
        class="form-control"
        placeholder="Add your menu"
        style="width: 40%;"
      />
      <br>
      <p>Selected Menu:</p>
      <div id="menuList">
        <!-- Tempat untuk menampilkan menu yang telah ditambahkan -->
      </div>
      <button type="submit" class="btn btn-primary" id="createMenu" name="createMenu" style="margin-top: 40px">Submit</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    var rekomendasi = <?php echo fetchMenuAvail(); ?>;

    $(function() {
      $("#inputField").autocomplete({
        source: rekomendasi,
        select: function (event, ui) {
          event.preventDefault();
          $("#menuList").append(
            `<div class="btn-group mr-2 mb-2">
              <button type="button" class="btn btn-outline-secondary btn-menu">${ui.item.value}</button>
              <button type="button" class="btn btn-outline-secondary btn-remove" data-menu="${ui.item.value}">&times;</button>
            </div>`
          );
          $(this).val("");
        },
      });

      $("#menuList").on("click", ".btn-remove", function () {
        $(this).parent().remove();
      });

      function testmenu(event) {
        
  event.preventDefault();
  debugger;
  console.log("Function called");

  var menuItems = [];
  $(".btn-menu").each(function () {
      menuItems.push($(this).text());
  });

  $.ajax({
      url: "testmenu.php", // Change this to the correct path to your processMenu.php script
      type: "POST",
      data: {
          createMenu: true,
          menuItems: menuItems
      },
      success: function (response) {
          if (response === "success") {
              alert("Menu details submitted successfully!");
              loadPage("menu");
          } else {
              alert("Error submitting menu details.");
          }
      },
      error: function () {
          console.log("AJAX Request Failed!");
          alert("AJAX request failed!");
      },
  });
}
      function updateUrl(page) {
        history.pushState(null, "", "#" + page);
        loadPage(page);
      }

      // Handle the browser back button
      $(window).on("popstate", function (event) {
        if (event.originalEvent.state) {
          var page = event.originalEvent.state.page;
          loadPage(page);
        }
      });
    });
  </script>
</body>
</html>
