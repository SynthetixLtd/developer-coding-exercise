<?php
     include_once 'config.php';

     ini_set('display_errors', 'On');
	 error_reporting(E_ALL);

     $title = $_POST['title'];
     $publisher = $_POST['publisher'];
     $author = $_POST['author'];
     $category = $_POST['category'];

     
     $conn = new mysqli($cd_host, $cd_user, $cd_password, $cd_dbname, $cd_port, $cd_socket); 

     if (!$conn) {
         die('Could not connect: ' .mysql_error());
     }
     
     $sql = "INSERT INTO books (title, author, category, publisher) VALUES ('$title', '$author', '$category', '$publisher');";
     $query = mysqli_query($conn, $sql);
         
     mysqli_close($conn);
            
     header("Location: ../../index.html?signup=success");