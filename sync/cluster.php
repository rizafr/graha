<?php 
include "conn.php";

if(isset($_REQUEST["import"]))
{
	try
	{
		if($_FILES['file']['tmp_name'] == "")
		{
			throw new Exception("Pilih File Import .xls <br />");
		}
		
		$xlx = new Spreadsheet_Excel_Reader($_FILES['file']['tmp_name']);
		$baris = $xlx->rowcount($sheet_index=0);

		# Cluster
		$array_cluster = array();
		$array_kode_cluster = array();
		$id_cluster = array();
		for($i=3;$i<=$baris;$i++)
		{
			$nama_cluster = strtoupper(trim($xlx->val($i, 1)));
			$kode_cluster = strtoupper(trim($xlx->val($i, 2)));
			$x = $nama_cluster."|".$kode_cluster;
			if (!in_array($x, $array_cluster))
			{
				array_push($array_cluster, $x);
			}
		}
		mysql_query("BEGIN");
		//mysql_query("TRUNCATE tbl_cluster");
		
		foreach($array_cluster AS $y)
		{
			$split = explode("|", $y);
			$nama_cluster = $split[0];
			$kode_cluster = $split[1];
			
			$cek = "SELECT count(id_cluster) AS tot FROM tbl_cluster WHERE nama_cluster = '$nama_cluster'";
			$result = mysql_query($cek ,$conn);
			$row = mysql_fetch_array($result);
			if ($row['tot'] > 0)
			{
				throw new Exception("Duplicate cluster : $nama_cluster <br />");
			}
			
			mysql_query("INSERT INTO tbl_cluster VALUES ('', '$kode_cluster','$nama_cluster')");
			$id = mysql_insert_id();
			$id_cluster[$nama_cluster] = $id;
		}
		
		# Type
		//mysql_query("TRUNCATE tbl_type");
		for($i=3;$i<=$baris;$i++)
		{
			$nama_cluster = strtoupper(trim($xlx->val($i, 1)));
			$nama_type = strtoupper(trim($xlx->val($i, 3)));
			$id = $id_cluster[$nama_cluster];

			$cek = "SELECT count(id_type) AS tot FROM tbl_type WHERE id_cluster = '$id' AND nama_type = '$nama_type'";
			$result = mysql_query($cek ,$conn);
			$row = mysql_fetch_array($result);
			if ($row['tot'] > 0)
			{
				throw new Exception("Duplicate cluster : $nama_cluster & type : $nama_type row :  $i <br />");
			}
			
			mysql_query("INSERT INTO tbl_type VALUES ('', '$id','$nama_type', '', '')");
		}
		
		mysql_query("COMMIT");
		echo "Import Data Cluster & Type Sukses !";
	}
	catch(Exception $e)
	{
		mysql_query("ROLLBACK");
		echo $e->getMessage();
	}

	mysql_close($conn);
}
?>
<html>
<head>
<title>Cluster</title>
</head>
<body>
<form name="form1" method="post" id="form1" enctype="multipart/form-data">
<table width="300px">
	<tr>
		<td colspan="2">
			<b>IMPORT CLUSTER, TYPE</b>
		</td>
	</tr>
	<tr>
		<td width="10%" align="left" class="input_default">FILE</td>
		<td width="90%" class="input_default">
			<input type="file" size="60" name="file">
		</td>
	</tr>
	<tr>
		<td align="left" class="input_default">&nbsp;</td>
		<td class="input_default">
			<input type="submit" name="import" value="Import">
		</td>
	</tr>
</table>
</form>
</body>
</html>