<?php
//create array of sql statements
$sql = array(
    'USE cs380;',
    
    'DROP TABLE IF EXISTS login;',
    
    'CREATE TABLE  login  (
   UserID  varchar(64),
   password  varchar(64),
   role  varchar(25),
   rank  int(11),
   last date,
   PRIMARY KEY (UserID));',
    
    
    'INSERT INTO  login VALUES
     ("jpepe", "foobar", "Faculty", 10, "2017-11-22"),
     ("tyler_stev", "foobar", "Student", 8, "2017-08-03"),
     ("wvanderclock", "foobar", "Course Coord", 6, "2017-08-03"),
     ("wwong", "foobar", "Faculty", 8, "2017-08-03");'
    
);

// Connect to MySQL, select database
require ("database.php");

// Check connection
if (mysqli_connect_errno($con))
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
echo 'Connected successfully<br>';

//Execute SQL in array
for ($i = 0; $i<sizeof($sql); $i++){
    $query = $sql[$i];
    $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_errno($con));
    echo $i." successfull<br>";
}
?>