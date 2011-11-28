<?php
include('includes/header.php');
if($session->userlevel>=8) //if they are an instructor
{

}else{
echo "You do not have access to this page.";
}
include('includes/footer.php');
?>