<?php

include_once("config.php");
include_once("includes.php");
include_once("header.php");

?>
<html>
<head>
    <?=$includes?>
	<title>Add Data</title>
</head>

<body>
	<?=$header?>
<?php


if(isset($_POST['Submit'])) {	
	$ticker = mysqli_real_escape_string($mysqli, $_POST['ticker']);
	$bullbear = mysqli_real_escape_string($mysqli, $_POST['bullbear']);
	$t1 = $_POST['t1'] != '' ? $_POST['t1'] : 0;
	$t2 = $_POST['t2'] != '' ? $_POST['t2'] : 0;
	$t3 = $_POST['t3'] != '' ? $_POST['t3'] : 0;
	$t4 = $_POST['t4'] != '' ? $_POST['t4'] : 0;
	$t5 = $_POST['t5'] != '' ? $_POST['t5'] : 0;
	
// print_r("t5: ".$t5);exit;

	echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    $date = date('Y-m-d');

    $sql = "INSERT INTO {$databaseName}.alerts(`date`, `ticker`,`bullbear`,`t1`,`t2`,`t3`,`t4`,`t5`) VALUES('$date', '$ticker','$bullbear',$t1, $t2, $t3, $t4, $t5)";
    if(mysqli_query($mysqli, $sql)){
        echo "<br/><font color='green'>Data added successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
    }


		
		echo "<br/><a href='index.php'>View Result</a>";
		echo '<br/><br/><a href="add.html" class="btn btn-small btn-primary">Add Another Row</a>';

}
?>
</body>
</html>
