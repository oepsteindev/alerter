<?php

include_once("config.php");
include_once("includes.php");
include_once("header.php");



if(isset($_POST['update']))
{	

	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	
	$ticker = mysqli_real_escape_string($mysqli, $_POST['ticker']);
	$bullbear = mysqli_real_escape_string($mysqli, $_POST['bullbear']);
	$t1 = mysqli_real_escape_string($mysqli, $_POST['t1']);
	$t2 = mysqli_real_escape_string($mysqli, $_POST['t2']);
	$t3 = mysqli_real_escape_string($mysqli, $_POST['t3']);
	$t4 = mysqli_real_escape_string($mysqli, $_POST['t4']);
	$t5 = mysqli_real_escape_string($mysqli, $_POST['t5']);


	$t1_hit = isset($_POST['t1_hit']) ?  mysqli_real_escape_string($mysqli, $_POST['t1_hit']) : "''";
	$t2_hit = isset($_POST['t2_hit']) ?  mysqli_real_escape_string($mysqli, $_POST['t1_hit']) : "''";
	$t3_hit = isset($_POST['t3_hit']) ?  mysqli_real_escape_string($mysqli, $_POST['t1_hit']) :"''";
	$t4_hit = isset($_POST['t4_hit']) ?  mysqli_real_escape_string($mysqli, $_POST['t1_hit']) : "''";
	$t5_hit = isset($_POST['t5_hit']) ?  mysqli_real_escape_string($mysqli, $_POST['t1_hit']) : "''";
	
	// checking empty fields
    $today = date('Y-m-d');
    $sql = "UPDATE {$databaseName}.alerts SET `ticker`='$ticker', `date`='$today', `bullbear`='$bullbear',`t1`=$t1, `t2`=$t2, `t3`=$t3, `t4`=$t4, `t5`=$t5,
    `t1_hit` = $t1_hit, `t2_hit` = $t2_hit, `t3_hit` = $t3_hit, `t4_hit` = $t4_hit, `t5_hit` = $t5_hit  WHERE id=$id";

		//updating the table
		$result = mysqli_query($mysqli, $sql);
		// exit;
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	
}
?>
<?php

$id = $_GET['id'];

$result = mysqli_query($mysqli, "SELECT * FROM {$databaseName}.alerts WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$ticker = $res['ticker'];
	$bullbear = $res['bullbear'];
	$t1 = $res['t1'];
	$t2 = $res['t2'];
	$t3 = $res['t3'];
	$t4 = $res['t4'];
	$t5 = $res['t5'];
}
?>
<html>
<head>	
<?=$includes?>
    <title>Edit Data</title>

</head>

<body>
	<?=$header?>
	<div class="container">
	<a href="index.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Ticker</td>
				<td><input type="text" name="ticker"  class="form-control" value="<?php echo $ticker;?>"></td>
			</tr>
			<tr> 
				<td>Bull / Bear</td>
				<td><input type="text" name="bullbear" class="form-control" value="<?php echo $bullbear;?>"></td>
			</tr>
			<tr> 
				<td>Target 1</td>
				<td><input type="text" name="t1" value="<?=$t1?>" class="form-control"></td>

				<td><input type="checkbox" name="t1_hit" value="" onclick="$(this).val(this.checked ? 0 : '')" ></td>
				<td>Clear Last Hit?</td>
			</tr>
			<tr> 
				<td>Target 2</td>
				<td><input type="text" name="t2" class="form-control" value="<?=$t2?>"></td>

				<td><input type="checkbox" name="t2_hit" value="" onclick="$(this).val(this.checked ? 0 : '')" ></td>
				<td>Clear Last Hit?</td>
			</tr>
			<tr> 
				<td>Target 3</td>
				<td><input type="text" name="t3" class="form-control" value="<?=$t3?>"></td>

				<td><input type="checkbox" name="t3_hit" value="" onclick="$(this).val(this.checked ? 0 : '')" ></td>
				<td>Clear Last Hit?</td>
			</tr>
			<tr> 
				<td>Target 4</td>
				<td><input type="text" name="t4" class="form-control" value="<?=$t4?>"></td>

				<td><input type="checkbox" name="t4_hit" value="" onclick="$(this).val(this.checked ? 0 : '')" ></td>
				<td>Clear Last Hit?</td>
			</tr>
			<tr> 
				<td>Target 5</td>
				<td><input type="text" name="t5" class="form-control" value="<?=$t5?>"></td>

				<td><input type="checkbox" name="t5_hit" value="" onclick="$(this).val(this.checked ? 0 : '')" ></td>
				<td>Clear Last Hit?</td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" class="btn btn-primary" value="Update"></td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>
