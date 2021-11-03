<?php
session_start(); // check login
if ($_SESSION['login'] == "yes") {

    // Turn off default error reporting
    error_reporting(0);

    // allow MySQLi error reporting and Exception handling
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {

        // Connect to MySQL, select database
        require ("model/database.php");
        
        // Perform SQL query
        $query = "SELECT * FROM tutor;";
        $result = mysqli_query($con, $query);

        // Printing results in HTML
        echo "<html><head>";
        echo "<link href='css/page.css' rel='stylesheet' type='text/css'>";
        echo "</head><body>";
        echo "<h1>Tutors</h1>";
        echo "<table align='center' class='solid'>\n";

        // print column header
        while ($i = mysqli_fetch_field($result))
            echo "<th> $i->name </th>";
        echo "</tr>";

        // print data
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "\t<tr>\n";
            foreach ($line as $col_value) {
                echo "\t\t<td width='100'>$col_value</td>\n";
            }
            echo "\t</tr>\n";
        }
        echo "</table>\n";

        echo "<br><br>";
        echo "<a href='viewCourses.php'>Courses</a><br>";
        echo "<a href='logout.php'>logout</a><br>";

        echo "</body></html>";
    } catch (Exception $e) {
        $message = $e->getMessage();
        $code = $e->getCode();
        header("Location: error.php?code=$code&message=$message");
    } finally{
        // close connection
        mysqli_close($con);
    }

    // if not logged in, go back to login page
} else
    header("Location: index.php");

?>