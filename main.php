<?php
include('includes/header.php');
if($session->userlevel>=8) //if they are an instructor
{
$prog=$session->progress;
	if($prog==0){
	echo '<h2>You need to create a project.</h2>';
	}elseif(prog==1){
	echo '<h2>You need to create groups, and then have your students create accounts.</h2>';
	}elseif(prog==2){
	echo '<h2>You need to add your students to groups.</h2>';
	}elseif(prog==3){
	echo '<h2>Have your students create contracts, then finalize them.</h2>';
	}elseif(prog==4){
	echo '<h2>Have your students complete evaluations, and comment on them. After, make them visible.</h2>';
	}
//instructorshit
}elseif($session->userlevel==1){
	$prog=$session->progress;
		if($prog==0){
	echo '<h2>You are not in a group.</h2>';
	}elseif(prog==1){
	echo '<h2>You need to create a contract.</h2>';
	}elseif(prog==2){
	echo '<h2>Your instructor needs to finalize your contract before you can continue.</h2>';
	}elseif(prog==3){
	echo '<h2>You need to complete evaluations for your team mates.</h2>';
	}
}
echo "</br>";

include('includes/footer.php');
?>


