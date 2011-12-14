<?php
  include('includes/header.php');
  if ($session->userlevel > 8 || $session->userlevel < 8){
    if(isset($_POST['Submit'])){
      $exp = explode(",", $_POST['slider_values']);
      $result = (count($exp))-1;
      $output = array_slice($exp, 0, $result);
      $total = 0;
      for($i=0;$i<$result;$i++){
        $output[$i] = trim($output[$i]);
        $output[$i] = intval($output[$i]);
        $total += $output[$i];
      };
      $k=0;
      for($i=0;$i<$result;$i++){
        for($j=$i+1;$j<$result;$j++){
          if($i==$j)
            $k++;
        };
      };
      
      if($total == 23 && $k <= 1){
        $query=mysql_query("SELECT * FROM users WHERE GROUP_ID=" . $session->GROUP_ID . " AND STUDENT_ID!=" . $session->STUDENT_ID);
        $num=mysql_num_rows($query);
      
        for($i=0;$i<$num;$i++){
          $qone = mysql_fetch_array($query);
          $q2 = "UPDATE Eval SET Grade=" . $output[$i] . " WHERE STUDENT_ID=" . $qone[STUDENT_ID] . " AND GROUP_ID=" . $session->GROUP_ID;
          mysql_query($q2) or die(mysql_error());
        };
        
        printf ("<script>location.href=\"main.php\"</script>");
      }
    }
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
    //total = 0;
    //<!--/script>
    /*<script type="text/javascript" */src="js/jquery-1.6.2.min.js";//><!--/script>
    
    /*<script type="text/javascript" */src="js/ui/jquery.linkedsliders.js";//><!/script>
    /*<script type="text/javascript" */src="js/ui/ui/jquery.linkedsliders.js";//><!/script>
    /*<script type="text/javascript" */src="js/ui/ui/jquery.linkedsliders.min.js";//><!/script>
    /*<script type="text/javascript" */src="js/ui/ui/jquery.linkedsliders.pack.js";//><!/script>
    /*<script type="text/javascript" */src="js/jquery-ui-1.8.16.custom.min.js";//><!/script>
    //<script type="text/javascript">
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
            balance = (Math.floor(Math.random() * 10)) + 1;
            if(balance > 8)
            {
              result2 += '' + Math.floor((value/100) * check) + ', ';
            }
            else
            {
              result2 += '' + Math.round((value/100) * check) + ', ';
            }
            total += value;
		      });
		      $('#defaultPercentages').text(result.substring(3) + ' = ' + (total + .5) + '%');
		      $('#slider_values').val(result2);
		
        }).filter(':first').slider('value', 100);
      });
    </script>
  </head>
  <body>
    <font size="6">Rate Your Mates</font>
    
    </br>
    <?php $query=mysql_query("SELECT * FROM users WHERE GROUP_ID=" . $session->GROUP_ID . " AND STUDENT_ID!=" . $session->STUDENT_ID);
      $num=mysql_num_rows($query);
      ?></br></br></br><?php
      for($i=0;$i<$num;$i++){
        $qone = mysql_fetch_array($query);
        echo "<font size=\"5\">" . $qone[fname] . " " . $qone[lname] . "</font>";?>
        <div class="defaultSlider"></div>
    <?php };?>
    <pre><div id="defaultPercentages"></div><pre>
    <form action="linkedsliders.php" method="POST">
      <input type="text" name="slider_values" id="slider_values"/>
      <input type="submit" value="Send!" name="Submit"/>
    </form>
  </body>
</html>

<?php include("includes/footer.php"); 
  }else{
  echo "You don't have access to this.";
};?>
