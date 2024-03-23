<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/blog/BlogFromScratch/app/lib/connection.php');

function uploadFile($UserID)
{
    $statusMsg = '';
    // File upload path
    $targetDir = "uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (isset ($_POST["submit"]) && !empty ($_FILES["file"]["name"])) {
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database
                $conn = establishConnection();
                $query = "INSERT into images (Images_filename, User_ID) VALUES (?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    echo "<script type='text/javascript'>alert('SQL statement failed')</script>";
                } else {
                    mysqli_stmt_bind_param($stmt, "si", $fileName, $UserID);
                    mysqli_stmt_execute($stmt);
                    echo "<meta http-equiv='refresh' content='1;url='/public/index.php?page=home'";

                }
                if ($stmt) {
                    $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                } else {
                    $statusMsg = "File upload failed, please try again.";
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }
}

function getFilename($UserID)
{
    $conn = establishConnection();
    $query = "Select * from images where User_ID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        echo "<script type='text/javascript'>alert('SQL statement failed')</script>";
    } else {
        mysqli_stmt_bind_param($stmt, "i", $UserID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $imageURL = $row['Images_filename'];
            return $imageURL;
        }
    }
}