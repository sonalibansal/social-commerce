<?php
include 'session.php';
if(isset($_POST['search_submit']))
{
	echo $login_session;
	$query=$_POST['srch_term'];
	echo $query;
	echo "hi";
	$array=array("data"=>$query,"user_name"=>$login_session);
   $json=json_encode($array);

//echo gettype($json);
//$string=list($login_session,$query);
$file = fopen("C:\Python27\search.txt", "w+") or die("Unable to open file!");
			fwrite($file,$json);
			fclose($file);
			$handle = popen('C:\Python27\search.py 2>&1', 'r');
			$read = fread($handle, 2096);
			pclose($handle);
//echo $read;
			echo "login=".$read;
}
else
echo "error";
?>
