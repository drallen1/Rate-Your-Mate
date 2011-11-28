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
			<body><div id="wrapper">
<?
if($session->logged_in)
{
	echo "<h1>Logged In</h1>";
   echo "Welcome <b>$session->username</b>, you are logged in.<br>"
		."[<a href=\"main.php\">Home</a>] &nbsp;&nbsp;"
       ."[<a href=\"userinfo.php?user=$session->username\">My Account</a>] &nbsp;&nbsp;"
       ."[<a href=\"useredit.php\">Edit Account</a>] &nbsp;&nbsp;";
   if($session->isAdmin()){
      echo "[<a href=\"admin/admin.php\">Admin Center</a>] &nbsp;&nbsp;";
   }
   echo "[<a href=\"process.php\">Logout</a>]<br>";
	   if($session->userlevel>=8)
		   {
		   //If the person logged in has instructor privleges, show the instructor panel
		?>
		
				<div id="bannertop"><h2>Instructor Panel</h2></div>
				<div>
		[<a href="ProjectCreation.html">Project Creation</a>]&nbsp;&nbsp;
		[<a href="project.php">Projects</a>]&nbsp;&nbsp;
		[<a href="creategroup.php">Group Creation</a>]&nbsp;&nbsp;
		[<a href="group.php">Groups</a>]&nbsp;&nbsp;
		[<a href="contractcreation.php">Contract Creation</a>]&nbsp;&nbsp;
		[<a href="studentlist.php">Student List</a>]&nbsp;&nbsp;
		[<a href="studentlistgroup.php">Student Group Add</a>]&nbsp;&nbsp;
		</div>
			</body>
		</html>
		<?
		}else{
			//otherwise show the student panel
			?>
			<h2>Student Panel</h2>
			[<a href="contractcreation.php">Contract Creation</a>]&nbsp;&nbsp;
			[<a href="studentinfo.php">My Information</a>]&nbsp;&nbsp;
			<?
		}
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
<h1>Login</h1>
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
   	?>
	
