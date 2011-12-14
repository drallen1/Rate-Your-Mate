<?php
include('includes/header.php');


$student_id=$_GET['studentid'];
$query="SELECT GROUP_ID FROM users WHERE STUDENT_ID=". $student_id;
						$result=mysql_query($query) or die(mysql_error());
						$data=mysql_fetch_array($result);
						$group_id=$data['GROUP_ID'];
if($session->logged_in)

//if they are an instructor
{
	
            $link = mysql_connect("localhost","drallen1","unicode") or die(mysql_error);
            mysql_select_db("drallen1");
						
						$qsix = mysql_query($sql = "SELECT * FROM users u WHERE u.GROUP_ID=" . $group_id . " AND EXISTS(SELECT * FROM Eval e WHERE u.STUDENT_ID=e.STUDENT_ID) AND u.STUDENT_ID != " . $student_id);

            /***************************************************
            //WHEN numE == 0 GO TO PIE CHART
            ***************************************************/
            //QUERY
            $qtwo = mysql_query("SELECT * FROM Behavior b, Groups g WHERE g.GROUP_ID=" . $group_id. " AND b.CONTRACT_ID=g.CONTRACT_ID");
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
            <?php }
if($session->logged_in){
	$host="turing.plymouth.edu"; // Host name
	$username="drallen1"; // Mysql username
	$password="unicode"; // Mysql password
	$db_name="drallen1"; // Database name
	$tbl_name="Contract"; // Table name
	// Connect to server and select database.
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");
	
	// get data that sent from form
	$user_id=$student_id;
	
	//STUDENT FIRST NAME LAST NAME
	$query_student_id = "SELECT fname,lname FROM users WHERE STUDENT_ID ='$user_id'"; //pull student id from user_id
	$student_id_result=mysql_query($query_student_id) or die("display_db_query:" . mysql_error()); //result student first, last
	$student_id= mysql_fetch_row($student_id_result);
	
	$query_grade = "SELECT * FROM Eval WHERE STUDENT_ID ='$user_id'";
	$query_grade_result = mysql_query($query_grade) or die("display_db_query:" . mysql_error());
	$student_grade = mysql_fetch_row($query_grade_result);
	//echo "$student_grade[4] - "; //grade
	
	$query_group_id = "SELECT GROUP_ID FROM Eval WHERE STUDENT_ID = '$user_id'";
	$group_id_result = mysql_query($query_group_id) or die("display_db_query:" . mysql_error());
	$group_id  = mysql_fetch_row($group_id_result);
	//echo "$group_id[0] - ";
	
	$query_group_grade = "SELECT * FROM Eval WHERE GROUP_ID='$group_id[0]'";
	$group_grade_result = mysql_query($query_group_grade) or die("display_db_query:" . mysql_error());
	$group_grade  = mysql_fetch_array($group_grade_result);
	$column_count=mysql_num_fields($group_grade_result) or die("display_db_query:". mysql_error()); //customer id field length
	
while($group_grade  = mysql_fetch_array($group_grade_result)){
	//$totalgroupgrade = $totalgroupgrade + $group_grade['Grade'];
}
$average = $totalgroupgrade / $column_count;
$total = 23 - $student_grade[4];


echo <<<HTML
<head>

<style type="text/css">
.ui-slider-horizontal {
	width: 30em;
	margin: 0em 0em 1em 5em;
}

body {
  background: #fff;
  color: #333;
  font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;
  font-size: 0.9em;
  padding: 40px;
}

.wideBox {
  clear: both;
  text-align: center;
  margin-bottom: 50px;
  padding: 10px;
  background: #ebedf2;
  border: 1px solid #333;
  line-height: 80%;
}

#container {
  width: 900px;
  margin: 0 auto;
}

#chart, #chartData {
  border: 1px solid #333;
  background: #ebedf2 url("images/gradient.png") repeat-x 0 0;
}

