<?php
date_default_timezone_set('Asia/Jakarta');
set_time_limit(0);

include "excel_reader.php";

$conn = mysql_connect("localhost","root","");
if (!$conn)
{
	die('Could not connect: ' . mysql_error());
}
#mysql_select_db("graha", $conn);
#mysql_select_db("bintaro", $conn);
?>