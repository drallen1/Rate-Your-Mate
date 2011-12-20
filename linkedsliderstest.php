<?php
  include('includes/header.php');
  if($session->logged_in){
  $query=mysql_query("SELECT * FROM users WHERE GROUP_ID=" . $session->GROUP_ID . " AND STUDENT_ID!=" . $session->STUDENT_ID);
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
	<?
  }else{
  echo"You do not have access to this page.";
  }
    include('includes/footer.php');