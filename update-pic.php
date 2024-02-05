<?php
session_start();

// Function to save uploaded image to server
function saveImage($file) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($file["name"]);
    move_uploaded_file($file["tmp_name"], $targetFile);
    return $targetFile;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_pic"])) {
    $profilePic = $_FILES["profile_pic"];
    $uploadedPic = saveImage($profilePic);
    $_SESSION["profile_pic"] = $uploadedPic;
}

// Load previously uploaded image if available
$prevProfilePic = isset($_SESSION["profile_pic"]) ? $_SESSION["profile_pic"] : "default_profile_pic.jpg";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Picture Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 20px;
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-pic-container {
            position: relative;
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-pic-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.1);
            z-index: 10;
            pointer-events: none;
        }

        img {
            display: block;
            margin: 0 auto;
			height: 400px;
			width: 400px;
            max-width: 100%;
            border-radius:50%;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            z-index: 1;
        }

        input[type="file"] {
            display: block;
            margin: 0 auto 20px;
        }

        button[type="submit"] {
            display: block;
            margin: 0 auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Profile Picture Update</h1>
        <div class="profile-pic-container">
            <div class="profile-pic-overlay"></div>
            <img src="<?php echo $prevProfilePic; ?>" alt="Current Profile Picture">
        </div>
        <h2>Upload New Profile Picture:</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="profile_pic" accept="image/*" required>
            <button type="submit">Upload</button>
        </form>
    </div>

    <script>
        // Prevent right-click on the image
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });
    </script>
</body>
</html>
