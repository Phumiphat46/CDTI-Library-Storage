<?php

function isDirEmpty($dir){ //check if directory is empty
    $check_dir = scandir($dir);
    if (count($check_dir) > 0){
        echo "$dir is not empty";
    } else {
        echo "$dir is empty";
    }
}
?>