<?php
session_start();
// Database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'manacul';

$conn = mysqli_connect($host, $user, $password, $dbname);


// query
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


// Jumlah Data
function rows($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    return $rows;
}


// Users

function tambahUser($data)
{
    global $conn;
    $name = $data["name"];
    $email = stripslashes($data["email"]);
    $password = password_hash($data["password"], PASSWORD_DEFAULT);
    $roles = "user";

    $query = "INSERT INTO users (name, email, password, roles)
                VALUES ('$name', '$email', '$password', '$roles')
            ";

    if (mysqli_query($conn, $query)) {
        // Return the user ID of the inserted user
        return mysqli_insert_id($conn);
    } else {
        echo "Error: " . mysqli_error($conn);
        return -1; // Return a negative value to indicate an error occurred.
    }
}


function updateUser($data)
{
    global $conn;
    $id = $data["user_id"];
    $result = query("SELECT password FROM users WHERE user_id = $id")[0];
    $name = $data["name"];
    
    // Check if the password field is empty or not provided
    if (empty($data["password"])) {
        $password = $result["password"];
    } else {
        $password = password_hash($data["password"], PASSWORD_DEFAULT);
    }

    // Include the $email variable from the form data
    $email = $data["email"];

    $query = "UPDATE users SET
                name = '$name',
                email = '$email',
                password = '$password'
              WHERE user_id = $id
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);

    
}

// config.php

function createRes($data)
{
    global $conn;

    // Extract the form data
    $res_name = $data['res_name'];
    $notelp = $data['notelp'];
    $address = $data['address'];
    $maps_Address = $data['site_address'];
    $user_Id = $_SESSION['user'];

    // File Upload Handling
    $file_name = $_FILES['res_logo']['name'];
    $file_tmp = $_FILES['res_logo']['tmp_name'];
    $file_destination = '../img/reslogo/' . $file_name;

    $file_error = $_FILES['res_logo']['error'];
    if ($file_error !== UPLOAD_ERR_OK) {
    echo "File upload error: " . $file_error;
    return false;
    }

    // Check if the file was successfully uploaded
    if (is_uploaded_file($file_tmp)) {
        // File was successfully uploaded, continue with the database insertion
        if (move_uploaded_file($file_tmp, $file_destination)) {
            $query = "INSERT INTO restoran (res_name, notelp, address, site_address, res_logo, user_id) 
                      VALUES ('$res_name', '$notelp', '$address', '$maps_Address', '$file_destination', '$user_Id')";

            if (mysqli_query($conn, $query)) {
                return true; // Return true if the insertion was successful
            } else {
                echo "Error: " . mysqli_error($conn);
                return false; // Return false if there was an error in the insertion
            }
        } else {
            echo "Failed to upload the file.";
            return false; // Return false if the file upload failed
        }
    } else {
        echo "Invalid file upload.";
        return false; // Return false if the file upload was invalid
    }
}

// Function to update restaurant details
function updateRes($data)
{
    global $conn;

    // Extract the form data
    $res_name = $data['res_name'];
    $notelp = $data['notelp'];
    $address = $data['address'];
    $maps_Address = $data['site_address'];
    $user_Id = $data['user_id'];

    // File Upload Handling (Only if you want to update the logo)
    if ($_FILES['res_logo']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['res_logo']['name'];
        $file_tmp = $_FILES['res_logo']['tmp_name'];
        $file_destination = '../img/reslogo/' . $file_name;

        // Move the uploaded file to the desired destination
        move_uploaded_file($file_tmp, $file_destination);

        // Use $file_destination in the query below to update the logo file path
        $query = "UPDATE restoran 
                  SET res_name = '$res_name', notelp = '$notelp', address = '$address', site_address = '$maps_Address', res_logo = '$file_destination' 
                  WHERE user_id = '$user_Id'";
    } else {
        // If no file was uploaded, update the data excluding the logo
        $query = "UPDATE restoran 
                  SET res_name = '$res_name', notelp = '$notelp', address = '$address', site_address = '$maps_Address' 
                  WHERE user_id = '$user_Id'";
    }

    if (mysqli_query($conn, $query)) {
        return true; // Return true if the update was successful
    } else {
        echo "Error: " . mysqli_error($conn);
        return false; // Return false if there was an error in the update
    }
}



function createMenu($data)
{
    global $conn;
    $menuItems = $_POST["menuItems"]; // Make sure the key matches the one used in formData.append()
    $allmenu = implode(",",$menuItems);
    $user_Id = $_SESSION['user'];

    // First, retrieve the res_id from the restoran table based on the user_id
    $query = "SELECT res_id FROM restoran WHERE user_id = '$user_Id'";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        return -1; // Return a negative value to indicate an error occurred.
    }
    
    $row = mysqli_fetch_assoc($result);
    $res_id = $row['res_id'];
        
    $query = "INSERT INTO menu (nama_menu, res_id)
                VALUES ('$allmenu', '$res_id')
            ";

    if (mysqli_query($conn, $query)) {
        // Return the menu ID of the inserted menu
        return mysqli_insert_id($conn);
    } else {
        echo "Error: " . mysqli_error($conn);
        return -1; // Return a negative value to indicate an error occurred.
    }
}

