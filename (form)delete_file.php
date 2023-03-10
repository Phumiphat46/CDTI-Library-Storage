<?php
include("home_page.php");
    $file_name = $_POST['filename'];

    require 'vendor/autoload.php'; // Include the AWS SDK for PHP


    // Set up the S3 client with your credentials and region
    $s3 = new Aws\S3\S3Client([
        'version' => 'latest',
        'region' => 'ap-southeast-1',
        'credentials' => [
            'key' => 'AKIAXZCQFZNLVWVNVTIP',
            'secret' => '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',
        ],
    ]);

    // Set the bucket name and file key
    $bucket = 'cdti-library-storage';
    $file_path = "{$_SESSION['username']}/". $file_name;
    echo "this is file path ->". $file_path;

    // Use the S3 client to delete the file
    $result = $s3->deleteObject([
        'Bucket' => $bucket,
        'Key' => $file_path,
    ]);

    // Check if the deletion was successful
    if ($result) {
        echo "File deleted successfully";
        header("home_page.php");
    } else {
        echo "Failed to delete file";
        header("home_page.php");
    }

    
    ?>

    Replace name, example.txt, key and secret with the appropriate values for your AWS S3 bucket and IAM user.

    You can pass the file_key parameter to the PHP file via $_POST or $_GET depending on the form method and handle the deletion logic in the PHP file.
