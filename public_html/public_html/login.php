<?php

$password = "bertenmarjo";

function printForm($form_title)
{
$action = $_SERVER["PHP_SELF"];

print <<<END
<html>
<head><title>$form_title</title></head>
<body>
<h1>$form_title</h1>
<form action="$action" method="post">
<p><input type="password" name="pass" value="" />
<input type="submit" value="Login" /></p>
</form>
</body>
</html>
END;
}

if(isset($_POST['pass']))
{
	if($_POST['pass'] == $password)
	{
	// Successfully logged in.
	// Continue to page content.
	setcookie("LOGIN", "ADMIN", time()+(60*60*24*30), "/");
	}
	else
	{
	// Wrong password submitted.
	printForm('Wrong password');
	exit();
	}
}
else if(isset($_GET['logout']))
{
setcookie("LOGIN", "ADMIN", time()-1, "/");
printForm('Logged Out');
exit();
}
else if(isset($_COOKIE['LOGIN']))
{
// Cookie already set login not required.
// Continue to page content.
}
else
{
printForm('Please login');
exit();
}

?>