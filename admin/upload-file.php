<?php

//print_r($_FILES);
$uploaddir = '../images/partnersimg/'; 
$file = $uploaddir . basename($_FILES['uploadfile']['name']); 
// echo basename($_FILES['uploadfile']['name']);
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 
  echo "success"; 
} else {
	echo "error";
}
?>