#chart {
  display: block;
  margin: 0 0 50px 0;
  float: left;
  cursor: pointer;
}

#chartData {
  width: 200px;
  margin: 0 40px 0 0;
  float: right;
  border-collapse: collapse;
  box-shadow: 0 0 1em rgba(0, 0, 0, 0.5);
  -moz-box-shadow: 0 0 1em rgba(0, 0, 0, 0.5);
  -webkit-box-shadow: 0 0 1em rgba(0, 0, 0, 0.5);
  background-position: 0 -100px;
}

#chartData th, #chartData td {
  padding: 0.5em;
  border: 1px dotted #666;
  text-align: left;
}

#chartData th {
  border-bottom: 2px solid #333;
  text-transform: uppercase;
}

#chartData td {
  cursor: pointer;
}

#chartData td.highlight {
  background: #e8e8e8;
}

#chartData tr:hover td {
  background: #f0f0f0;
}

</style>

<script type="text/javascript">
$(function () {
	$('div.basicLinked').slider().linkedSliders();
	$('div.basicLinked:first').slider('value', 100);
});
</script>
<!--[if IE]>
<script src="http://explorercanvas.googlecode.com/svn/trunk/excanvas.js"></script>
<![endif]-->
<script>

// Run the code when the DOM is ready
$( pieChart );

