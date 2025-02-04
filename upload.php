<?php
// Database connection configuration
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'image_upload_db';

// Create database connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a file was uploaded
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image_file"])) {
    $title = $_POST['image_title'];
    $file = $_FILES['image_file'];
    
    // Check for errors
    if ($file['error'] === 0) {
        // Validate file type
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($file['type'], $allowed_types)) {
            // Read file content
            $image_data = file_get_contents($file['tmp_name']);
            
            // Prepare and execute SQL statement
            $stmt = $conn->prepare("INSERT INTO images (title, image_data) VALUES (?, ?)");
            $stmt->bind_param("ss", $title, $image_data);
            
            if ($stmt->execute()) {
                echo "Image uploaded successfully!";
                echo "<br><a href='index.php'>Back to Upload Form</a>";
                echo "<br><a href='process.php'>To view uploaded Images</a>";
            } else {
                echo "Error uploading image: " . $stmt->error;
            }
            
            $stmt->close();
        } else {
            echo "Invalid file type. Only JPG, PNG, and GIF files are allowed.";
        }
    } else {
        echo "Error uploading file: " . $file['error'];
    }
}

$conn->close();
?>