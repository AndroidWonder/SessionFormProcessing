<?php
// This example uses prepared statements and establishes a session with a successful login.

// Turn off default error reporting
error_reporting(0);

// allow MySQLi error reporting and Exception handling
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// use Exception Handling for empty form fields
if (! empty($_POST['name']) and ! empty($_POST['password'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];

    try {
        // Connect to MySQL, select database
        require ("model/database.php");

        // test name for HTML characters to avoid HTML Injection
        require ("TestInput.php");
        $name = test_input($name);
        $password = test_input($password);

        // Prepare SQL query
        $query = mysqli_prepare($con, "SELECT * FROM Login WHERE UserID=? And password=?");
        mysqli_stmt_bind_param($query, "ss", $name, $password);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);

        $rows = mysqli_num_rows($result);

        // if userid not in login table, redirect to error page and try again
        if ($rows < 1)
            header("Location: error.php?message='user/password not found'");

        // establish session
        session_start();

        // create session variable containing correct login status for use in other pages
        $_SESSION['login'] = "yes";

        // get table header names from SQL field names
        $finfo = mysqli_fetch_fields($result);

        // update last time used logged in
        // no prepared statement needed here
        $update = "UPDATE Login SET last=now() WHERE UserID='$name'";
        mysqli_query($con, $update);

        // create web page with table and styles
        echo "<html>
<head>
<link href='css/page.css' rel='stylesheet' type='text/css'>
</head>
<body>
<h2 style='text-align:center;'>Welcome, " . $name . "</h2>
<table align='center'>";
        echo "<tr>";

        // get table column names from result set
        foreach ($finfo as $val) {

            echo "<th> $val->name </th>";
        }
        echo "</tr>";

        // position cursor to top of result set
        mysqli_data_seek($result, 0);

        // loop over result set. Print a table row for each record
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            echo "\t<tr>\n";
            // inner loop. Print each table field value for a record
            foreach ($line as $col_value) {
                echo "\t\t<td>$col_value</td>\n";
            }
            echo "\t</tr>\n";

            // remember rank in session for DB delete permission
            $_SESSION['rank'] = $line['position'];
        }
        echo "</table>\n";
        echo "<br><br>";
        echo "<a href='viewCourses.php'>Courses</a><br>";
        echo "<a href='viewTutors.php'>Tutors</a><br>";
        echo "<a href='DeleteCourse.php'>Delete Course</a><br>";
        echo "</body></html>";
    } catch (Exception $e) {
        $message = $e->getMessage();
        $code = $e->getCode();
        header("Location: error.php?code=$code&message=$message");
    } finally{
        // close connection
        mysqli_close($con);
    }
} // both fields not filled in, redirect to index.php
else
    header("Location: error.php?message='form fields not filled in'");
?>