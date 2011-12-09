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
 
<script type="text/javascript">
$(function() {
    $('img[data-hover]').hover(function() {
        $(this).attr('tmp', $(this).attr('src')).attr('src', $(this).attr('data-hover')).attr('data-hover', $(this).attr('tmp')).removeAttr('tmp');
    }).each(function() {
        $('<img />').attr('src', $(this).attr('data-hover'));
    });;	
});
</script>

<SCRIPT TYPE="text/javascript">
<!--
function popup(mylink, windowname)
{
if (! window.focus)return true;
var window_dimensions = "width=300,height=500,toolbars=no,menubar=no,location=no,scrollbars=yes,resizable=yes,status=yes";
var href;
if (typeof(mylink) == 'string')
   href=mylink;
else
   href=mylink.href;
window.open(href, windowname, window_dimensions);
return false;
}
//-->
</SCRIPT>
		
		
		
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
echo "<span id=\"white\">You are logged in as <strong>$session->username.</strong></span> <span><a href=\"process.php\">Logout</a></span>";?>
<a href="help.html" onClick="return popup(this, 'notes')"><img align="right" src="images/help.png" height="30px" target="popup"></a>
<?php
}else
{
?>
<form action="process.php" method="POST">
<span id="white">Username:</label><input type="text" name="user" maxlength="30" value="<? echo $form->value("user"); ?>"><? echo $form->error("user"); ?>
&nbsp;&nbsp;&nbsp;&nbsp;
<span id="white">Password:</label><input type="password" name="pass" maxlength="30" value="<? echo $form->value("pass"); ?>"><? echo $form->error("pass"); ?>
<input type="hidden" name="sublogin" value="1">
<input type="submit" value="Login">
<span id="white"><a href="register.php">Register Account</a></span>
</form>
<a href="help.html" onClick="return popup(this, 'notes')"><img align="right" src="images/help.png" height="30px" target="popup"></a>
<?php } ?>


<tr><td valign=top width=145px background="images/bgleft.png">
<?php
if($session->logged_in){
if($session->userlevel>=8){
?>
<img src="images/instructor.png">
<a href="ProjectCreation.html"><img src="images/projectcreation.png" data-hover="images/projectcreationhover.png"></a>
<a href="project.php"><img src="images/projects.png" data-hover="images/projectshover.png"></a>
<a href="creategroup.php"><img src="images/groupcreation.png" data-hover="images/groupcreationhover.png"></a>
<a href="group.php"><img src="images/groups.png" data-hover="images/groupshover.png"></a>
<a href="contractcreation.php"><img src="images/contractcreation.png" data-hover="images/contractcreationhover.png"></a>
<a href="studentlist.php"><img src="images/studentlist.png" data-hover="images/studentlisthover.png"></a>
<a href="studentlistgroup.php"><img src="images/studentgroupadd.png" data-hover="images/studentgroupaddhover.png"></a>
<a href="evaluations.php"><img src="images/studentevaluations.png" data-hover="images/studentevaluationshover.png"></a>
<table bgcolor="#000000" width=100% height=15px><tr><td></td></tr></table>

<img src="images/admin.png">
<a href="main.php"><img src="images/home.png" data-hover="images/homehover.png"></a>
<a href="userinfo.php?user=<?php echo"$session->username"; ?>"><img src="images/myaccount.png" data-hover="images/myaccounthover.png"></a>
<a href="useredit.php"><img src="images/editaccount.png" data-hover="images/editaccounthover.png"></a>
<?php
if($session->userlevel==9){
?>
<a href="admin/admin.php"><img src="images/admincenter.png" data-hover="images/admincenterhover.png"></a>
<?php
}
?>
<a href="process.php"><img src="images/logout.png" data-hover="images/logouthover.png"></a>

<img src="images/student.png">
<a href="contractcreation.php"><img src="images/contractcreation.png" data-hover="images/contractcreationhover.png"></a>
<a href="studentinfo.php"><img src="images/myinformation.png" data-hover="images/myinformationhover.png"></a>
<a href="evalform.php"><img src="images/evaluation.png" data-hover="images/evaluationhover.png"></a>
<a href="contractaccept.php"><img src="images/contracts.png" data-hover="images/contractshover.png"></a>
<table bgcolor="#000000" width=100% height=15px><tr><td></td></tr></table>
<?php
}else{
?>

<img src="images/student.png">
<a href="contractcreation.php"><img src="images/contractcreation.png" data-hover="images/contractcreationhover.png"></a>
<a href="studentinfo.php"><img src="images/myinformation.png" data-hover="images/myinformationhover.png"></a>
<a href="evalform.php"><img src="images/evaluation.png" data-hover="images/evaluationhover.png"></a>
<a href="contractaccept.php"><img src="images/contracts.png" data-hover="images/contractshover.png"></a>
<table bgcolor="#000000" width=100% height=15px><tr><td></td></tr></table>

<?php
}
}
?>




</td>

<td bgcolor="#ededeb" valign=top>
	<?
	if($session->logged_in){
   
}
else{
echo "You need to <a href=main.php>login</a>.";
}
function popup ($text){
	echo "<script type='text/javascript'>alert('$text')</script>";
}
?>

