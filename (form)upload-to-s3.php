<?php
	include("home_page.php"); 
	if(isset($_FILES['fileToUpload'])){
		$file_name = $_FILES['fileToUpload']['name'];  
		$temp_file_location = $_FILES['fileToUpload']['tmp_name']; 

		require 'vendor/autoload.php';

		$s3 = new Aws\S3\S3Client([
			'region'  => 'ap-southeast-1',
			'version' => 'latest',
			'credentials' => [
				'key'    => "AKIAXZCQFZNLVWVNVTIP",
				'secret' => "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",
			]
		]);		

		$result = $s3->putObject([
			'Bucket' => 'cdti-library-storage',
			'Key'    => "{$_SESSION['username']}/". $file_name,
			'SourceFile' => $temp_file_location			
		]);

		var_dump($result);
	} 
	if ($result){
		//You need to redirect
		header("Location: http://www.google.com/");
		exit();
	   }
	  else{
		// do something
	  }
	//header("location: {$_SERVER['DOCUMENT_ROOT']}/Project_Software_Dev 2/ยำใหญ่_ใส่ได้เต็มที่_register-login-php-/lol.html");
	//header("location:home_page.php");
?>