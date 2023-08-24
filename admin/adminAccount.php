<?php
require_once '../config/config.php';
$id = $_SESSION["user"];
$users = query("SELECT * FROM users WHERE user_id = $id")[0];

if (isset($_POST["updateUser"])) {
  $result = updateUser($_POST);
  if ($result > 0) {
    echo "success";
  } else {
    echo "error";
  }
  exit; // Stop further processing of the PHP code
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>User Profile</title>
  <link rel="shortcut icon" href="img/manacul-icon.png">
  <link rel="stylesheet" type="text/css" href="../css/user2.css" />
  <!-- Add Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body>
  <div class="container mt-5">
    <h1>User Profile</h1>

    <div class="row mt-4">
      <div class="col-md-6">
        <!-- Display User's Data Here -->
        <form id="profileForm" onsubmit="updateProfile(event)" method="post" action="account.php"> <!-- Change "account.php" to the appropriate PHP file if needed -->
          <div class="form-group">
            <label>Email:</label>
            <input type="email" class="form-control" name="email" id="email" value="<?= $users["email"]; ?>" /> <!-- Use "email" as the name attribute -->
          </div>
          <div class="form-group">
            <label>Name:</label>
            <input type="text" class="form-control" name="name" id="name" value="<?= $users["name"]; ?>" /> <!-- Use "name" as the name attribute -->
          </div>
          <div class="form-group">
            <label>Password:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="*Type here if you want to change your password." />
            <button type="button" class="btn btn-outline-secondary btn-sm" style="margin-top: 10px" onmousedown="showPassword()" onmouseup="hidePassword()">Show Password</button>
          </div>
          <br>
          <input type="hidden" name="user_id" value="<?= $users["user_id"]; ?>">
          <button type="submit" class="btn btn-primary" name="updateUser">Save Changes</button>
        </form>

      </div>
    </div>
  </div>

  <!-- Add Bootstrap JS and jQuery -->
  
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Add your custom JavaScript -->
 
  <script>
  //reload submit page
  function updateProfile(event) {
    event.preventDefault(); // Prevent the default form submission behavior

    // Get the form data
    var formData = new FormData(event.target);

    // Append the 'updateUser' field to the form data
    formData.append('updateUser', true);

    // Send the AJAX request
    $.ajax({
    url: "account.php",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      // Check if the AJAX request was successful
      if (response === "success") {
        alert("User Berhasil Diubah"); // Success message
        loadPage("account"); // Reload the content on the account page after successful update
      } else {
        alert("User Gagal Diubah"); // Error message
      }
    },
    error: function () {
      console.log("AJAX Request Failed!");
      alert("AJAX request failed!"); // Failed AJAX request
    },
  });
}
  //showing password
  var passwordInput = document.getElementById("password");

  function showPassword() {
    passwordInput.type = "text";
  }

  function hidePassword() {
    passwordInput.type = "password";
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