function updateMenu($menuItems)
{
    global $conn;
    $allmenu = implode(",", $menuItems);
    $user_Id = $_SESSION['user'];

    // First, retrieve the res_id from the restoran table based on the user_id
    $query = "SELECT res_id FROM restoran WHERE user_id = '$user_Id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        return false; // Return false to indicate an error occurred.
    }

    $row = mysqli_fetch_assoc($result);
    $res_id = $row['res_id'];

    // Update the menu items for the specified restaurant
    $query = "UPDATE menu SET nama_menu = '$allmenu' WHERE res_id = '$res_id'";

    if (mysqli_query($conn, $query)) {
        return true; // Return true if the update was successful
    } else {
        echo "Error: " . mysqli_error($conn);
        return false; // Return false to indicate an error occurred.
    }
}

function createMenu2($data)
{
    global $conn;
    $user_Id = $_SESSION['user'];
    $menuItems = isset($data['data']) ? $data['data'] : array();

    // First, retrieve the res_id from the restoran table based on the user_id
    $query = "SELECT res_id FROM restoran WHERE user_id = '$user_Id'";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        return -1; // Return a negative value to indicate an error occurred.
    }
    
    $row = mysqli_fetch_assoc($result);
    $res_id = $row['res_id'];
        
    foreach ($menuItems as $menuItem) {
        // Escape and sanitize the menu item value before inserting
        $menuItem = mysqli_real_escape_string($conn, $menuItem);
        
        $query = "INSERT INTO test_menu (nama_menu, res_id)
                  VALUES ('$menuItem', '$res_id')";
        
        if (!mysqli_query($conn, $query)) {
            echo "Error: " . mysqli_error($conn);
            return -1; // Return a negative value to indicate an error occurred.
        }
    }

    return mysqli_insert_id($conn);
}

function fetchLogo($user_id, $conn)
{
    global $conn;

    $query = "SELECT res_logo FROM restoran WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        // Handle the query error and return null
        echo "Error: " . mysqli_error($conn);
        return null;
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['res_logo'];
    }

    return ""; // Return an empty string if the logo is not found
}

if (isset($_SESSION["user"])) {
    // The 'user' session is set, so you can access the session data safely
    $id = $_SESSION["user"];
    $avatarUrl = fetchLogo($id, $conn);
} else {
    $avatarUrl = "";
}

function hapusUser($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM users WHERE id_user = $id");
    return mysqli_affected_rows($conn);
}

function fetchRestaurants()
{
    global $conn;

    $query = "SELECT * FROM restoran";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        return []; // Return an empty array if there was an error
    }

    $restaurants = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $restaurants[] = $row;
    }

    return $restaurants;
}

function fetchRestaurantsAdmin() {
    global $conn;

    // Query to fetch restaurants from the database
    $query = "SELECT * FROM restoran";
    $result = mysqli_query($conn, $query);

    // Fetch and return the restaurant data
    $restaurants = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $restaurants[] = $row;
    }

    return $restaurants;
}

function fetchLogoRes($res_id)
{
    global $conn;

    $baseUrl = "http://localhost/manacul/";
    $query = "SELECT res_logo FROM restoran WHERE res_id = $res_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        // Handle the query error and return null
        echo "Error: " . mysqli_error($conn);
        return null;
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $logoFilename = $row['res_logo'];
        $absolutePath = $baseUrl . "reslogo/" . $logoFilename;
        return $absolutePath;
    }

    return ""; // Return an empty string if the logo is not found
}

function fetchMenuAvail()
{
    global $conn;

    $query = "SELECT menuAvail_name FROM menuAvail";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        return json_encode([]); // Return an empty array as JSON if there was an error
    }

    $menuAvailNames = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $menuAvailNames[] = ["label" => $row['menuAvail_name']];
    }

    // Return the array as JSON
    return json_encode($menuAvailNames);
}

function deleteRes($resId)
{
    global $conn;

    $query = "DELETE FROM restoran WHERE res_id = $resId";
    if (mysqli_query($conn, $query)) {
        $rowsAffected = mysqli_affected_rows($conn);
        if ($rowsAffected >= 0) {
            return $rowsAffected;
        } else {
            echo "Error: Rows affected is negative.";
            return -1;
        }
    } else {
        echo "Error: " . mysqli_error($conn);
        return -1;
    }
}

function deleteUser($userId)
{
    global $conn;

    $query = "DELETE FROM users WHERE user_id = $userId";
    if (mysqli_query($conn, $query)) {
        $rowsAffected = mysqli_affected_rows($conn);
        if ($rowsAffected >= 0) {
            return $rowsAffected;
        } else {
            echo "Error: Rows affected is negative.";
            return -1;
        }
    } else {
        echo "Error: " . mysqli_error($conn);
        return -1;
    }
}

function fetchRestaurantsByKeyword($searchKeyword) {
    global $conn;
    
    $searchKeyword = mysqli_real_escape_string($conn, $searchKeyword);
    
    $query = "SELECT DISTINCT r.* FROM restoran r
              INNER JOIN menu m ON r.res_id = m.res_id
              WHERE m.nama_menu LIKE '%$searchKeyword%'";
    
    $result = mysqli_query($conn, $query);
    
    $restaurants = array();
    
    while ($row = mysqli_fetch_assoc($result)) {
        $restaurants[] = $row;
    }
    
    return $restaurants;
}