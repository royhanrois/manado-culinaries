<?php
require_once '../config/config.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Store the entered data in the session
    $_SESSION["signup_data"]["name"] = $_POST["name"];
    header("Location: step2.php");
    exit;
}
?>
<style>
    body, html {
    height: 100%;
    }
</style>
<!DOCTYPE html>
<html>
<head>
    <title>Signup - Step 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/manacul-icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/signup.css" />
    <script src="https://kit.fontawesome.com/7e039003e6.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-xxl">
        <div class="formbox">
            <h2 class="text-center">Enter Your Name</h2>
            <br />
            <form action="index.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name" class="form-label">Name:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        </div>
                        <input
                            type="text"
                            class="form-control"
                            name="name"
                            id="name"
                        />
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

