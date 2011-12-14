<?php
include('includes/header.php');


$student_id=$_GET['studentid'];
if($session->userlevel>=8)

//if they are an instructor
{
	
            $link = mysql_connect("localhost","drallen1","unicode") or die(mysql_error);
            mysql_select_db("drallen1");
						
						$qsix = mysql_query($sql = "SELECT * FROM users u WHERE u.GROUP_ID=" . $group_id . " AND EXISTS(SELECT * FROM Eval e WHERE u.STUDENT_ID=e.STUDENT_ID) AND u.STUDENT_ID != " . $student_id);

            /***************************************************
            //WHEN numE == 0 GO TO PIE CHART
            ***************************************************/
            //QUERY
            $qtwo = mysql_query("SELECT * FROM Behavior b, Groups g WHERE g.GROUP_ID=" . $session->GROUP_ID . " AND b.CONTRACT_ID=g.CONTRACT_ID");
             // match eval id
            $numB = mysql_num_rows($qtwo);
            
            if($numE>1)
              $page="evalform.php";
            else
              $page="evalprocess.php";
		      
		      echo "<form action=$page method=\"POST\">";?>
			  
      	    
            <?php 
			/*
			$query="SELECT EVAL_ID FROM Eval WHERE STUDENT_ID=" . $student_id;
			$result=mysql_query($query) or die(mysql_error());
			$num=mysql_num_rows($result);
			for($x=0;$x<$num;$x++){
			$data=mysql_fetch_assoc($result);
				$eval_id=$data['EVAL_ID'];
				echo $eval_id . "<br>";
				$query2="SELECT * FROM EvalComment WHERE EVAL_ID=" . $eval_id;
				$result2=mysql_query($query2) or die(mysql_error());
				while($data2=mysql_fetch_assoc($result2)){
					$comments[$x][]=$data2['Comment'];
				}
									print_r($comments);
				
			}
			*/
			$query="SELECT EvalComment.Comment, EvalComment.BEHAVIOR_ID FROM Eval INNER JOIN EvalComment ON(EvalComment.EVAL_ID=Eval.EVAL_ID) WHERE STUDENT_ID=" . $student_id . " ORDER BY  Eval.EVAL_ID, EvalComment.BEHAVIOR_ID" ;
			$result=mysql_query($query) or die(mysql_error());
			$num=mysql_num_rows($result);
			while($data=mysql_fetch_assoc($result)){
			$eval++;
			$comments[$eval]=array($data['BEHAVIOR_ID'] => $data['Comment']);
			}
			
			
			
			for($i=0;$i<$numB;$i++){ 
            //result of qtwo
              $rtwo = mysql_fetch_array($qtwo);
              echo "Behavior: <input name=\"BEHAVIOR_ID\" type=\"text\" value=\"" . $rtwo[BehaviorName] . "\" readonly=\"readonly\"/> </br>";
              $behavior_id=$rtwo['BEHAVIOR_ID'];
              echo "Comments: <textarea name=\"" . $behavior_id . "\" id=\"behavior-" . $rtwo['BEHAVIOR_ID'] . "\" rows=\"5\" cols=\"50\">";
			  for($d=0;$d<=$eval;$d++){
				echo $comments[($d+1)][$behavior_id] . "\n";
			  }
			  echo "</textarea> </br>"; ?>
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
  
