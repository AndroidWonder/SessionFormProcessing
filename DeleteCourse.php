
<?php
session_start();  //check login
if ($_SESSION['login'] !== "yes") throw new Exception("user not logged in");
	
	//check that rank is >= 10 for delete permission
	if($_SESSION['rank'] < 10) {
		//a little Javascript to handle users who can't delete from DB
		echo '<script>alert("You have no permission to delete a course");
                       location.href="logout.php";</script>';
	}//rank

	if (! empty($_POST['CourseID'])) {
	
	// Turn off default error reporting
	error_reporting(0);
	
	// allow MySQLi error reporting and Exception handling
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
try {
	
	$course = $_POST['CourseID'];
	
	// Perform SQL DELETE using prepared statement
	$query = mysqli_prepare($con, "DELETE FROM Course WHERE CourseID=?");
	mysqli_stmt_bind_param($query, "s", $course);
	mysqli_stmt_execute($query);
			
	$query = "DELETE FROM Course WHERE CourseID='$course'";
			
	// Connect to MySQL, select database
	require ("model/database.php");
			
     mysqli_query($con, $query);  
   
} catch (Exception $e) {
    $message = $e->getMessage();
    $code = $e->getCode();
    header("Location: error.php?code=$code&message=$message");
} finally{
    // close connection
    mysqli_close($con);
}

header("Location:viewCourses.php");
	}//empty


?>
<!DOCTYPE html>
<html><body>
<h1>Delete a Course</h1>
<form method="post" action="DeleteCourse.php" style="text-align:center">
<label>CourseID </label><br><input type="text" name="CourseID"><br><br>
<input type="submit" value="Delete">
</form>
</body>
</html>
		