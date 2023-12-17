<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "house_details";

$message = "";
session_start();

try {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the table exists
    $tableExists = $conn->query("SHOW TABLES LIKE 'property_info'")->num_rows > 0;

    // If the table doesn't exist, create it
    if (!$tableExists) {
        $createTableSQL = "CREATE TABLE property_info (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            state VARCHAR(255) NOT NULL,
            city VARCHAR(255) NOT NULL,
            village VARCHAR(255) NOT NULL,
            price INT(11) NOT NULL,
            description TEXT NOT NULL,
            image_name VARCHAR(255) NOT NULL,
            image_data LONGBLOB NOT NULL
        )";

        if ($conn->query($createTableSQL) === TRUE) {
            echo "Table 'property_info' created successfully.<br>";
        } else {
            echo "Error creating table: " . $conn->error . "<br>";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $state = $conn->real_escape_string($_POST['state']);
        $city = $conn->real_escape_string($_POST['city']);
        $village = $conn->real_escape_string($_POST['village']);
        $price = $conn->real_escape_string($_POST['price']);
        $description = $conn->real_escape_string($_POST['description']);

        // Check if the 'image' key exists in the $_FILES array
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // File upload details
            $imageName = $conn->real_escape_string($_FILES['image']['name']);
            $imageData = file_get_contents($_FILES['image']['tmp_name']);

            // Insert data into the database
            $sql = "INSERT INTO property_info (state, city, village, price, description, image_name, image_data) 
                    VALUES ('$state', '$city', '$village', '$price', '$description', '$imageName', ?)";

            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("s", $imageData);

                if ($stmt->execute()) {
                    $_SESSION['success_message'] = "Data inserted successfully!";
                    header("Location: data.php");
                    exit();
                  
                } else {
                    $message = "Error inserting record: " . $stmt->error;
                }

                $stmt->close();
            } else {
                $message = "Failed to prepare statement: " . $conn->error;
            }
        } else {
            $message = "No file uploaded or an error occurred during upload.";
        }
    }

    $conn->close();
} catch (mysqli_sql_exception $e) {
    echo "An error occurred: " . $e->getMessage();
}

// Redirect with message

exit();
?>
