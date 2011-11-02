$server = 'turing.plymouth.edu';
$link = mysql_connect($server, 'drallen1' , 'unicode' );
mysql_select_db("drallen1", $link);
if (!link){
  die('Error connecting to the database.');
}