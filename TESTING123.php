<? include('includes/header.php'); 

if($session->userlevel >=8){?>


<script>
$(function()
	{
	$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
	$( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
	$('#timepicker').timepicker({timeFormat: 'hh:mm:ss' });
	$('#timepicker2').timepicker({timeFormat: 'hh:mm:ss' });
	}
);
</script>

<div class="demo">
<p>Date Open: <input id="datepicker" type="text" name="AvailDate"></p>
<p>Time Open: <input id="timepicker" type="text" name="AvailTime"></p>
</br>
<p>Date Closed: <input id="datepicker2" type="text" name="DueDate"></p>
<p>Time Closed: <input id="timepicker2" type="text" name="DueTime"></p>
</div>


<?
}else
{
echo "You do not have access to this page.";
}
include('includes/footer.php');
?>