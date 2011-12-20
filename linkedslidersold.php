<?php
  include('includes/header.php');
  if ($session->logged_in){
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
