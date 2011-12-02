<?
include('include/session.php');
?>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Rate-Your-Mate Group 3</title>
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="js/ui/jquery-ui.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript" src="js/ui/jquery.ui.core.js"></script>
		<script type="text/javascript" src="js/ui/jquery-ui-timepicker-addon"></script>
		<script type="text/javascript" src="js/ui/jquery.linkedsliders.js"></script>
		<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.16.custom.css"/>
		<link rel="stylesheet" href="css/common.css" />
		<!--<link rel="stylesheet" href="css/text.css" /> 
		<link rel="stylesheet" href="css/960_24_col.css" />
	<link rel="stylesheet" href="css/demo.css" /> -->
	</head>
	<body>

	<html>
<head>
<link rel="stylesheet" href="css/top.css" /></head>
<body bgcolor=#000000>
<?php
echo'<table width=100% height=100% cellpadding="0" cellspacing="0">';
echo'<tr height=40px ><td colspan=2 valign="middle" background="images/topbar.png">';
if($session->logged_in){
echo "<p id=\"white\">You are logged in as <strong>$session->username.</strong></p>";
}else
{
?>
<form action="process.php" method="POST">
<label id="white">Username:</label><input type="text" name="user" maxlength="30" value="<? echo $form->value("user"); ?>"><? echo $form->error("user"); ?>
&nbsp;&nbsp;&nbsp;&nbsp;
<label id="white">Password:</label><input type="password" name="pass" maxlength="30" value="<? echo $form->value("pass"); ?>"><? echo $form->error("pass"); ?>
<input type="hidden" name="sublogin" value="1">
<input type="submit" value="Login">
</form>
<?php } ?>


<tr><td valign=top width=145px background="images/bgleft.png">

<img src="images/student.png">
<a href="contractcreation.php"><img src="images/contractcreation.png"></a>
<a href="studentinfo.php"><img src="images/myinformation.png"></a>
<a href="evalform.php"><img src="images/evaluation.png"></a>
<a href="contractaccept.php"><img src="images/contracts.png"></a>
<table bgcolor="#000000" width=100% height=15px><tr><td></td></tr></table>

<img src="images/instructor.png">
<a href="ProjectCreation.html"><img src="images/projectcreation.png"></a>
<a href="project.php"><img src="images/projects.png"></a>
<a href="creategroup.php"><img src="images/groupcreation.png"></a>
<a href="group.php"><img src="images/groups.png"></a>
<a href="contractcreation.php"><img src="images/contractcreation.png"></a>
<a href="studentlist.php"><img src="images/studentlist.png"></a>
<a href="studentlistgroup.php"><img src="images/studentgroupadd.png"></a>
<a href="evaluations.php"><img src="images/studentevaluations.png"></a>
<table bgcolor="#000000" width=100% height=15px><tr><td></td></tr></table>

<img src="images/admin.png">
<a href="main.php"><img src="images/home.png"></a>
<a href=""><img src="images/myaccount.png"></a>
<a href=""><img src="images/editaccount.png"></a>
<a href=""><img src="images/admincenter.png"></a>
<img src="images/logout.png">



</td>

<td bgcolor="#ededeb" valign=top>
	<?
	if($session->logged_in){
   echo "You are logged in as: <b>$session->username</b>.<br>"
	   ."[<a href=\"main.php\">Home</a>] &nbsp;&nbsp;"
       ."[<a href=\"userinfo.php?user=$session->username\"><img src=\"images/link.png\"></a></img>] &nbsp;&nbsp;"
       ."[<a href=\"useredit.php\">Edit Account</a>] &nbsp;&nbsp;";
   if($session->isAdmin()){
      echo "[<a href=\"admin/admin.php\">Admin Center</a>] &nbsp;&nbsp;";
   }
   echo "[<a href=\"process.php\">Logout</a>]<br><br><br>";
}
else{
echo "You need to <a href=main.php>login</a>.";
}
function popup ($text){
	echo "<script type='text/javascript'>alert('$text')</script>";
}
?>

