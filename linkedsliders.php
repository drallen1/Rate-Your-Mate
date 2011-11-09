<?php
include('includes/header.php');
?>
<html>
<head>
<style type="text/css">
.ui-slider-horizontal {
	width: 30em;
	margin: 0em 0em 1em 5em;
}
</style>
<script type="text/javascript">
$(function () {
	$('div.basicLinked').slider().linkedSliders();
	$('div.basicLinked:first').slider('value', 100);
});
</script>

</head>
<body>
<div class="basicLinked"></div>
<div class="basicLinked"></div>
<div class="basicLinked"></div>
</body>
</html>