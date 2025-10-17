<?php
// Nếu người dùng nhấn submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $targetDir = "uploads/";

    // Tạo thư mục nếu chưa có
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetFile = $targetDir . basename($_FILES["pdfFile"]["name"]);
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file is a PDF
    if ($fileType != "pdf") {
        echo "<p style='color:red;'>Only PDF files are allowed.</p>";
        exit;
    }

    // Check for upload errors
    if ($_FILES["pdfFile"]["error"] !== UPLOAD_ERR_OK) {
        echo "<p style='color:red;'>Upload error: " . $_FILES["pdfFile"]["error"] . "</p>";
        exit;
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $targetFile)) {
        echo "<p style='color:green;'>The file <strong>" . htmlspecialchars(basename($_FILES["pdfFile"]["name"])) . "</strong> has been uploaded successfully!</p>";
    } else {
        echo "<p style='color:red;'>Sorry, there was an error uploading your file.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CV</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .upload-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        input[type="file"] {
            display: block;
            margin: 15px auto;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="upload-container">
        <h2>Upload Your CV (PDF only)</h2>
        <form action="{{{ route('upload.store') }}}" method="POST" enctype="multipart/form-data">
            <input type="file" name="pdfFile" accept="application/pdf" required>
            <button type="submit">Upload</button>
        </form>
    </div>
</body>
</html>
