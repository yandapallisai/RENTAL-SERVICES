<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <label for="state">State:</label>
        <input type="text" id="state" name="state" required>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>

        <label for="village">Village:</label>
        <input type="text" id="village" name="village" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>

        <label for="image">image:</label>
        <input type="file" id="img" name="image" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "house_deails";

$message = "";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageName = $conn->real_escape_string($_FILES['image']['name']);
            $imageData = file_get_contents($_FILES['image']['tmp_name']);
            $state = $conn->real_escape_string($_POST['state']);
            $city = $conn->real_escape_string($_POST['city']);
            $village = $conn->real_escape_string($_POST['village']);
            $price = $conn->real_escape_string($_POST['price']);
            $description = $conn->real_escape_string($_POST['description']);

            $sql = "INSERT INTO property_info (state, city, village, price, description, image_path) 
                    VALUES ('$state', '$city', '$village', '$price', '$description', '$imageData')";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $imageData);

            if ($stmt->execute()) {
                $message = "Image inserted successfully.";
            } else {
                $message = "Failed to insert image: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $message = "No file uploaded or an error occurred during upload.";
        }
    }

    $conn->close();
} catch (mysqli_sql_exception $e) {
    echo "An error occurred: " . $e->getMessage();
}

// Redirect with message
header("Location: upload.php?message=" . urlencode($message));
exit();
?>


