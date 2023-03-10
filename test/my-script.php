<?php 
function myFunction ($input){
    echo 'idk';
}


function anotherFunction($input){
    echo 'Do nothing';
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($_POST['action'] == 'myFunction') {
    myFunction($_POST['input1']);
  } else if ($_POST['action'] == 'anotherFunction') {
    anotherFunction($_POST['input1']);
  }
}

?>