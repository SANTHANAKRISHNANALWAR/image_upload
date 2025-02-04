<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload System</title>
    <style>
        .upload-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .submit-btn:hover {
            background-color: #45a049;
        }
        
        .preview-image {
            max-width: 200px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="upload-container">
        <h2>Upload Image</h2>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image_title">Image Title:</label>
                <input type="text" name="image_title" id="image_title" required>
            </div>
            
            <div class="form-group">
                <label for="image_file">Select Image:</label>
                <input type="file" name="image_file" id="image_file" accept="image/*" required>
                <img  id="preview" class="preview-image" style="display: none;">
            </div>
            
            <button type="submit" class="submit-btn">Upload Image</button>
        </form>
    </div>

    <script>
        // Preview image before upload
        document.getElementById('image_file').onchange = function(evt) {
            const preview = document.getElementById('preview');
            const file = evt.target.files[0];
            
            if (file) {
                preview.style.display = 'block';
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }   
                reader.readAsDataURL(file);
            }
        };
    </script>
</body>
</html>