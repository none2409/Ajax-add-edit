<?php
//insert.php

$connect = new PDO("mysql:host=localhost;dbname=muathevn", "root", "");

$query = "
INSERT INTO multi_data
(name, 	email)
VALUES (:full_name, :full_email)
";

for($count = 0; $count<count($_POST['hidden_full_name']); $count++)
{
 $data = array(
  ':full_name' => $_POST['hidden_full_name'][$count],
  ':full_email' => $_POST['hidden_full_email'][$count]
 );
 $statement = $connect->prepare($query);
 $statement->execute($data);
}

?>