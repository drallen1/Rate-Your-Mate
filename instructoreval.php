<?php
include('includes/header.php');

$student_id=$_GET['studentid'];
$query="SELECT GROUP_ID FROM users WHERE STUDENT_ID=". $student_id;
						$result=mysql_query($query) or die(mysql_error());
						$data=mysql_fetch_array($result);
						$group_id=$data['GROUP_ID'];
$query2="SELECT CONTRACT_ID FROM Groups WHERE GROUP_ID=". $group_id;
						$result2=mysql_query($query2) or die(mysql_error());
						$data2=mysql_fetch_array($result2);
						$contract_id=$data2['CONTRACT_ID'];
if($session->userlevel>=8)

//if they are an instructor
{
 if(isset($_POST['Submit'])){
      $query="SELECT * FROM Behavior b, Groups g WHERE g.GROUP_ID=" . $group_id . " AND b.CONTRACT_ID=g.CONTRACT_ID";
      $btwo = mysql_query($query) or die(mysql_error());
      $numB = mysql_num_rows($btwo);
      $query2="INSERT INTO Eval (STUDENT_ID, Grader_ID, GROUP_ID, Grade) VALUES (" . $_POST[graded] . ", " . $student_id . ", " . $session->GROUP_ID . ", '10')";
      mysql_query($query2) or die(mysql_error());
  
      $evalid = mysql_insert_id();
      for($i=0;$i<$numB;$i++){ 
        $r2 = mysql_fetch_array($btwo);
        $query3="INSERT INTO EvalComment (CONTRACT_ID, BEHAVIOR_ID, Comment, EVAL_ID) VALUES (" . $r2[CONTRACT_ID] . ", " . $r2[BEHAVIOR_ID] . ", \"" . $_POST[$r2[BEHAVIOR_ID]] . "\", " . $evalid . ")";
        mysql_query($query3) or die(mysql_error());
      };
      $qfour = mysql_query("SELECT * FROM users WHERE GROUP_ID=" . $group_id . " AND STUDENT_ID=" . $_POST[graded]);
      $rfour = mysql_fetch_array($qfour);
      popup("Your comments for " . $rfour[lname] . ", " . $rfour[fname] . " have been submitted.");
    };
	
            $link = mysql_connect("localhost","drallen1","unicode") or die(mysql_error);
            mysql_select_db("drallen1");
						
						$qsix = mysql_query($sql = "SELECT * FROM users u WHERE u.GROUP_ID=" . $group_id . " AND EXISTS(SELECT * FROM Eval e WHERE u.STUDENT_ID=e.STUDENT_ID) AND u.STUDENT_ID != " . $student_id);

            $numE = mysql_num_rows($qsix);
            /***************************************************
            //WHEN numE == 0 GO TO PIE CHART
            ***************************************************/
            //QUERY
            $qtwo = mysql_query("SELECT * FROM Behavior b, Groups g WHERE g.GROUP_ID=" . $group_id . " AND b.CONTRACT_ID=g.CONTRACT_ID");
             // match eval id
            $numB = mysql_num_rows($qtwo);
            
            if($numE>1)
              $page="evalform.php";
            else
              $page="evalprocess.php";
		      
		      echo "<form action=$page method=\"POST\">";?>
			  
			<script type="text/javascript">
				$(document).ready(function(){
				
							$('#graded').change(
								function() {
									var graderid = $("#studentid").val();
									var studentid= $(this).val();

									$.get( "displayeval.php?graderid=" + graderid + "&studentid=" + studentid,
										function(data){
											$.each( data, function( i, element ){
												$('#behavior-'+element.id).val(element.comment);
											});
										}, "json");
							});
					});
		</script>
			<input type="hidden" name="studentid" id="studentid" value="<?php echo $student_id;?>" />
            Student: <select name="graded" id="graded">
              <option selected="selected">Please Select an Evaluatee</option>
              <?php for($i=0;$i<$numE;$i++){
                $rsix = mysql_fetch_array($qsix);?>
                <option value="<?php echo $rsix[STUDENT_ID]?>"><?php echo $rsix[fname] . " " . $rsix[lname]?></option>
              <?php };?>
            </select></br></br>
            
      	    <!--$qthree = mysql_query("SELECT EVAL_ID FROM Eval WHERE GRADER_ID=" . $student_id. " AND STUDENT_ID=" . graded.value ); -->
      	    
            <?php for($i=0;$i<$numB;$i++){ 
            //result of qtwo
              $rtwo = mysql_fetch_array($qtwo);
              echo "Behavior: <input name=\"BEHAVIOR_ID\" type=\"text\" value=\"" . $rtwo[BehaviorName] . "\" readonly=\"readonly\"/> </br>";
              
  				//$queryshit="SELECT Comment FROM EvalComment WHERE EVAL_ID=RESULTFROMQTHREE AND BEHAVIOR_ID=" . $rtwo[BEHAVIOR_ID];
  				//$comments;
  				
              echo "Comments: <textarea name=\"" . $rtwo['BEHAVIOR_ID'] . "\" id=\"behavior-" . $rtwo['BEHAVIOR_ID'] . "\" rows=\"5\" cols=\"50\">". $comments . "</textarea> </br>"; ?>
            <?php };?>
            </br>
            <input type="submit" value="Send!" name="Submit"/>
          </form>
        </body>

   </html>

    <? include("includes/footer.php"); 
  }else{
  echo "You don't have access to this.";
};?>
  
