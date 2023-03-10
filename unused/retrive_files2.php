<?php
// retrive images and codes file seperate
require 'vendor/autoload.php'; // Include the AWS SDK for PHP

use Aws\S3\S3Client;

// Set up the S3 client with your credentials and region
$s3 = new S3Client([
    'version' => 'latest',
    'region' => 'ap-southeast-1',
    'credentials' => [
        'key' => 'AKIAXZCQFZNLVWVNVTIP',
        'secret' => 'L5opmChBLmOfSYC1s3a7eCxSQm3a1cFpuz6odatT',
    ],
]);

// Set the bucket and folder names
$bucket = 'cdti-library-storage';
$folder = 'FBK316/';

// Use the S3 client to list all objects in the folder
$result = $s3->listObjects([
    'Bucket' => $bucket,
    'Prefix' => $folder,
]);

// Loop through the objects and display images and code files on the web page
foreach ($result['Contents'] as $object) {
    // Skip over any objects that aren't files (i.e. directories)
    if ($object['Size'] == 0) {
        continue;
    }

    // Get the object key and file extension
    $key = $object['Key'];
    $extension = pathinfo($key, PATHINFO_EXTENSION);

    // Display image files
    if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
        $url = $s3->getObjectUrl($bucket, $key);
        echo '<img src="' . $url . '"width="800" height="460">&nbsp;&nbsp;<p ="' . $url . '">' . $object['Key'] . '</p><br>';
        
    // Display code files
    } elseif (in_array($extension, ['php', 'html', 'css', 'js', 'txt'])) {
        $content = $s3->getObject([
            'Bucket' => $bucket,
            'Key' => $key,
        ]);
        echo '<pre>' . htmlspecialchars($content['Body']) . '</pre><br>';
    }
}
?>
