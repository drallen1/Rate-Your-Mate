<?php
/* This page is what instructors will see when they are logged in.
Written by David Allen
11.02.2011
*/
include("include/session.php");
?>
<html>
			<head>
					<link rel="stylesheet" href="css/common.css" />
					</head>
			<body>
<?

if($session->logged_in)
{
echo"<h1>Click the image below to start Rate Your Mate!</h1><br><a href=\"main.php\"><img src='images/rateyourmateanimated.gif' width='500' height='260'  /></a>";
	
   }else
   {
   ?> 
<?
/**
 * User not logged in, display the login form.
 * If user has already tried to login, but errors were
 * found, display the total number of errors.
 * If errors occurred, they will be displayed.
 */
if($form->num_errors > 0){
   echo "<font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font>";
}
?>
<html>
<body>
<img src='images/rateyourmateanimated.gif' width='500' height='260'  />
<h1>Login</h1>
<div align="center" class="alignCenter">
<form action="process.php" method="POST">
<table align="center" border="0" cellspacing="0" cellpadding="3">
<tr><td>Username:</td><td><input type="text" name="user" maxlength="30" value="<? echo $form->value("user"); ?>"></td><td><? echo $form->error("user"); ?></td></tr>
<tr><td>Password:</td><td><input type="password" name="pass" maxlength="30" value="<? echo $form->value("pass"); ?>"></td><td><? echo $form->error("pass"); ?></td></tr>
<tr><td colspan="2" align="center"><input type="checkbox" name="remember" <? if($form->value("remember") != ""){ echo "checked"; } ?>>
<font size="2">Remember me next time &nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="sublogin" value="1">
<input type="submit" value="Login"></td></tr>
<tr><td colspan="2" align="center"><br><font size="2">[<a href="forgotpass.php">Forgot Password?</a>]</font></td><td align="center"></td></tr>
<tr><td colspan="2" align="center"><br>Not registered? <a href="register.php">Sign-Up!</a></td></tr>
</table>
</form>
</div>
</body>
</html>
<?
}
include('includes/footer.php');
   	?>
	
	
