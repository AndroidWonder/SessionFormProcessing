<?php
session_start(); // check login
if ($_SESSION['login'] == "yes") {
    
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
    
    // Turn off default error reporting
    error_reporting(0);
    
    // allow MySQLi error reporting and Exception handling
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
    try{
        // Connect to MySQL, select database
        require ("database.php");
        
        //Execute SQL in array
        for ($i = 0; $i<sizeof($sql); $i++){
            $query = $sql[$i];
            mysqli_query($con, $query);
            echo $i." successfull<br>";
        }
        
    } catch(Exception $e) { echo "Error: ".$e->getMessage() . "<br/>Line". $e->getLine();}
    finally {
        // close connection
        mysqli_close($con);
    }
    
}
// if not logged in, go back to login page
else
    header("Location: /SessionFormProcessing/index.php");
    
    ?>