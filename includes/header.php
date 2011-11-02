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
		<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.16.custom.css"/>
		<link rel="stylesheet" href="css/reset.css" />
		<!--<link rel="stylesheet" href="css/text.css" /> 
		<link rel="stylesheet" href="css/960_24_col.css" />
	<link rel="stylesheet" href="css/demo.css" /> -->
	</head>
	<body>
	<?
	if($session->logged_in){
   echo "You are logged in as: <b>$session->username</b>.<br>"
	   ."[<a href=\"main.php\">Home</a>] &nbsp;&nbsp;"
       ."[<a href=\"userinfo.php?user=$session->username\">My Account</a>] &nbsp;&nbsp;"
       ."[<a href=\"useredit.php\">Edit Account</a>] &nbsp;&nbsp;";
   if($session->isAdmin()){
      echo "[<a href=\"admin/admin.php\">Admin Center</a>] &nbsp;&nbsp;";
   }
   echo "[<a href=\"process.php\">Logout</a>]<br><br><br>";
}
else{
echo "You need to login.";
}
?>