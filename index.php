<?php
echo '
<!DOCTYPE html>
<html>
<head>
<style>
	h1 {text-align:center;color:blue;}
    p {text-align:center;}
    img {height:100px;width:100px;}
    caption {font-weight:bold;color:blue;}
	body {background:#BABBD3;}
	table {margin-left:auto; margin-right:auto;}
	td {text-align:center;}
	.solid {border:2px solid green; width:150px;}
</style>
</head>
<body>
<h1>CS380 Project Login</h1>
<p> <img src="img/peace.jpg" alt="peace sign"> </p>
<form action="ProcessForm.php" method="post" >
<table>
<caption>Please enter:</caption>
<tr><td> <input type="text" name="name" placeholder="User Name" class="solid"></td></tr><br>
<tr><td> <input type="password" name="password" placeholder="password" class="solid"></td></tr><br>
<tr><td><input type="submit" value="Submit"></td></tr>
</table>
</form>
<br><br>
<a href="NewUser.php">Register New User</a>
</body>
</html>
';
?>