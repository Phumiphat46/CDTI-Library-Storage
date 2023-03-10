<?php
// retrive only images file
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
$folder = "{$_SESSION['username']}/";



// Use the S3 client to list all objects in the folder
$result = $s3->listObjects([
    'Bucket' => $bucket,
    'Prefix' => $folder,
]);

if (!is_null($result['Contents'])) { // used to check whether $result['Contents'] is null before using it in the foreach loop.
    // Loop through the objects and display them as links
    foreach ($result['Contents'] as $object) {
        // Skip over any objects that aren't files (i.e. directories)
        if ($object['Size'] == 0) {
            continue;
        } 
        // Get the object key and file extension
        $key = $object['Key'];
        $extension = strtolower(pathinfo($key, PATHINFO_EXTENSION));

        // Display image files
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
    
            $url = $s3->getObjectUrl($bucket, $object['Key']);
            echo '<img src="' . $url . '"width="800" height="460">&nbsp;&nbsp;<p ="' . $url . '">' . $object['Key'] .'</p><br>';
            echo '<input type="checkbox" name="files[]" value="' . $object['Key'] . '"> ' . $object['Key'] . ' <a href="' . $url . '" target="_blank">View</a><br>'; // to test checkbox with delete option
        }
    }
} else {
    echo "<h3>No files found, but you can browse for your first upload :)</h3>";
}

?>

