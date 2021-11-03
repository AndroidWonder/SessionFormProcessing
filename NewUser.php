<?php
echo'

<html>
<head>
<title>Create New User</title>
<style>
	h1 {text-align:center;color:blue;}
	body {background:#BABBD3;}
	table {margin-left:auto; margin-right:auto;}
	td {text-align:center;}
	.solid {border:2px solid green;}
</style>
</head>
<body>
<h1>Register a New User</h1>
<form action="ProcessNewUser.php" method="post" >
<table>
<tr><td>Name:</td><td> <input type="text" name="name"></td></tr><br>
<tr><td>Password:</td><td> <input type="password" name="password"></td></tr><br>
<tr><td colspan="2"><input type="submit" value="Submit"></td></tr>
</table>
</form>

</body>
</html>
';
?>