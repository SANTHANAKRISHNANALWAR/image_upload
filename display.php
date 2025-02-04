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

// Fetch all images from database
$sql = "SELECT id, title, image_data, upload_date FROM images ORDER BY upload_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Images</title>
    <style>
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        
        .image-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
        }
        
        .image-card img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }
        
        .image-title {
            margin: 10px 0;
            font-weight: bold;
        }
        
        .upload-date {
            color: #666;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Uploaded Images</h1>
    <div style="text-align: center; margin-bottom: 20px;">
        <a href="index.php">Upload New Image</a>
    </div>
    <!-- <div>echo <?php echo gettype($result) ?></div> -->
    <div class="gallery">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                // echo $row; 
                $image_base64 = base64_encode($row->image_data);
                ?>
                <div class="image-card">
                    <img src="data:image/jpeg;base64,<?php echo $image_base64; ?>" alt="<?php echo htmlspecialchars($row->title); ?>">
                    <div class="image-title"><?php echo htmlspecialchars($row->title); ?></div>
                    <div class="upload-date"><?php echo date('F j, Y g:i A', strtotime($row->upload_date)); ?></div>
                </div>

                <?php
                
            }
            

        } else {
            echo "<p>No images found in the database.</p>";
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>