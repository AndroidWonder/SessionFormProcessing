<!--  This is an error handling page. $code value sent from another script -->
<html>
<body>
<h3>Error</h3>

<?php 
//when this script is executed, be sure to look at the URL

$message ="";

  if (!empty($_GET['message'])) $message=$_GET['message'];

    echo $message."<br><br>";
    
?>
<a href="index.php">Try again</a>

</body></html>



