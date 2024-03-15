<?php
//connect to database
$conn = mysqli_connect('localhost', 'devon', 'test1234', 'dev_rpg');

//check connection
if(!$conn){
    echo 'Connection error' . mysqli_connect_error();
}
?>