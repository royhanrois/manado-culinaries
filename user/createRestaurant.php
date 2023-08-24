<?php 

require_once '../config/config.php';
$id = $_SESSION["user"];
$users = query("SELECT * FROM users WHERE user_id = $id")[0];

if (isset($_POST["createRes"])) {
  $result = createRes($_POST);
  if ($result > 0) {
    echo "success";
  } else {
    echo "error";
  }
  exit; // Stop further processing of the PHP code
}

if (isset($_GET["message"])) {
  $message = $_GET["message"];
  echo "<script>alert('$message');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Restaurant Form</title>
  <link rel="shortcut icon" href="../img/manacul-icon.png">
  <link rel="stylesheet" type="text/css" href="../css/user2.css" />
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body>
  <div class="container">
    <h1>Restaurant Details Form</h1>
    <form onsubmit="createRestaurant(event)" action="" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="restaurant_name">Restaurant Name:</label>
        <input type="text" class="form-control" id="res_name" name="res_name" required>
      </div>
      <div class="form-group">
        <label for="phone_number">Phone Number:</label>
        <input type="number" class="form-control" id="notelp" name="notelp" required>
      </div>
      <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" class="form-control" id="address" name="address" required>
      </div>
      <div class="form-group">
        <label for="site_address">Site Address:</label>
        <input type="text" class="form-control" id="site_address" name="site_address" required>
      </div>
      <div class="form-group">
        <label for="restaurant_logo">Restaurant Logo:</label>
        <input type="file" class="form-control-file" id="res_logo" name="res_logo" required>
      </div>
      <button type="submit" class="btn btn-primary" id="createRes" name="createRes">Submit</button>
    </form>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <script>
    function createRestaurant(event) {
    event.preventDefault(); // Prevent the default form submission behavior

    // Get the form data
    var formData = new FormData(event.target);

    // Append the 'createRes' field to the form data
    formData.append('createRes', true);

    // Send the AJAX request
    $.ajax({
      url: "createRestaurant.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        // Check if the AJAX request was successful
        if (response === "success") {
          alert("Restaurant details submitted successfully!"); // Success message
          loadPage("createMenus"); // Reload the content on the restaurant page after successful creation
        } else {
          alert("Error submitting restaurant details."); // Error message
        }
      },
      error: function () {
        console.log("AJAX Request Failed!");
        alert("AJAX request failed!"); // Failed AJAX request
      },
    });
  }

  // Handle the browser back button
  $(window).on("popstate", function (event) {
    if (event.originalEvent.state) {
      var page = event.originalEvent.state.page;
      loadPage(page);
    }
  });
</script>
</body>
</html>
