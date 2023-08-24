<?php
require_once '../config/config.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Store the entered data in the session
    $_SESSION["signup_data"]["email"] = $_POST["email"];
    
    // Redirect to step3.php to continue the signup process
    header("Location: step3.php");
    exit;
}
?>

<!-- Rest of the HTML code remains the same -->


<!DOCTYPE html>
<html>
<head>
    <title>Signup - Step 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/signup.css" />
    <link rel="shortcut icon" href="img/manacul-icon.png">
    <script src="https://kit.fontawesome.com/7e039003e6.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-xxl">
        <div class="formbox" >
            <h2 class="text-center">Enter Your Email</h2>
            <br />
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        </div>
                        <input type="email" class="form-control" name="email" id="email" />
                    </div>
                    <br><br>
                    <!-- Back and Next buttons in a row -->
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-secondary" onclick="goBack()">Back</button>
                        </div>
                        <div class="col-6 text-right">
                            <button type="submit" class="btn btn-primary" name="submit">Next</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // JavaScript function to navigate back to the previous page
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