function pieChart() {

  // Config settings
  var chartSizePercent = 55;                        // The chart radius relative to the canvas width/height (in percent)
  var sliceBorderWidth = 1;                         // Width (in pixels) of the border around each slice
  var sliceBorderStyle = "#fff";                    // Colour of the border around each slice
  var sliceGradientColour = "#ddd";                 // Colour to use for one end of the chart gradient
  var maxPullOutDistance = 25;                      // How far, in pixels, to pull slices out when clicked
  var pullOutFrameStep = 4;                         // How many pixels to move a slice with each animation frame
  var pullOutFrameInterval = 15;                    // How long (in ms) between each animation frame
  var pullOutLabelPadding = 65;                     // Padding between pulled-out slice and its label  
  var pullOutLabelFont = "bold 16px 'Trebuchet MS', Verdana, sans-serif";  // Pull-out slice label font
  var pullOutValueFont = "bold 12px 'Trebuchet MS', Verdana, sans-serif";  // Pull-out slice value font
  var pullOutValuePrefix = "";                     // Pull-out slice value prefix
  var pullOutShadowColour = "rgba( 0, 0, 0, .5 )";  // Colour to use for the pull-out slice shadow
  var pullOutShadowOffsetX = 5;                     // X-offset (in pixels) of the pull-out slice shadow
  var pullOutShadowOffsetY = 5;                     // Y-offset (in pixels) of the pull-out slice shadow
  var pullOutShadowBlur = 5;                        // How much to blur the pull-out slice shadow
  var pullOutBorderWidth = 2;                       // Width (in pixels) of the pull-out slice border
  var pullOutBorderStyle = "#333";                  // Colour of the pull-out slice border
  var chartStartAngle = -.5 * Math.PI;              // Start the chart at 12 o'clock instead of 3 o'clock

  // Declare some variables for the chart
  var canvas;                       // The canvas element in the page
  var currentPullOutSlice = -1;     // The slice currently pulled out (-1 = no slice)
  var currentPullOutDistance = 0;   // How many pixels the pulled-out slice is currently pulled out in the animation
  var animationId = 0;              // Tracks the interval ID for the animation created by setInterval()
  var chartData = [];               // Chart data (labels, values, and angles)
  var chartColours = [];            // Chart colours (pulled from the HTML table)
  var totalValue = 0;               // Total of all the values in the chart
  var canvasWidth;                  // Width of the canvas, in pixels
  var canvasHeight;                 // Height of the canvas, in pixels
  var centreX;                      // X-coordinate of centre of the canvas/chart
  var centreY;                      // Y-coordinate of centre of the canvas/chart
  var chartRadius;                  // Radius of the pie chart, in pixels

  // Set things up and draw the chart
  init();


  /**
   * Set up the chart data and colours, as well as the chart and table click handlers,
   * and draw the initial pie chart
   */

  function init() {

    // Get the canvas element in the page
    canvas = document.getElementById('chart');

    // Exit if the browser isn't canvas-capable
    if ( typeof canvas.getContext === 'undefined' ) return;

    // Initialise some properties of the canvas and chart
    canvasWidth = canvas.width;
    canvasHeight = canvas.height;
    centreX = canvasWidth / 2;
    centreY = canvasHeight / 2;
    chartRadius = Math.min( canvasWidth, canvasHeight ) / 2 * ( chartSizePercent / 100 );

    // Grab the data from the table,
    // and assign click handlers to the table data cells
    
    var currentRow = -1;
    var currentCell = 0;

    $('#chartData td').each( function() {
      currentCell++;
      if ( currentCell % 2 != 0 ) {
        currentRow++;
        chartData[currentRow] = [];
        chartData[currentRow]['label'] = $(this).text();
      } else {
       var value = parseFloat($(this).text());
       totalValue += value;
       value = value.toFixed(2);
       chartData[currentRow]['value'] = value;
      }

      // Store the slice index in this cell, and attach a click handler to it
      $(this).data( 'slice', currentRow );
      $(this).click( handleTableClick );

      // Extract and store the cell colour
      if ( rgb = $(this).css('color').match( /rgb\((\d+), (\d+), (\d+)/) ) {
        chartColours[currentRow] = [ rgb[1], rgb[2], rgb[3] ];
      } else if ( hex = $(this).css('color').match(/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/) ) {
        chartColours[currentRow] = [ parseInt(hex[1],16) ,parseInt(hex[2],16), parseInt(hex[3], 16) ];
      } else {
        alert( "Error: Colour could not be determined! Please specify table colours using the format '#xxxxxx'" );
        return;
      }

    } );

    // Now compute and store the start and end angles of each slice in the chart data

    var currentPos = 0; // The current position of the slice in the pie (from 0 to 1)

    for ( var slice in chartData ) {
      chartData[slice]['startAngle'] = 2 * Math.PI * currentPos;
      chartData[slice]['endAngle'] = 2 * Math.PI * ( currentPos + ( chartData[slice]['value'] / totalValue ) );
      currentPos += chartData[slice]['value'] / totalValue;
    }

    // All ready! Now draw the pie chart, and add the click handler to it
    drawChart();
    $('#chart').click ( handleChartClick );
  }


  /**
   * Process mouse clicks in the chart area.
   *
   * If a slice was clicked, toggle it in or out.
   * If the user clicked outside the pie, push any slices back in.
   *
   * @param Event The click event
   */

  function handleChartClick ( clickEvent ) {

    // Get the mouse cursor position at the time of the click, relative to the canvas
    var mouseX = clickEvent.pageX - this.offsetLeft;
    var mouseY = clickEvent.pageY - this.offsetTop;

    // Was the click inside the pie chart?
    var xFromCentre = mouseX - centreX;
    var yFromCentre = mouseY - centreY;
    var distanceFromCentre = Math.sqrt( Math.pow( Math.abs( xFromCentre ), 2 ) + Math.pow( Math.abs( yFromCentre ), 2 ) );

    if ( distanceFromCentre <= chartRadius ) {

      // Yes, the click was inside the chart.
      // Find the slice that was clicked by comparing angles relative to the chart centre.

      var clickAngle = Math.atan2( yFromCentre, xFromCentre ) - chartStartAngle;
      if ( clickAngle < 0 ) clickAngle = 2 * Math.PI + clickAngle;
                  
      for ( var slice in chartData ) {
        if ( clickAngle >= chartData[slice]['startAngle'] && clickAngle <= chartData[slice]['endAngle'] ) {

          // Slice found. Pull it out or push it in, as required.
          toggleSlice ( slice );
          return;
        }
      }
    }

    // User must have clicked outside the pie. Push any pulled-out slice back in.
    pushIn();
  }


  /**
   * Process mouse clicks in the table area.
   *
   * Retrieve the slice number from the jQuery data stored in the
   * clicked table cell, then toggle the slice
   *
   * @param Event The click event
   */

  function handleTableClick ( clickEvent ) {
    var slice = $(this).data('slice');
    toggleSlice ( slice );
  }


  /**
   * Push a slice in or out.
   *
   * If it's already pulled out, push it in. Otherwise, pull it out.
   *
   * @param Number The slice index (between 0 and the number of slices - 1)
   */

  function toggleSlice ( slice ) {
    if ( slice == currentPullOutSlice ) {
      pushIn();
    } else {
      startPullOut ( slice );
    }
  }

 
  /**
   * Start pulling a slice out from the pie.
   *
   * @param Number The slice index (between 0 and the number of slices - 1)
   */

  function startPullOut ( slice ) {

    // Exit if we're already pulling out this slice
    if ( currentPullOutSlice == slice ) return;

    // Record the slice that we're pulling out, clear any previous animation, then start the animation
    currentPullOutSlice = slice;
    currentPullOutDistance = 0;
    clearInterval( animationId );
    animationId = setInterval( function() { animatePullOut( slice ); }, pullOutFrameInterval );

    // Highlight the corresponding row in the key table
    $('#chartData td').removeClass('highlight');
    var labelCell = $('#chartData td:eq(' + (slice*2) + ')');
    var valueCell = $('#chartData td:eq(' + (slice*2+1) + ')');
    labelCell.addClass('highlight');
    valueCell.addClass('highlight');
  }

 
  /**
   * Draw a frame of the pull-out animation.
   *
   * @param Number The index of the slice being pulled out
   */

  function animatePullOut ( slice ) {

    // Pull the slice out some more
    currentPullOutDistance += pullOutFrameStep;

    // If we've pulled it right out, stop animating
    if ( currentPullOutDistance >= maxPullOutDistance ) {
      clearInterval( animationId );
      return;
    }

    // Draw the frame
    drawChart();
  }

 
  /**
   * Push any pulled-out slice back in.
   *
   * Resets the animation variables and redraws the chart.
   * Also un-highlights all rows in the table.
   */

  function pushIn() {
    currentPullOutSlice = -1;
    currentPullOutDistance = 0;
    clearInterval( animationId );
    drawChart();
    $('#chartData td').removeClass('highlight');
  }
 
 
  /**
   * Draw the chart.
   *
   * Loop through each slice of the pie, and draw it.
   */

  function drawChart() {

    // Get a drawing context
    var context = canvas.getContext('2d');
        
    // Clear the canvas, ready for the new frame
    context.clearRect ( 0, 0, canvasWidth, canvasHeight );

    // Draw each slice of the chart, skipping the pull-out slice (if any)
    for ( var slice in chartData ) {
      if ( slice != currentPullOutSlice ) drawSlice( context, slice );
    }

    // If there's a pull-out slice in effect, draw it.
    // (We draw the pull-out slice last so its drop shadow doesn't get painted over.)
    if ( currentPullOutSlice != -1 ) drawSlice( context, currentPullOutSlice );
  }


  /**
   * Draw an individual slice in the chart.
   *
   * @param Context A canvas context to draw on  
   * @param Number The index of the slice to draw
   */

  function drawSlice ( context, slice ) {

    // Compute the adjusted start and end angles for the slice
    var startAngle = chartData[slice]['startAngle']  + chartStartAngle;
    var endAngle = chartData[slice]['endAngle']  + chartStartAngle;
      
    if ( slice == currentPullOutSlice ) {

      // We're pulling (or have pulled) this slice out.
      // Offset it from the pie centre, draw the text label,
      // and add a drop shadow.

      var midAngle = (startAngle + endAngle) / 2;
      var actualPullOutDistance = currentPullOutDistance * easeOut( currentPullOutDistance/maxPullOutDistance, .8 );
      startX = centreX + Math.cos(midAngle) * actualPullOutDistance;
      startY = centreY + Math.sin(midAngle) * actualPullOutDistance;
      context.fillStyle = 'rgb(' + chartColours[slice].join(',') + ')';
      context.textAlign = "center";
      context.font = pullOutLabelFont;
      context.fillText( chartData[slice]['label'], centreX + Math.cos(midAngle) * ( chartRadius + maxPullOutDistance + pullOutLabelPadding ), centreY + Math.sin(midAngle) * ( chartRadius + maxPullOutDistance + pullOutLabelPadding ) );
      context.font = pullOutValueFont;
      context.fillText( pullOutValuePrefix + chartData[slice]['value'] + " (" + ( parseInt( chartData[slice]['value'] / totalValue * 100 + .5 ) ) +  "%)", centreX + Math.cos(midAngle) * ( chartRadius + maxPullOutDistance + pullOutLabelPadding ), centreY + Math.sin(midAngle) * ( chartRadius + maxPullOutDistance + pullOutLabelPadding ) + 20 );
      context.shadowOffsetX = pullOutShadowOffsetX;
      context.shadowOffsetY = pullOutShadowOffsetY;
      context.shadowBlur = pullOutShadowBlur;

    } else {

      // This slice isn't pulled out, so draw it from the pie centre
      startX = centreX;
      startY = centreY;
    }

    // Set up the gradient fill for the slice
    var sliceGradient = context.createLinearGradient( 0, 0, canvasWidth*.75, canvasHeight*.75 );
    sliceGradient.addColorStop( 0, sliceGradientColour );
    sliceGradient.addColorStop( 1, 'rgb(' + chartColours[slice].join(',') + ')' );

    // Draw the slice
    context.beginPath();
    context.moveTo( startX, startY );
    context.arc( startX, startY, chartRadius, startAngle, endAngle, false );
    context.lineTo( startX, startY );
    context.closePath();
    context.fillStyle = sliceGradient;
    context.shadowColor = ( slice == currentPullOutSlice ) ? pullOutShadowColour : "rgba( 0, 0, 0, 0 )";
    context.fill();
    context.shadowColor = "rgba( 0, 0, 0, 0 )";

    // Style the slice border appropriately
    if ( slice == currentPullOutSlice ) {
      context.lineWidth = pullOutBorderWidth;
      context.strokeStyle = pullOutBorderStyle;
    } else {
      context.lineWidth = sliceBorderWidth;
      context.strokeStyle = sliceBorderStyle;
    }

    // Draw the slice border
    context.stroke();
  }


  /**
   * Easing function.
   *
   * A bit hacky but it seems to work! (Note to self: Re-read my school maths books sometime)
   *
   * @param Number The ratio of the current distance travelled to the maximum distance
   * @param Number The power (higher numbers = more gradual easing)
   * @return Number The new ratio
   */

  function easeOut( ratio, power ) {
    return ( Math.pow ( 1 - ratio, power ) + 1 );
  }

};

</script>


</head>
<body>
<div id="container">

  <canvas id="chart" width="600" height="500"></canvas>

  <table id="chartData">
    <tr>
      <th>Member</th><th>Grade</th>
     </tr>
    <tr style="color: #0DA068">
      <td>$student_id[1], $student_id[0]</td><td>$student_grade[4]</td>
    </tr>
    <tr style="color: #194E9C">
		<td>Other</td><td>$total</td>
    </tr>
  </table>

</div>
</body>
</html>
HTML;
?>
<?
}else
{
echo "You do not have access to this page.";
}
 ?>
            </br>
            <input type="submit" value="Send!" name="Submit"/>
          </form>
        </body>

   </html>

    <? include("includes/footer.php"); 
  }else{
  echo "You don't have access to this.";
};?>
  
