<?php
  include('includes/header.php');
  if ($session->userlevel > 8 || $session->userlevel < 8){
?>
<html>
  <head>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.3/themes/south-street/ui.all.css" rel="stylesheet"/>

    <style type="text/css">
      .ui-slider-horizontal {
        width: 30em;
        margin: 0em 0em 1em 5em;
      }
    </style>
    <script type="text/javascript">
      url = "linkedsliders.php?var="
    </script>
    <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="js/ui/jquery.linkedsliders.js"></script>
    <script type="text/javascript" src="js/ui/ui/jquery.linkedsliders.js"></script>
    <script type="text/javascript" src="js/ui/ui/jquery.linkedsliders.min.js"></script>
    <script type="text/javascript" src="js/ui/ui/jquery.linkedsliders.pack.js"></script>
    <script type="text/javascript">
      $(function () {
        $('div.defaultSlider').slider().linkedSliders();
        $('div.defaultSlider').bind('slidechange', function(event, ui) {
		      var result = '';
		      var result2 = '';
		      var check = 23;
		      var total = -.5;
		      $('div.defaultSlider').each(function() {
            var value = $(this).slider('value');
            
            result += ' + ' + value + '%';
            result2 += '' + Math.floor((value/100) * check) + ', ';
            total += value;
		      });
		      $('#defaultPercentages').text(result.substring(3) + ' = ' + (total + .5) + '%');
		      $('#slider_values').val(result2);
		
        }).filter(':first').slider('value', 100);
      });
    </script>
  </head>
  <body>
    <?php $query=mysql_query("SELECT * FROM users WHERE GROUP_ID=" . $session->GROUP_ID);
      $num=mysql_num_rows($query);
      ?></br></br></br><?php
      for($i=0;$i<$num;$i++){?>
        <div class="defaultSlider"></div>
    <?php };?>
    <pre><div id="defaultPercentages"></div><pre>
    <form action="evalprocess.php" method="POST">
      <input type="text" name="slider_values" id="slider_values"/>
      <input type="submit" value="Send!" name="Submit"/>
    </form>
  </body>
</html>

<?php include("includes/footer.php"); 
  }else{
  echo "You don't have access to this.";
};?>
